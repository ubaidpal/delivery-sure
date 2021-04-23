<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : kinnect2
 * Product Name : PhpStorm
 * Date         : 09-Mar-2016 8:21 PM
 * File Name    : SuperAdminRepository.php
 */

namespace Repositories\Admin;

use App\Conversation;
use App\OrderPayment;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Repositories\MessageRepository;

class SuperAdminRepository
{
    public function __construct() {

    }

    public function members_count() {
        return User::where('user_type', \Config::get('constants.REGULAR_USER'))->orWhere('user_type', \Config::get('constants.BRAND_USER'))->count();
    }

    public function type_count($type) {
        return User::where('user_type', $type)->count();
    }

    public function all_login() {
        return User::sum('login_counter');
    }

    public function today_login() {
        return User::where('lastlogin_date', '>=', \Carbon\Carbon::now()->format('Y-m-d'))
                   ->groupBy('date')
                   ->orderBy('date', 'DESC')
                   ->first(array(
                       \DB::raw('Date(lastlogin_date) as date'),
                       \DB::raw('COUNT(*) as "login"')
                   ))->login;
    }

    public function getFlaggedPosts() {
        return Report::whereRead(0)->with('post')->orderBy('report_id', 'DESC')->paginate(25);
    }

    public function updateReportStatus($id) {
        $report       = Report::find($id);
        $report->read = 1;
        $report->save();
        return $report->action_id;
    }

    public function updatePostStatus($action_id) {
        $post = ActivityAction::find($action_id);

        if($post) {
            $post->is_flagged = 1;
            $post->save();
        }

        return TRUE;
    }

    public function updateStatement($type, $parent, $order_id, $transaction_type, $currency, $user_id, $amount = NULL) {
        $sale = \Config::get('constant_settings.STATEMENT_TYPES.SALE');

        if($type == $sale) {
            // $order = $this->find($order_id);
            if($type == $sale) {
                $payment = OrderPayment::whereOrderId($order_id)->first();

                $amount = $payment->amount;
            }
        }
        $already_exists = $this->alreadyExist($parent, $type, $order_id, $transaction_type, $user_id);

        if($already_exists || empty($amount) || $amount == '0.00') {
            return FALSE;
        }

        $stObj = new Transaction();

        $stObj->type             = $type;
        $stObj->parent_type      = $parent;
        $stObj->parent_id        = $order_id;
        $stObj->user_id          = $user_id;
        $stObj->amount           = $amount;
        $stObj->transaction_type = $transaction_type;
        $stObj->currency         = $currency;
        $stObj->save();

    }

    private function alreadyExist($parent, $type, $order_id, $transaction_type, $user_id) {
        return Transaction::where('parent_type', $parent)
                          ->where('type', $type)
                          ->where('parent_id', $order_id)
                          ->where('transaction_type', $transaction_type)
                          ->where('user_id', $user_id)
                          ->count();
    }

    public function changeApprovalStatus($userId, $status) {
        $user           = User::find($userId);
        $user->approved = $status;
        $user->save();
    }

    public function getDashBoardData() {
        $start     = Carbon::now()->addDay(1)->toDateString();
        $today     = Carbon::now()->toDateString();
        $lastMonth = Carbon::now()->subMonth()->toDateString();
        $lastYear  = Carbon::now()->subYear()->toDateString();

        $data[ 'monthly_revenue' ] = $this->getRevenue($start, $lastMonth);
        $data[ 'yearly_revenue' ]  = $this->getRevenue($start, $lastYear);
        $dailyData                 = $this->getProfitDaily($today, $lastMonth);
        $monthlyData               = $this->getProfit($start, $lastMonth);
        $data[ 'daily_profit' ]    = $dailyData[ 'profit' ];
        $data[ 'monthly_profit' ]  = $this->getProfit($start, $lastMonth)[ 'profit' ];
        //$data[ 'yearly_profit' ]  = $this->getProfit($start, $lastYear)[ 'profit' ];

        $data[ 'daily_spent_purchaser' ]   = $this->getSpent($today, $lastMonth, \Config::get('constant_settings.USER_TYPES.PURCHASER'), TRUE);
        $data[ 'monthly_spent_purchaser' ] = $this->getSpent($start, $lastMonth, \Config::get('constant_settings.USER_TYPES.PURCHASER'));
        //$data[ 'yearly_spent_purchaser' ]  = $this->getSpent($start, $lastYear, \Config::get('constant_settings.USER_TYPES.PURCHASER'));

        $data[ 'daily_spent_retailer' ]   = $this->getSpent($start, $lastMonth, \Config::get('constant_settings.USER_TYPES.RETAILER'), TRUE);
        $data[ 'monthly_spent_retailer' ] = $this->getSpent($start, $lastMonth, \Config::get('constant_settings.USER_TYPES.RETAILER'));
        //$data[ 'yearly_spent_retailer' ]  = $this->getSpent($start, $lastYear, \Config::get('constant_settings.USER_TYPES.RETAILER'));

        $data[ 'daily_driver_earning' ]   = $dailyData[ 'driver_earning' ];
        $data[ 'monthly_driver_earning' ] = $monthlyData[ 'driver_earning' ];
        //$data[ 'yearly_driver_earning' ]  = $this->getProfit($start, $lastYear)[ 'driver_earning' ];

        $data1[ 'users' ]    = $this->getUsers($start, $lastMonth, $lastYear);
        $data[ 'purchaser' ] = json_encode($data1[ 'users' ][ 100 ]);
        $data[ 'driver' ]    = json_encode($data1[ 'users' ][ 101 ]);
        $data[ 'retailer' ]  = json_encode($data1[ 'users' ][ 102 ]);

        $data[ 'latest_users' ] = $this->getLatestUsers();
        //echo '<tt><pre>'; print_r($data); die;
        return $data;
    }

    private function getRevenue($start, $end) {
        return OrderPayment::whereBetween('created_at', [$end, $start])->select(\DB::raw('SUM(amount) as revenue'))->first()->revenue;
    }

    private function getProfit($start, $end) {
        $profit = OrderPayment::whereBetween('created_at', [$end, $start])->select(\DB::raw('SUM(delivery_fee) as profit'))->first()->toArray();

        $data = [
            'profit'         => ($profit[ 'profit' ] * 10) / 100,
            'driver_earning' => ($profit[ 'profit' ] * 90) / 100,
        ];
        return $data;
    }

    private function getProfitDaily($start, $end) {
        $profit = OrderPayment::whereDate('created_at', '=', $start)->select(\DB::raw('SUM(delivery_fee) as profit'))->first()->toArray();

        $data = [
            'profit'         => ($profit[ 'profit' ] * 10) / 100,
            'driver_earning' => ($profit[ 'profit' ] * 90) / 100,
        ];

        return $data;
    }

    public function getSpent($start, $end, $user_type, $daily = FALSE) {
        $data = User::whereUserType($user_type)
                    ->join('orders', 'orders.user_id', '=', 'users.id')
                    ->join('order_payments', 'order_payments.order_id', '=', 'orders.id')
                    ->select(\DB::raw('SUM(order_payments.amount) as total'));
        if($daily) {
            $data = $data->whereDate('order_payments.created_at', '=', $start);
        } else {
            $data = $data->whereBetween('order_payments.created_at', [$end, $start]);
        }
        $data = $data->first();
        return $data->total > 0 ? $data->total : 0;
    }

    public function getUsers($start, $end, $lastYear = FALSE) {
        $data = User::whereBetween('created_at', [$end, $start])
                    ->where(function ($query) {
                        $query->where('user_type', \Config::get('constant_settings.USER_TYPES.RETAILER'))
                              ->orWhere('user_type', \Config::get('constant_settings.USER_TYPES.PURCHASER'))
                              ->orWhere('user_type', \Config::get('constant_settings.USER_TYPES.DELIVERY_MAN'));
                    })
                    ->groupBy('date', 'user_type')
                    ->orderBy('created_at', 'ASC')
                    ->get(array(
                        \DB::raw('DATE (`created_at`) as date'),
                        \DB::raw('COUNT(*) as "count", created_at, user_type'),
                    ))
                    ->toArray();
        //echo '<tt><pre>'; print_r($data);
        if(count($data) == 0 && $lastYear) {
            $data = User::whereBetween('created_at', [$lastYear, $start])
                        ->where(function ($query) {
                            $query->where('user_type', \Config::get('constant_settings.USER_TYPES.RETAILER'))
                                  ->orWhere('user_type', \Config::get('constant_settings.USER_TYPES.PURCHASER'))
                                  ->orWhere('user_type', \Config::get('constant_settings.USER_TYPES.DELIVERY_MAN'));
                        })
                        ->groupBy('date', 'user_type')
                        ->orderBy('created_at', 'ASC')
                        ->get(array(
                            \DB::raw('DATE (`created_at`) as date'),
                            \DB::raw('COUNT(*) as "count", created_at, user_type'),
                        ))
                        ->toArray();
        }
        return $data = $this->formatDate($data);

        //echo '<tt><pre>'; print_r($data);die;
    }

    private function formatDate($data) {
        $users[ 100 ] = [];
        $users[ 101 ] = [];
        $users[ 102 ] = [];
        foreach ($data as $item) {
            $date = Carbon::parse($item[ 'created_at' ])->format('d M');

            $key = array_search($date, array_column($users[ $item[ 'user_type' ] ], 'label'));

            if($key !== FALSE) {
                $users[ $item[ 'user_type' ] ][ $key ] = [
                    'label' => $date,
                    'y'     => $item[ 'count' ]
                ];
            } else {
                $users[ $item[ 'user_type' ] ][] = [
                    'label' => $date,
                    'y'     => $item[ 'count' ]
                ];
            }

            if($item[ 'user_type' ] == 100) {
                $key = array_search($date, array_column($users[ 101 ], 'label'));

                if($key === FALSE) {
                    $users[ 101 ][] = [
                        'label' => $date,
                        'y'     => 0
                    ];
                }
                $key = array_search($date, array_column($users[ 102 ], 'label'));

                if($key === FALSE) {
                    $users[ 102 ][] = [
                        'label' => $date,
                        'y'     => 0
                    ];
                }
            } elseif($item[ 'user_type' ] == 101) {
                $key = array_search($date, array_column($users[ 100 ], 'label'));
                if($key === FALSE) {
                    $users[ 100 ][] = [
                        'label' => $date,
                        'y'     => 0
                    ];
                }
                $key = array_search($date, array_column($users[ 102 ], 'label'));
                if($key === FALSE) {
                    $users[ 102 ][] = [
                        'label' => $date,
                        'y'     => 0,
                        // 'key' => $key
                    ];
                }

            } else {
                $key = array_search($date, array_column($users[ 100 ], 'label'));
                if($key === FALSE) {
                    $users[ 100 ][] = [
                        'label' => $date,
                        'y'     => 0
                    ];
                }
                $key = array_search($date, array_column($users[ 101 ], 'label'));
                if($key === FALSE) {
                    $users[ 101 ][] = [
                        'label' => $date,
                        'y'     => 0
                    ];
                }
            }
            //$key = FALSE;
        }
        //echo '<tt><pre>'; print_r($users); die;
        return $users;
    }

    private function getLatestUsers() {
        return User::where(function ($query) {
            $query->where('user_type', \Config::get('constant_settings.USER_TYPES.RETAILER'))
                  ->orWhere('user_type', \Config::get('constant_settings.USER_TYPES.PURCHASER'))
                  ->orWhere('user_type', \Config::get('constant_settings.USER_TYPES.DELIVERY_MAN'));
        })
                   ->orderBy('created_at', 'DESC')
                   ->paginate(5);

    }

    public function sendMessage($data, $user_id) {
        $msgRepo = new MessageRepository();
        $users   = $data[ 'users' ] . ',' . $user_id;
        $users   = explode(',', $users);
        $conv  = $msgRepo->createConversation($users, $user_id);
        $this->updateConversation($conv, $data);
        $data = $msgRepo->addMessageToConversation($conv[ 'convId' ], $user_id, $data);
        return $data;
    }

    private function updateConversation($conv, $data) {
        $conv           = Conversation::find($conv['convId']);
        $conv->conv_for = 'admin';
        $conv->title    = $data[ 'title' ];
        $conv->save();
    }

}

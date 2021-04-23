<?php

namespace App\Http\Controllers\Admin;

use Repositories\Admin\SuperAdminRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use stdClass;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    protected $data;
    /**
     * @var SuperAdminRepository
     */
    private $superAdminRepository;
    private $user_id;
    private $user;

    /**
     * SuperAdminController constructor.
     */
    public function __construct(SuperAdminRepository $superAdminRepository) {
        $this->data                 = $data = new StdClass();
        $this->data->title          = "Dashboard - Super Admin";
        $this->superAdminRepository = $superAdminRepository;
        if(isset(\Auth::user()->id)) {
            $this->user_id = \Auth::user()->id;
            $this->user    = \Auth::user();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = $this->superAdminRepository->getDashBoardData();
        return view("admin.dashboard", $data)->with('title', 'Dashboard');
    }

    public function flaggedPosts() {
        if(!$this->user->is('super.admin')) {
            return redirect()->back();
        }
        $data[ 'posts' ] = $this->superAdminRepository->getFlaggedPosts();

        return \View::make('admin.super-user.flagged-posts', $data);
    }

    public function dismissReport($id) {
        if(!$this->user->is('super.admin')) {
            return redirect()->back();
        }
        $this->superAdminRepository->updateReportStatus($id);
        return redirect()->back();
    }

    public function blockPost($id) {
        if(!$this->user->is('super.admin')) {
            return redirect()->back();
        }

        $action_id = $this->superAdminRepository->updateReportStatus($id);
        $this->superAdminRepository->updatePostStatus($action_id);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function getDateData(Request $request) {
        $start = Carbon::parse($request->start_date)->subDay()->format('Y-m-d');
        $end = Carbon::parse($request->end_date)->addDay()->format('Y-m-d');
        $users               = $this->superAdminRepository->getUsers($end,$start);
        $data[ 'purchaser' ] = $users[ 100 ];
        $data[ 'driver' ]    = $users[ 101 ];
        $data[ 'retailer' ]  = $users[ 102 ];

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function storeTransactions() {
        $data                       = [];
        $from                       = \Request::get('from');
        $to                         = \Request::get('to');
        $data[ 'transaction_type' ] = $transaction_type = \Request::get('transaction_type');

        if($to) {
            $to = Carbon::parse($to)->format('Y-m-d H:i:s');
        } else {
            $to = Carbon::now();
        }

        if($from) {
            $from = Carbon::parse($from)->format('Y-m-d H:i:s');
        } else {
            $from = Carbon::now()->subDay(30);
        }

        $data[ 'to' ]   = $to;
        $data[ 'from' ] = $from;

        $query = StoreTransaction::where('created_at', '>', $from)
                                 ->where('created_at', '<', $to)
                                 ->with('user')
                                 ->orderBy('id', 'DESC');
        if(!empty($transaction_type)) {
            $query->where('transaction_type', 'like', $transaction_type);
        }

        $transactions = $query->paginate(20);

        $data[ 'transactions' ] = $transactions;
        return view('admin.transactions.storeTransactions', $data);
    }

    public function sendMessage(Request $request) {
        $this->superAdminRepository->sendMessage($request->all(), $this->user_id);
        return redirect()->back()->with('success', 'Message sent successfully');
    }
}

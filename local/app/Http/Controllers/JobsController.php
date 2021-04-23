<?php

namespace App\Http\Controllers;

use App\DriverLatLng;
use App\Events\Notification;
use App\Feedback;
use App\Order;
use App\OrderBid;
use App\OrderItem;
use App\Traits\Favourites;
use App\Traits\OrderDetailsTrait;
use App\User;
use Hashids\Hashids;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Repositories\OrderBidRepository;
use Repositories\OrderRepository;
use willvincent\Rateable\Rating;

class JobsController extends Controller
{
    protected $order;
    protected $user_id;
    protected $user;
    protected $is_api;
    protected $title;
    protected $request;
    protected $bidRepository;
    use Favourites;
    use OrderDetailsTrait;

    /**
     * JobsController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Repositories\OrderBidRepository $bidRepository
     * @param \Repositories\OrderRepository $order
     */
    public function __construct(Request $request, OrderBidRepository $bidRepository, OrderRepository $order) {

        $this->user_id       = $request[ 'middleware' ][ 'user_id' ];
        $this->user          = $request[ 'middleware' ][ 'user' ];
        $this->is_api        = $request[ 'allData' ][ 'is_api' ];
        $this->title         = 'My Jobs';
        $this->order         = $order;
        $this->bidRepository = $bidRepository;
        $this->request       = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($type = NULL) {
        if(!is_null($type)) {
            return $this->allJobs();
        }
        $data[ 'title' ] = $this->title;
        $status          = NULL;
        if(Input::has('status') && Input::get('status') != 'all') {
            $status = Input::get('status');
        }
        $data[ 'myJobs' ] = $this->bidRepository->myJobs($this->user_id, $status);
        if($this->is_api) {
            $jobs = $this->parseJobdetail($data[ 'myJobs' ], $this->user_id, $this->user);
            return \Api::success_list($jobs);
        }
        // echo '<tt><pre>'; print_r($data); die;
        return view('jobs.my_jobs', $data);
    }

    public function jobProgress($id = NULL) {
        if($this->is_api) {
            if(!Input::has('order_id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('order_id');
        }
        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $data = $this->getOrderDetails($id);

        if(empty($data[ 'order' ])) {
            if($this->is_api) {
                return \Api::detail_not_found();
            }
            return redirect()->back()->with('error', 'Order detail not found.Order is deleted or archived by purchaser');
        }
        if($data[ 'order' ]->status == config('constant_settings.ORDER_STATUS.IN_PROCESS')) {
            if($this->is_api) {
                $id = [\Hashids::connection('orders')->encode($id)];
                return $data;
            }
            return redirect()->route('order-detail', [\HashId::encode($id, 'orders')]);
        } elseif($data[ 'order' ]->status != config('constant_settings.ORDER_STATUS.IN_PROCESS') && ($data[ 'order' ]->delivery_driver_id != $this->user_id) && $this->user_id != $data[ 'order' ]->user_id) {
            if($this->is_api) {
                $id = [\Hashids::connection('orders')->encode($id)];
                return $data;
            }
            return redirect()->route('order-detail', [\HashId::encode($id, 'orders')]);
        } elseif($data[ 'order' ]->status == config('constant_settings.ORDER_STATUS.READY_TO_DEPART')) {

            if($this->is_api) {
                $id = [\Hashids::connection('orders')->encode($id)];
                return $this->jobDepart();
            }

            return redirect()->route('ready-to-depart', [\Hashids::connection('orders')->encode($id)]);
        } elseif($data[ 'order' ]->status == config('constant_settings.ORDER_STATUS.DELIVERED')) {
            if($this->is_api) {
                $id = [\Hashids::connection('orders')->encode($id)];
                // return \Api::success(['id' => $id]);
                return $this->delivered();
            }
            return redirect()->route('delivered', [\Hashids::connection('orders')->encode($id)]);
        } elseif($data[ 'order' ]->status == config('constant_settings.ORDER_STATUS.RECEIVED')) {
            if($this->is_api) {
                $id = [\Hashids::connection('orders')->encode($id)];
                //return \Api::success(['id' => $id]);
                return $this->received();
            }
            return redirect()->route('received', [\Hashids::connection('orders')->encode($id)]);
        }

        if($this->is_api) {
            $allData = $this->getOrderDetail((object)$data[ 'order' ], $this->user_id);
            unset($allData[ 'items' ]);
            return \Api::success_data($allData);
        }

        return view('jobs.job_in_progress', $data);
    }

    function jobDepart($id = NULL) {

        if($this->is_api) {
            if(!Input::has('order_id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('order_id');
        }

        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $job = $this->order->find($id);

        if($job->delivery_driver_id != $this->user_id && $this->user_id != $job->user_id) {
            if($this->is_api) {
                return \Api::access_denied();
            }
            return redirect()->route('order-detail', [\HashId::encode($id, 'orders')]);
        }
        if($this->request->has('fullScreen')) {
            return $this->showMap($job);
        }

        //if(\Gate::allows('notOwner', $job)) {
        if($job->user_id != $this->user_id && $job->delivery_driver_id == $this->user_id && $job->status == config('constant_settings.ORDER_STATUS.PAYMENT_PAYED')) {
            $this->order->updateOrderStatus($id, config('constant_settings.ORDER_STATUS.READY_TO_DEPART'));

            $attributes = array(
                'resource_id' => $job->user_id,
                'subject_id'  => $this->user_id,
                'object_id'   => $job->id,
                'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.JOB.NAME'),
                'type'        => \Config::get('constant_notifications.OBJECT_TYPES.JOB.ACTIONS.READY_TO_DEPART'),
            );

            \Event::fire(new Notification($attributes));
        }
        $data = $this->getOrderDetails($id);

        if($this->is_api) {
            $allData = $this->getOrderDetail((object)$data[ 'order' ], $this->user_id);
            unset($allData[ 'items' ]);
            return \Api::success_data($allData);
        }
        return view('jobs.job_in_progress_depart', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param null $id
     *
     * @return \Illuminate\Http\Response
     */
    public function delivered($id = NULL) {
        if($this->is_api) {
            if(Input::has('order_id')) {
                $id = Input::get('order_id');
            } else {
                return \Api::invalid_param();
            }

        }

        $id  = \Hashids::connection('orders')->decode($id)[ 0 ];
        $job = $this->order->find($id);
        if($this->request->has('fullScreen')) {
            return $this->showMap($job);
        }
        if($job->status == config('constant_settings.ORDER_STATUS.RECEIVED')) {
            if($this->is_api) {
                return \Api::detail_not_found();
            }
            return redirect()->route('received', [\Hashids::connection('orders')->encode($id)]);
        }
        //if(\Gate::allows('notOwner', $job)) {
        if($job->user_id != $this->user_id && $job->delivery_driver_id == $this->user_id) {

            $updated = $this->order->updateOrderStatus($id, config('constant_settings.ORDER_STATUS.DELIVERED'));
            if($updated) {

                $type = \Config::get('constant_settings.STATEMENT_TYPES.SALE');
                $this->order->updateStatement($type, 'order', $id, 'credit', 'USD', $this->user_id);
            }
            $attributes = array(
                'resource_id' => $job->user_id,
                'subject_id'  => $this->user_id,
                'object_id'   => $job->id,
                'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.JOB.NAME'),
                'type'        => \Config::get('constant_notifications.OBJECT_TYPES.JOB.ACTIONS.DELIVERED'),
            );

            \Event::fire(new Notification($attributes));
        }
        $data = $this->getOrderDetails($id);

        $user = User::find($data[ 'order' ]->user_id);

        //$feedback = Feedback::where('user_id' , $user->id)->first();

        $data[ 'ratting' ]           = ($user->averageRating > 0 ? $user->averageRating : 0);
        $data[ 'feedback' ]          = $this->order->getFeedback($id, $this->user_id);
        $data[ 'myFeedback' ]        = $this->order->getMyFeedback($id, $this->user_id);
        $data[ 'is_feedback_given' ] = $this->order->isFeedbackGiven($id, $this->user_id);

        if($this->is_api) {

            $allData                        = $this->getOrderDetail((object)$data[ 'order' ], $this->user_id);
            $allData[ 'feedback' ]          = $data[ 'feedback' ];
            $allData[ 'myFeedback' ]        = $data[ 'myFeedback' ];
            $allData[ 'is_feedback_given' ] = $data[ 'is_feedback_given' ];
            unset($allData[ 'items' ]);
            return \Api::success_data($allData);
        }

        return view('jobs.job_in_progress_depart', $data);
        //return view('jobs.jobs_delivered', $data);
    }

    public function received($id = NULL, $type = NULL) {
        if($this->is_api) {
            if(Input::has('order_id')) {
                $id = Input::get('order_id');
            } else {
                return \Api::invalid_param();
            }
        }
        $id  = \Hashids::connection('orders')->decode($id)[ 0 ];
        $job = $this->order->find($id);
        if($job->user_id != $this->user_id && $job->delivery_driver_id != $this->user_id){
            return redirect()->back();
        }
        if($job->status == \Config::get('constant_settings.ORDER_STATUS.DELIVERED') && ($job->user_id == $this->user_id || (!is_null($type) && $type == "by_pin" && $job->delivery_driver_id == $this->user_id))) {
            $this->order->updateTransaction($id, $job->delivery_driver_id, 'order');
            $data = ['status' => \Config::get('constant_settings.ORDER_STATUS.RECEIVED')];
            $this->order->update($data, $id);
            if(is_null($type)) {
                $attributes = array(
                    'resource_id' => $job->delivery_driver_id,
                    'subject_id'  => $this->user_id,
                    'object_id'   => $job->id,
                    'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.JOB.NAME'),
                    'type'        => \Config::get('constant_notifications.OBJECT_TYPES.JOB.ACTIONS.RECEIVED'),
                );
                \Event::fire(new Notification($attributes));
            }
        }
        $data = $this->getOrderDetails($id);

        $user = User::find($data[ 'order' ]->user_id);

        //$feedback = Feedback::where('user_id' , $user->id)->first();
        $data[ 'ratting' ]           = ($user->averageRating > 0 ? $user->averageRating : 0);
        $data[ 'feedback' ]          = $this->order->getFeedback($id, $this->user_id);
        $data[ 'myFeedback' ]        = $this->order->getMyFeedback($id, $this->user_id);
        $data[ 'is_feedback_given' ] = $this->order->isFeedbackGiven($id, $this->user_id);

        if($this->is_api) {

            $allData                        = $this->getOrderDetail((object)$data[ 'order' ], $this->user_id);
            $allData[ 'feedback' ]          = $data[ 'feedback' ];
            $allData[ 'myFeedback' ]        = $data[ 'myFeedback' ];
            $allData[ 'is_feedback_given' ] = $data[ 'is_feedback_given' ];
            unset($allData[ 'items' ]);
            return \Api::success_data($allData);
        }

        return view('jobs.jobs_delivered', $data);
        //return redirect()->back();
    }


    public function feedback(Request $request) {

        if(!$request->has('order_id') || !$request->has('ratting')) {
            if($this->is_api) {
                return \Api::invalid_param();
            }
        }
        if($request->ratting == 0){
            if($this->is_api) {
                return \Api::other_error('Please select ratting');
            }

            return [
                'error'=>1,
                'message'=>'Please select ratting'
            ];
        }
        $id = $request->get('order_id');

        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $order = Order::find($id);

        $user   = User::find($order->user_id);
        $result = $this->isRated($user->id, $id, $this->user_id);

        if(!$result) {
            $rating         = new Rating();
            $rating->rating = $request->ratting;

            $rating->feedback = $request->get('feedback');
            $rating->user_id  = $this->user_id;
            $rating->order_id = $id;
            $user->ratings()->save($rating);
            $data[ 'ratting' ] = $user->averageRating;
            $user->rating      = $data[ 'ratting' ];
            $user->save();
            $data[ 'status' ] = 1;
            if($this->is_api) {
                return \Api::success_with_message("Feedback given successfully");
            }
            return $data;

        }
        $data[ 'status' ] = 2;
        if($this->is_api) {
            return \Api::already_rated("Feedback already given");
        }
        return $data;

    }

    public function feedbackClient(Request $request) {
        if(!$request->has('bid_id') || !$request->has('ratting')) {
            if($this->is_api) {
                return \Api::invalid_param();
            }
        }
        if($request->ratting == 0){
            if($this->is_api) {
                return \Api::other_error('Please select ratting');
            }

            return [
                'error'=>1,
                'message'=>'Please select ratting'
            ];
        }
        $id = $request->get('bid_id');
        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $bidId  = OrderBid::find($id);
        $user   = User::find($bidId->bidder_id);
        $result = $this->isRated($user->id, $id, $this->user_id);
        if(!$result) {
            $rating           = new Rating();
            $rating->rating   = $request->ratting;
            $rating->feedback = $request->get('feedback');
            $rating->user_id  = $this->user_id;
            $rating->order_id = $bidId->order_id;

            $user->ratings()->save($rating);

            $data[ 'ratting' ] = $user->averageRating;
            $user->rating      = $data[ 'ratting' ];
            $user->save();
            $data[ 'status' ] = 1;
            if($this->is_api) {
                return \Api::success(['data' => $data]);
            }
            return $data;
        }
        $data[ 'status' ] = 2;
        if($this->is_api) {
            return \Api::already_rated(['data' => $data]);
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function checklist(Request $request) {
        if(!$request->has('id')) {
            if($this->is_api) {
                return \Api::invalid_param();
            }
        }

        $id = $request->id;
        if(!$this->is_api) {
            $id = \Hashids::connection('orders')->decode($id)[ 0 ];
        }

        $item = OrderItem::find($id);

        $item->status = $request->purchased;
        $item->save();

        if($this->is_api) {
            return \Api::success_with_message();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param null $other
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function myProposals($other = NULL) {
        if($this->is_api) {
            if(Input::has('other')) {
                return $this->awardedToOther();
            }
        } elseif(!is_null($other)) {
            return $this->awardedToOther();
        }

        $data[ 'title' ] = 'My Proposals';

        $data[ 'myJobs' ] = $this->bidRepository->myProposals($this->user_id);

        if($this->is_api) {

            $jobs = $this->parseJobdetail($data[ 'myJobs' ], $this->user_id, $this->user);

            return \Api::success_list($jobs);

        }
        return view('jobs.my_jobs', $data);
    }

    private function getOrderDetails($id) {

        $data[ 'title' ] = 'Job in progress';
        $data[ 'order' ] = $this->order->find($id);
        if(!empty($data[ 'order' ])) {
            $data[ 'items' ]       = $data[ 'order' ]->items;
            $data[ 'selectedBid' ] = $data[ 'order' ]->selectedBid;
            $data[ 'owner' ]       = $data[ 'order' ]->owner;
        }

        return $data;
    }

    private function isRated($target_user, $id, $user_id) {
        return Rating::where('rateable_id', $target_user)->where('user_id', $user_id)->where('order_id', $id)->first();
    }

    public function showFeedback($id = NULL) {
        if($this->is_api) {
            if(!Input::has('id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('id');
        }

        $id   = \Hashids::connection('orders')->decode($id)[ 0 ];
        $data = $this->order->showFeedback($id, $this->user_id);

        $data[ 'order_id' ] = \HashId::encode($id, 'orders');

        if($this->is_api) {
            return \Api::success_list($data);
        }
        return view('feedback.show-feedback', $data);
    }

    public function saveJob() {

        $order_id = \Hashids::connection('orders')->decode($this->request->order_id)[ 0 ];
        if($this->request->type == 'add') {
            $data = [
                'object_type' => 'order',
                'object_id'   => $order_id,
            ];

            $this->addToFavourite($data, $this->user_id);
            if($this->is_api) {
                return \Api::success_with_message('add favourite job successfully');
            }
            return 1;
        } else {
            //return $order_id;
            $this->removeFavouritesByUserId($order_id, $this->user_id, 'order');
            if($this->is_api) {
                return \Api::success_with_message('remove favourite job successfully');
            }
            return 2;
        }
    }

    public function favourites() {

        $data[ 'title' ] = 'My saved jobs';
        $data[ 'jobs' ]  = $this->getSavedJobs($this->user_id);

        if($this->is_api) {
            //$data['myJobs']= $this->getSavedApiJobs($this->user_id);
            $myJobs = $this->getSavedOrderApiJobs($this->user_id);
            $fav    = $this->parseJobFavourite($myJobs, $this->user_id, $this->user);

            return \Api::success_list($fav);
        }
        return view('jobs.my_favourites', $data);
    }

    public function removeFavourite($id = NULL) {

        if($this->is_api) {
            if(!Input::has('id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('id');
        }
        $id = \Hashids::connection('orders')->decode($id)[ 0 ];
        $this->removeFavourites($id);
        if($this->is_api) {
            return \Api::success_with_message('favourite job remove successfully');
        }
        return redirect()->back();
    }

    private function showMap($job) {
        $data[ 'order' ] = $job;
        return view('full-screen-map.direction', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    private function allJobs() {
        $data[ 'title' ]  = 'All My Jobs';
        $data[ 'myJobs' ] = $this->bidRepository->allJobs($this->user_id);
        if($this->is_api) {
            $jobs = $this->parseJobdetail($data[ 'myJobs' ], $this->user_id, $this->user);
            return \Api::success_list($jobs);

        }
        return view('jobs.my_jobs', $data);
    }

    private function awardedToOther() {
        $data[ 'title' ]  = 'Awarded to Other';
        $data[ 'myJobs' ] = $this->bidRepository->myProposalsAwardedToOther($this->user_id);
        if($this->is_api) {
            $jobs = $this->parseJobdetail($data[ 'myJobs' ], $this->user_id, $this->user);

            return \Api::success_list($jobs);
        }
        return view('jobs.my_jobs', $data);
    }

    public function completed() {
        $data[ 'title' ] = $this->title;

        $data[ 'myJobs' ] = $this->bidRepository->completedJobs($this->user_id);
        if($this->is_api) {
            $jobs = $this->parseJobdetail($data[ 'myJobs' ], $this->user_id, $this->user);
            return \Api::success_list($jobs);
        }
        return view('jobs.my_jobs', $data);
    }

    public function gatLat() {
        if(!Input::has('driver_id')) {
            if($this->is_api) {
                return \Api::invalid_param();
            }
        }
        $id = Input::get('driver_id');
        // $id   = \Hashids::connection('favourite')->decode($id)[ 0 ];
        $data = DriverLatLng::where('driver_id', $id)->first();
        return \Api::success_data($data);

    }

    public function saveLat() {
        if($this->is_api) {
            if(!Input::has('latitude') || !Input::has('longitude')) {
                if($this->is_api) {
                    return \Api::invalid_param();
                }
            }
        }
        $id         = $this->user_id;
        $driverInfo = DriverLatLng::where('driver_id', $this->user_id)->first();
        $latitude   = Input::get('latitude');
        $longitude  = Input::get('longitude');
        if(count($driverInfo) > 0) {
            $driverInfo->driver_id = $id;
            $driverInfo->latitude  = $latitude;
            $driverInfo->longitude = $longitude;
            $driverInfo->save();
            return \Api::success_with_message('update record successfully');
        } else {
            $driverInfo            = new DriverLatLng();
            $driverInfo->driver_id = $id;
            $driverInfo->latitude  = $latitude;
            $driverInfo->longitude = $longitude;
            $driverInfo->save();
            return \Api::success_with_message('add record successfully');
        }
    }

    public function getDepartJobs() {
        $user_id        = $this->user_id;
        $data[ 'Jobs' ] = Order::where('delivery_driver_id', $user_id)->where('status', 2)->count();
        return \Api::success_data($data);
    }

    public function deliveredByPin() {
        $data   = $this->request->all();
        $result = $this->order->deliveredByPin($this->user_id, $data);
        if($result[ 'error' ] == 0) {
            return redirect()->route('received', [$result[ 'job_id' ], 'by_pin']);
        } else {
            return redirect()->back()->with($result[ 'type' ], $result[ 'msg' ]);
        }

    }

}

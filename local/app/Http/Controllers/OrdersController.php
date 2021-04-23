<?php

namespace App\Http\Controllers;

use App\Classes\AuthorizeNet;
use App\Classes\Worldpay;
use App\Events\Notification;
use App\OrderBid;
use App\Traits\OrderDetailsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Repositories\OrderBidRepository;
use Repositories\OrderRepository as Order;

class OrdersController extends Controller
{
    use OrderDetailsTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user_id;
    private   $order;
    /**
     * @var \Repositories\OrderBidRepository
     */
    private $bidRepository;
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;
    private $is_api;
    private $title;
    private $user;

    public function __construct(Request $request, Order $order, OrderBidRepository $bidRepository) {
        $this->order = $order;

        $this->user_id = $request[ 'middleware' ][ 'user_id' ];
        $this->user    = $request[ 'middleware' ][ 'user' ];
        $this->is_api  = $request[ 'allData' ][ 'is_api' ];
        $this->title   = 'My Orders';

        $this->bidRepository = $bidRepository;
        $this->request       = $request;
    }

    public function getPlaceOrder() {
        if($this->user->is('delivery.man')) {
            return redirect()->back()->with('error', 'You cannot place an order');
        }

        $data[ 'categories' ] = $this->order->getPlaceOrder();

        if($this->is_api) {
            return \Api::success($data);
        }
        $data[ 'title' ] = 'Place Order';
        return view('orders.place_an_order', $data);
    }

    public function allPlaceOrdersPlace(Request $request) {
        if($this->user->is('delivery.man')) {
            return redirect()->back()->with('error', 'You cannot place an order');
        }
        $messages  = [
            'item_name.*'  => 'Each item field must have item name',
            'item_price.*' => 'Each item price field must have item price',

        ];
        $validator = Validator::make($request->all(), [
            'title'                 => 'required',
            'order_description'     => 'required',
            'item_name.*'           => 'required',
            'item_price.*'          => 'min:1',
            'estimate_delivery_fee' => 'required|min:1',
        ], $messages);
        if($validator->fails()) {
            if($this->is_api) {
                return \Api::invalid_param();
            }
            return [
                'error'  => 1,
                'errors' => $validator->errors()->all()
            ];
        }
        $itemsPrice  = array_sum($request->item_price);
        $deliveryFee = $request->estimate_delivery_fee;
        $orderAmount = $itemsPrice + $deliveryFee;
        if($orderAmount > 9999.99) {
            if($this->is_api) {
                return \Api::other_error('Order amount must be less then 10000');
            }
            return [
                'error'   => 2,
                'message' => 'Order amount must be less then 10000'
            ];
        }

        $order = $this->order->placeOrder($request, $this->user_id);
        if($this->is_api) {
            $data    = $this->getOrderDetails($order->id);
            $allData = $this->getOrderDetail((object)$data[ 'order' ], $this->user_id);
            //$allData['feedback'] = $data[ 'feedback' ];
            //$allData['myFeedback'] = $data[ 'myFeedback' ];
            //$allData['is_feedback_given'] = $data[ 'is_feedback_given' ];
            unset($allData[ 'items' ]);
            return \Api::success_data($allData);
        }
        return [
            'error'   => 0,
            'message' => NULL
        ];
        //return redirect()->route('my-orders');
    }

    public function getOrderDetails($id) {
        $data[ 'title' ]       = 'Job in progress';
        $data[ 'order' ]       = $this->order->find($id);
        $data[ 'items' ]       = $data[ 'order' ]->items;
        $data[ 'selectedBid' ] = $data[ 'order' ]->selectedBid;
        return $data;
    }

    public function myOrders($type = NULL) {
        if($this->user->is('delivery.man')) {
            return redirect()->back()->with('error', 'You cannot place an order');
        }
        $this->order->archiveOrders($this->user_id);

        if(!is_null($type) && $type == 'completed') {
            $data[ 'orders' ] = $this->order->getCompleted($this->user_id, 'selectedBid');

        } elseif(Input::has('status') && Input::get('status') == 'archive') {
            $data[ 'orders' ] = $this->order->getAllArchives($this->user_id);
            //echo '<tt><pre>'; print_r($data); die;
        } elseif(Input::has('status') && Input::get('status') != 'all') {
            $data[ 'orders' ] = $this->order->filterOrder($this->user_id, Input::get('status'), 'DESC', 'selectedBid');
            //echo '<tt><pre>'; print_r($data); die;
        } else {
            // $data[ 'orders' ] = $this->order->allInProgress($this->user_id, 'DESC', 'selectedBid');
            $data[ 'orders' ] = $this->order->allOrders($this->user_id, 'DESC', 'selectedBid');
        }

        if(count($data[ 'orders' ]) > 0) {
            $orderIds = [];
            foreach ($data[ 'orders' ] as $order) {
                $orderIds[] = $order->id;
            }

            $data[ 'bidsCount' ] = $this->order->getBidsCount($orderIds);
        }

        if($this->is_api) {

            $orders = $this->getDetail($data[ 'orders' ]);

            return \Api::success_list($orders);
        }

        $data[ 'title' ] = $this->title;
        //echo '<tt><pre>'; print_r($data); die;
        return view('orders.my_orders', $data);
    }

    /**
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @Note: Get order detail by ID.
     */

    public function getOrder($id = NULL) {

        if($this->is_api) {
            if(!Input::has('order_id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('order_id');
        }

        $id              = \Hashids::connection('orders')->decode($id)[ 0 ];
        if($this->user->can('delivery.man')) {
            $data[ 'order' ] = $this->order->find($id);
        }else{
            $data[ 'order' ] = \App\Order::whereId($id)->withoutGlobalScopes()->first();
        }


        if($this->request->has('fullScreen')) {
            return $this->showMap($data[ 'order' ]);
        }
        if(empty($data[ 'order' ])) {
            //return redirect()->back()->with('error', 'Order is deleted or archived by purchaser');
        }
        $data[ 'items' ] = $data[ 'order' ]->items;
        $data[ 'owner' ] = $data[ 'order' ]->owner;

        if($this->is_api) {
            $data[ 'bids' ]        = [];
            $data[ 'myBid' ]       = [];
            $data[ 'selectedBid' ] = [];

        }
        if(\Gate::denies('placeBid', $data[ 'order' ])) {
            if($data[ 'order' ]->status != \Config::get('constant_settings.ORDER_STATUS.IN_PROCESS')) {
                $data[ 'selectedBid' ] = $data[ 'order' ]->selectedBid;
            } else {
                $data[ 'bids' ] = $data[ 'order' ]->bids;

                $range = $this->bidRepository->getBidsRange($id);

                $data[ 'maxBid' ]       = $range->MaxBid;
                $data[ 'minBid' ]       = $range->MINBid;
                $data[ 'maxItemValue' ] = $range->maxItemValue;
                $data[ 'minItemValue' ] = $range->minItemValue;
                $data[ 'totalBids' ]    = $range->totalBids;

            }
        } else {
            if($this->user->can('delivery.man')) {
                $data[ 'myBid' ]       = $this->bidRepository->getMyBid($this->user_id, $id);
                $data[ 'selectedBid' ] = $data[ 'order' ]->selectedBid;

            }
        }
        if($this->is_api) {
            unset($data[ 'order' ]->items);
            unset($data[ 'order' ]->owner);
            unset($data[ 'order' ]->bids);

            $order            = $this->getOrderDetail($data[ 'order' ]);
            $order[ 'items' ] = $data[ 'items' ];
            $order[ 'owner' ] = $data[ 'owner' ];
            $order[ 'bids' ]  = $data[ 'bids' ];
            if(isset($data[ 'maxBid' ]) && isset($data[ 'minBid' ])) {
                $order[ 'maxBid' ] = $data[ 'maxBid' ];
                $order[ 'minBid' ] = $data[ 'minBid' ];

                $order[ 'maxItemValue' ] = $data[ 'maxItemValue' ];
                $order[ 'minItemValue' ] = $data[ 'minItemValue' ];
                $order[ 'totalBids' ]    = $data[ 'totalBids' ];
            } else {
                $data[ 'maxBid' ]        = [];
                $data[ 'minBid' ]        = [];
                $data[ 'maxItemValue' ]  = [];
                $order[ 'minItemValue' ] = [];
                $order[ 'totalBids' ]    = [];

            }
            $order[ 'myBid' ] = $data[ 'myBid' ];
            return \Api::success_data($order);
        }
        $order[ 'driver' ] = $data[ 'order' ]->driver;
        $data[ 'title' ]   = 'Order Detail';
        if(\Auth::check()) {
            return view('orders.order-details', $data);
        } else {
            return view('orders.order-details-share', $data);
        }
    }

    private function showMap($order) {
        $data[ 'order' ]   = $order;
        $order[ 'driver' ] = $data[ 'order' ]->driver;
        return view('full-screen-map.direction', $data);
    }

    public function viewMap($lat, $lng, $user_type) {
        $data[ 'lat' ]      = $lat;
        $data[ 'lng' ]      = $lng;
        $data[ 'userType' ] = $user_type;
        return view('orders.view-map', $data);
    }

    public function placeBid(Request $request) {
        $data[ 'order_id' ] = \Hashids::connection('orders')->decode($request->get('order_id'))[ 0 ];
        $order              = \App\Order::find($data[ 'order_id' ]);

        //if(!\Gate::allows('approved', $order)) {
        if($this->user->approved == 0) {
            if($this->is_api) {
                return \Api::other_error("Your profile is not completed. Please review your profile and try again. Thanks");
            }
            return redirect()->back()->withInput()->with('error', 'Your profile is not completed. Please review your ' . \HTML::link('profile-setting', 'PROFILE') . ' and try again. Thanks');
        }

        $bid = $this->bidRepository->getMyBid($this->user_id, $data[ 'order_id' ]);
        if(empty($bid)) {
            $data[ 'bidder_id' ]           = $this->user_id;
            $data[ 'bid_amount' ]          = $request->get('delivery_fee');
            $data[ 'description' ]         = $request->get('description');
            $data[ 'proposed_item_value' ] = $request->get('item_value');

            $this->bidRepository->create($data);

            $attributes = array(
                'resource_id' => $order->user_id,
                'subject_id'  => $this->user_id,
                'object_id'   => $order->id,
                'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.ORDER.NAME'),
                'type'        => \Config::get('constant_notifications.OBJECT_TYPES.ORDER.ACTIONS.PLACE_BID'),
            );

            \Event::fire(new Notification($attributes));
        } else {
            if($this->is_api) {
                return \Api::other_error('Bid already placed against this order');
            }

            return redirect()->back()->with('error', 'Bid already placed against this order');
        }
        if($this->is_api) {
            $job = $this->bidRepository->mySingleJob($this->user_id, \HashId::deCode($request->get('order_id'), 'orders'));
            $job = $this->parseSingleItemDetail(get_object_vars($job), $this->user_id);
            return \Api::success_data($job);
        }

        return redirect()->route('order-detail', [$request->get('order_id')]);

    }

    public function getAllBids($id = NULL) {

        if($this->is_api) {
            $id = Input::get('order_id');
        }
        $id              = \Hashids::connection('orders')->decode($id)[ 0 ];
        $data[ 'order' ] = \App\Order::whereId($id)->with(['bids' => function ($query) {
            $query->orderByRaw('`status` = 1 ASC, `status` asc');
            //$query->where('status' ,'<>',\Config::get('constant_settings.BID_STATUS.REJECTED_PURCHASER'));
        }])->first();
        //$data[ 'order' ] = $this->order->find($id);

        if($data[ 'order' ]->status == \Config::get('constant_settings.ORDER_STATUS.PAYMENT_PAYED')) {
            if($this->is_api) {
                return $this->getSelectedBid();
            }
            // return redirect()->route('bid.detail', [\Hashids::connection('orders')->encode($id)]);
        }
        if(\Gate::denies('getBids', $data[ 'order' ])) {
            if($this->is_api) {
                return \Api::access_denied();
            }
            return redirect()->back();
        }

        $data[ 'owner' ] = $data[ 'order' ]->owner;
        $data[ 'bids' ]  = $data[ 'order' ]->bids;
        if($this->is_api) {
            $data[ 'data' ] = $data[ 'order' ];
            unset($data[ 'order' ]);
            return \Api::success($this->bidRepository->getBidsDetail($data));
        }
        $data[ 'title' ] = 'All Bids';
        return view('orders.all-bids', $data);
    }

    public function getSelectedBid($id = NULL) {
        if($this->is_api) {
            $id = Input::get('order_id');
        }

        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $data[ 'order' ]       = $this->order->find($id);
        $data[ 'selectedBid' ] = $data[ 'order' ]->selectedBid;

        $ratting            = $data[ 'order' ]->selectedBid->bidder->averageRating;
        $data[ 'ratting' ]  = ($ratting > 0 ? $ratting : 0);
        $data[ 'feedback' ] = $this->order->getFeedback($id, $this->user_id);
        if($this->is_api) {
            $data[ 'data' ] = $data[ 'order' ];
            unset($data[ 'order' ]);
            return \Api::success($this->bidRepository->getBidsDetail($data));
        }

        return view('orders.bid-detail', $data);
    }

    public function updateBid(Request $request, $id = NULL) {

        if($this->is_api) {
            if(!$request->has('bid_id')) {
                return \Api::invalid_param();
            }

            $id = Input::get('bid_id');
        }
        $id  = \Hashids::connection('orders')->decode($id)[ 0 ];
        $bid = $this->bidRepository->find($id);
        if($bid->bidder_id != $this->user_id) {
            if($this->is_api) {
                return \Api::access_denied();
            }

            return redirect()->back()->with('error', 'You are not allowed to update this bid');

        }

        $data[ 'bid_amount' ]          = $request->get('delivery_fee');
        $data[ 'description' ]         = $request->get('description');
        $data[ 'proposed_item_value' ] = $request->get('item_value');

        $this->bidRepository->update($data, $id);
        if($this->is_api) {
            $job = $this->bidRepository->mySingleJob($this->user_id, \HashId::deCode($request->get('order_id'), 'orders'));
            $job = $this->parseSingleItemDetail(get_object_vars($job), $this->user_id);
            return \Api::success_data($job);
        }
        //return redirect()->route('order-detail', [$request->get('order_id')]);
        return redirect()->back();

    }

    public function getBidDetail(OrderBidRepository $bidRepository, $id = NULL) {
        if($this->is_api) {
            if(!$this->request->has('bid_id')) {
                return \Api::invalid_param();
            }
            $id = $this->request->bid_id;
        }
        $id            = \Hashids::connection('orders')->decode($id)[ 0 ];
        $data[ 'bid' ] = $this->bidRepository->find($id);
        if($this->is_api) {
            return view('orders.payment-form-app', $data);
        }
        return view('orders.getBidForPayment', $data);
    }

    public function makeOrderPayment(Request $request, $id = NULL) {
        if($this->is_api) {
            if(!$request->has('order_id') || !$request->has('bid_id')) {
                return \Api::invalid_param();
            }
            $id = $request->get('order_id');
        }
        $id = \HashId::deCode($id, 'orders');

        $orderID            = $id;
        $data[ 'order_id' ] = $id;

        $bidId = \HashId::deCode($request->get('bid_id'), 'orders');

        $bidDetail = $this->bidRepository->find($bidId);

        $paymentTotal     = $bidDetail->proposed_item_value + $bidDetail->bid_amount;
        $data[ 'amount' ] = $paymentTotal;

        if($bidDetail->status == 1) {
            if($this->is_api) {
                return \Api::other_error('You already paid for this order');
            }
            return [
                'error'   => 1,
                'message' => 'You already paid for this order'
            ];
        }
        $service_key = \Config::get('constant_settings.WORLDPAY_SERVICE_KEY');

        $validator = Validator::make($request->all(), [
            'number' => 'required|numeric',
            'year'   => 'required|numeric',
            'month'  => 'required|numeric',
            'name'   => 'required',
            'cvc'    => 'required|numeric',
        ]);

        if($validator->fails()) {
            if($this->is_api){
                return \Api::other_error(implode(', ', $validator->errors()->all()));
            }
            return [
                'errors' => $validator->errors()->all(),
                'type'   => 'validation',
                'error'  => 2
            ];
        }

        if(\Config::get('constant_settings.DEFAULT_GATEWAY') == 'AUTHORIZE_NET') {
            $authorize = new AuthorizeNet();
            $orderDetail = \App\Order::find($orderID);
            $response  = $authorize->pay($request, ceil($paymentTotal), $this->user, $orderDetail);
            //echo '<tt><pre>'; print_r($response); die;
            if($response[ 'error' ] == 1) {
                if($this->is_api){
                    return \Api::other_error($response['message']);
                }
                return $response;
            } else {
                $response[ 'delivery_fee' ] = $bidDetail->bid_amount;
                $response[ 'order_amount' ] = $bidDetail->proposed_item_value;
                //echo '<tt><pre>'; print_r($response); die;
                $this->order->saveOrderPayment($response, $id, $bidDetail->proposed_item_value, $bidDetail->bid_amount);
                $data = ['status' => \Config::get('constant_settings.BID_STATUS.SELECTED')];
                $this->bidRepository->update($data, $bidId);
                $this->order->update([
                    'delivery_driver_id' => $bidDetail->bidder_id,
                    'status'             => \Config::get('constant_settings.ORDER_STATUS.PAYMENT_PAYED'),
                    'selected_bid_id'    => $bidId
                ], $orderID);

                $attributes = array(
                    'resource_id' => $bidDetail->bidder_id,
                    'subject_id'  => $this->user_id,
                    'object_id'   => $orderID,
                    'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.ORDER.NAME'),
                    'type'        => \Config::get('constant_notifications.OBJECT_TYPES.ORDER.ACTIONS.BID_SELECTED'),
                );

                \Event::fire(new Notification($attributes));
                if($this->is_api) {
                    return \Api::success_with_message('Order placed successfully');
                }
                return $response;
                //return redirect()->route('my-orders')->with('success', 'Order placed successfully');
            }
        } else {
            $world_pay = new Worldpay($service_key);

            $inputTokenWorldPay = $request->get('token');
        }

    }

    public function singleBid($id = NULL) {
        if($this->is_api) {
            $id = Input::get('bid_id');
        }

        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $data[ 'selectedBid' ] = OrderBid::find($id);
        $data[ 'order' ]       = $data[ 'selectedBid' ]->order;
        $ratting               = $data[ 'order' ]->owner->rating;
        $data[ 'ratting' ]     = ($ratting > 0 ? $ratting : 0);
        $data[ 'feedback' ]    = $this->order->getFeedback($data[ 'order' ]->id, $this->user_id);
        if($this->is_api) {
            $data[ 'data' ] = $data[ 'order' ];
            unset($data[ 'order' ]);
            return \Api::success($this->bidRepository->getBidsDetail($data));
        }

        return view('orders.bid-detail', $data);
    }

    public function bidDetail($id = NULL) {
        if($this->is_api) {
            $id = Input::get('order_id');
        }

        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $data[ 'order' ] = $this->order->find($id);

        $data[ 'selectedBid' ] = $this->bidRepository->getMyBid($this->user_id, $id);

        $data[ 'feedback' ] = $this->order->getFeedback($id, $this->user_id);
        if($this->is_api) {
            $data[ 'data' ] = $data[ 'order' ];
            unset($data[ 'order' ]);
            return \Api::success($this->bidRepository->getBidsDetail($data));
        }

        return view('orders.bid-detail', $data);
    }

    public function bidDetailDriver($id = NULL) {
        if($this->is_api) {
            $id = Input::get('order_id');
        }

        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $data[ 'order' ] = $this->order->find($id);

        $data[ 'selectedBid' ] = $this->bidRepository->getMyBid($this->user_id, $id);

        $data[ 'feedback' ] = $this->order->getFeedback($id, $this->user_id);
        if($this->is_api) {
            $data[ 'data' ] = $data[ 'order' ];
            unset($data[ 'order' ]);
            return \Api::success($this->bidRepository->getBidsDetail($data));
        }

        return view('orders.bid-detail-driver', $data);
    }

    public function edit($id = NULL) {
        if($this->is_api) {
            if(!Input::has('order_id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('order_id');
        }

        $id                   = \Hashids::connection('orders')->decode($id)[ 0 ];
        $data[ 'categories' ] = $this->order->getPlaceOrder();
        $data[ 'order' ]      = $this->order->find($id);
        $data[ 'items' ]      = $data[ 'order' ]->items;
        $data[ 'owner' ]      = $data[ 'order' ]->owner;
        $data[ 'title' ]      = "Update order";
        //echo '<tt><pre>'; print_r($data); die;
        return view('orders.update', $data);
    }

    public function update(Request $request, $id = NULL) {

        $messages  = [
            'item_name.*'  => 'Each item field must have item name',
            'item_price.*' => 'Each item price field must have item price',

        ];
        $validator = Validator::make($request->all(), [
            'title'                 => 'required',
            'order_description'     => 'required',
            'item_name.*'           => 'required',
            'item_price.*'          => 'min:1',
            'estimate_delivery_fee' => 'required|min:1',
        ], $messages);
        if($validator->fails()) {
            if($this->is_api) {
                return \Api::invalid_param();
            }
            return [
                'error'  => 1,
                'errors' => $validator->errors()->all()
            ];
        }
        $itemsPrice  = array_sum($request->item_price);
        $deliveryFee = $request->estimate_delivery_fee;
        $orderAmount = $itemsPrice + $deliveryFee;
        if($orderAmount > 9999.99) {
            if($this->is_api) {
                return \Api::other_error('Order amount must be less then 10000');
            }
            return [
                'error'   => 2,
                'message' => 'Order amount must be less then 10000'
            ];
        }

        if($this->is_api) {
            if(!Input::has('order_id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('order_id');
        }
        $id = \Hashids::connection('orders')->decode($id)[ 0 ];
        $this->order->updateOrder($request, $id);
        if($this->is_api) {
            return \Api::success_with_message('order Updated successfully');
        }
        return [
            'error'   => 0,
            'message' => NULL
        ];
    }

    public function delete($id = NULL) {
        if($this->is_api) {
            if(!Input::has('order_id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('order_id');
        }
        $id = \Hashids::connection('orders')->decode($id)[ 0 ];
        if(!$this->is_api) {
            $this->order->delete($id);
        }
        if($this->is_api) {
            $order = $this->order->orderApiDelete($id);
            if($order == 1) {
                return \Api::success_with_message('order deleted successfully');
            } else {
                return \Api::success_with_message('order not deleted');
            }

        }
        return redirect()->back();
    }

    public function archive($id = NULL) {

        if($this->is_api) {
            if(!Input::has('id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('id');
        }
        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $data = [
            'is_archive' => 1
        ];
        $this->order->update($data, $id);
        if($this->is_api) {
            return \Api::success_with_message('archive add successfully');
        }
        return redirect()->back();
    }

    public function archiveRemove($id = NULL) {
        if($this->is_api) {
            if(!Input::has('order_id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('order_id');
        }
        $ordId = $id;
        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $data = [
            'is_archive' => 0
        ];

        $this->order->removeArchive($data, $id);
        if($this->is_api) {
            return \Api::success_with_message('archive removed successfully');
        }
        return redirect('update-order/'.$ordId);
        //return redirect()->back();
    }

    public function getArchives() {
        $data[ 'title' ]  = 'All Archives';
        $data[ 'orders' ] = $this->order->getAllArchives($this->user_id);
        if($this->is_api) {
            $orders = $this->getDetail($data[ 'orders' ]);
            return \Api::success_list($orders);
        }
        return view('orders.my_orders', $data);
    }

    public function removeArchive($id = NULL) {

        if($this->is_api) {
            if(!Input::has('id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('id');
            $id = \Hashids::connection('orders')->decode($id);

        }
        if(!$this->is_api) {
            $id = \Hashids::connection('orders')->decode($id)[ 0 ];
        }
        $data = [
            'is_archive' => 0
        ];

        $this->order->update($data, $id);
        if($this->is_api) {
            return \Api::success_with_message('archive remove successfully');
        }
        return redirect()->back();
    }

    public function cancelBid($id = NULL) {
        $id  = \Hashids::connection('orders')->decode($id)[ 0 ];
        $bid = $this->bidRepository->find($id);
        $this->bidRepository->cancelBid($bid, $this->user_id);
        return redirect()->back();
    }

    public function rejectBid() {
        if($this->is_api){
            if(!$this->request->has('order_id') || !$this->request->has('bid_id')){
                return \Api::invalid_param();
            }
        }
        $orderId = \HashId::deCode($this->request->order_id, 'orders');
        $bidId   = \HashId::deCode($this->request->bid_id, 'orders');

        $orderDetail = \App\Order::find($orderId);
        if(empty($orderDetail)) {
            if($this->is_api){
                return \Api::other_error('Bid not found');
            }
            return redirect()->back()->with('error', 'Bid not found');
        }

            if($orderDetail->user_id != $this->user_id) {
                if($this->is_api) {
                    return \Api::access_denied();
                }
                return redirect()->back()->with('error', 'You cannot reject the bid');
            }
            $data = $this->order->rejectBid($bidId, $this->user_id, $this->request);
            if($data[ 'error' ] == 1) {
                if($this->is_api) {
                    return \Api::other_error($data[ 'message' ]);
                }
                return redirect()->back()->with('error', $data[ 'message' ]);
            }

            if($this->is_api) {
                return \Api::success_with_message($data[ 'message' ]);
            }
            return redirect()->back()->with('success', $data[ 'message' ]);

    }

    public function orderDetail() {
        if($this->is_api) {
            if(!Input::has('order_id')) {
                return \Api::invalid_param();
            }
        }

        $id    = $this->request->order_id;
        $id    = \HashId::deCode($id, 'orders');
        $order = \App\Order::find($id);
        if($this->user_id == $order->user_id) {
            $order = $this->getOrderDetail($order, TRUE, TRUE);
        } else {
            $order = $this->parseSingleItem($order, TRUE, TRUE);
            unset($order->bids);
        }

        return \Api::success_data($order);

    }

    public function getOrderShare($id = NULL) {

        if(\Auth::check()) {
            return redirect()->route('order-detail', [$id]);
        }
        if($this->is_api) {
            if(!Input::has('order_id')) {
                return \Api::invalid_param();
            }
            $id = Input::get('order_id');
        }

        $id = \Hashids::connection('orders')->decode($id)[ 0 ];

        $data[ 'order' ] = $this->order->find($id);
        if($this->request->has('fullScreen')) {
            return $this->showMap($data[ 'order' ]);
        }
        if(empty($data[ 'order' ])) {
            return redirect()->back()->with('error', 'Order is deleted or archived by purchaser');
        }
        $data[ 'items' ] = $data[ 'order' ]->items;
        $data[ 'owner' ] = $data[ 'order' ]->owner;

        $order[ 'driver' ] = $data[ 'order' ]->driver;
        $data[ 'title' ]   = 'Order Detail';
        //echo '<tt><pre>'; print_r($data); die;
        return view('orders.order-details-share', $data);
    }

    public function getReportReasons($id = NULL, $type = 'job') {
        if($this->is_api) {
            if($this->request->has('type') && !empty($this->request->get('type'))) {
                $type = $this->request->get('type');
            }
        }
        $data[ 'reasons' ] = $this->order->getFlagAllReasons($type);
        if($this->is_api) {
            return \Api::success_list($data[ 'reasons' ]);
        }
        $data[ 'object_id' ] = $id;
        $data[ 'type' ]      = $type;

        return view('orders.flag-popup', $data);
    }

    public function saveOrderFlag() {
        $data = $this->request->all();

        $result = $this->order->saveOrderFlag($data, $this->user_id, $data[ 'object_type' ]);
        if($this->is_api) {
            if($result[ 'type' ] == 'error') {
                return \Api::other_error($result[ 'message' ]);
            }
            return \Api::success_with_message($result[ 'message' ]);
        }
        return redirect()->back()->with($result[ 'type' ], $result[ 'message' ]);
    }

    //Repost Order

    public function rePostOrder($id) {
        $id         = \HashId::deCode($id, 'orders');
        $newOrderId = $this->order->rePOstOrder($id);
        if($newOrderId) {
            return redirect()->route('update-order', [$newOrderId]);
        }

        return redirect()->back()->with('error', 'Something went wrong. Please try again!');
    }

}

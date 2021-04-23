<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 10-Jun-16 5:05 PM
 * File Name    : OrderRepository.php
 */

namespace Repositories;

use App\Events\Notification;
use App\Feedback;
use App\Order;
use App\OrderBid;
use App\OrderItem;
use App\OrderPayment;
use App\SavedOrder;
use App\Traits\FlagInappropriate;
use App\Transaction;
use Carbon\Carbon;
use Repositories\Eloquent\Repository;

class OrderRepository extends Repository
{

    use FlagInappropriate;

    function model() {
        return 'App\Order';
    }

    public function delete($id) {
        Order::destroy($id);
    }

    public function getPlaceOrder() {

        $categoriesList = \DB::table('item_categories')->orderByRaw('sort_order ASC, name asc')->orderBy('name', 'ASC')->lists('name', 'id');
        //$categories     = [0=>'Other'];
        //$categoriesList =  $categoriesList + $categories;
        //echo '<tt><pre>'; print_r($categoriesList); die;
        return $categoriesList;
    }

    public function placeOrder($request, $user_id) {

        $order = [];

        $order[ "title" ]                 = $request->title;
        $order[ "order_description" ]     = $request->order_description;
        $order[ "category_id" ]           = $request->categories;
        $order[ "estimate_delivery_fee" ] = $request->estimate_delivery_fee;
        $order[ "delivery_location" ]     = $request->delivery_location;
        if(\URLFilter::filter()) {
            $order[ "deliver_date_time" ] = Carbon::parse($request->datepicker)->format('Y-m-d H:i:s');
        } else {
            //$createdAt                    = date('Y-m-d', strtotime($request->datepicker));
            $order[ "deliver_date_time" ] = Carbon::parse($request->datepicker . ' ' . $request->delivery_time)->format('Y-m-d H:i:s');
        }

        $order[ "latitude" ]         = $request->latitude;
        $order[ "longitude" ]        = $request->longitude;
        $order[ "pick_up_latitude" ] = $request->pickUpLatitude;
        if(empty($request->pickUpLatitude)) {
            $order[ "pick_up_latitude" ] = $request->latitude;
        }
        $order[ "pick_up_longitude" ] = $request->pickUpLongitude;
        if(empty($request->pickUpLongitude)) {
            $order[ "pick_up_longitude" ] = $request->longitude;
        }
        if(\URLFilter::filter()) {
            $order[ "pick_up_time" ] = Carbon::parse($request->pickTime)->format('Y-m-d H:i:s');
        } else {
            //$createdAt               = date('Y-m-d', strtotime($request->pickTime));
            $order[ "pick_up_time" ] = Carbon::parse($request->pickTime . ' ' . $request->pickup_time)->format('Y-m-d H:i:s');
        }
        $order[ "pick_up_location_address" ] = isset($request->pickUp_location) ? $request->pickUp_location : '  ';
        $order[ "pick_up_location" ]         = (isset($request->pickUp) ? $request->pickUp : '0');
        $order[ 'item_value' ]               = array_sum($request->item_price);

        $order[ "user_id" ] = $user_id;

        $order             = Order::create($order);
        $order->pin_number = \HashId::encode($order->id, 'pin_number');
        $order->save();
        $this->saveOrderItems($order->id, $request->item_name, $request->item_price);
        return $order;

    }

    private function saveOrderItems($id, $item_name, $item_price) {
        $this->deleteItems($id);
        foreach ($item_name as $index => $name) {
            if(!empty($name)) {
                $orderItem = new OrderItem();

                $orderItem->name     = $name;
                $orderItem->price    = $item_price[ $index ];
                $orderItem->order_id = $id;
                $orderItem->save();
            }
        }
    }

    private function deleteItems($id) {
        OrderItem::whereOrderId($id)->delete();
    }

    public function updateOrder($request, $order_id) {
        $order = [];

        $order[ "title" ]                 = $request->title;
        $order[ "order_description" ]     = $request->order_description;
        $order[ "category_id" ]           = $request->categories;
        $order[ "estimate_delivery_fee" ] = $request->estimate_delivery_fee;
        $order[ "delivery_location" ]     = $request->delivery_location;

        if(\URLFilter::filter()) {
            $order[ "deliver_date_time" ] = Carbon::parse($request->datepicker)->format('Y-m-d H:i:s');
        } else {
            $order[ "deliver_date_time" ] = Carbon::parse($request->datepicker . ' ' . $request->delivery_time)->format('Y-m-d H:i:s');
        }

        $order[ "latitude" ]         = $request->latitude;
        $order[ "longitude" ]        = $request->longitude;
        $order[ "pick_up_latitude" ] = $request->pickUpLatitude;

        if(empty($request->pickUpLatitude)) {
            $order[ "pick_up_latitude" ] = $request->latitude;
        }
        $order[ "pick_up_longitude" ] = $request->pickUpLongitude;
        if(empty($request->pickUpLongitude)) {
            $order[ "pick_up_longitude" ] = $request->longitude;
        }

        if(\URLFilter::filter()) {
            $order[ "pick_up_time" ] = Carbon::parse($request->pickTime)->format('Y-m-d H:i:s');
        } else {
            $order[ "pick_up_time" ] = Carbon::parse($request->pickTime . ' ' . $request->pickup_time)->format('Y-m-d H:i:s');
        }
        $order[ "pick_up_location_address" ] = $request->pickUp_location;
        $order[ "pick_up_location" ]         = (isset($request->pickUp) ? $request->pickUp : '0');
        $order[ 'item_value' ]               = array_sum($request->item_price);

        $this->update($order, $order_id);

        $this->saveOrderItems($order_id, $request->item_name, $request->item_price);
        return $order;
    }

    public function getAllBid($user_id) {

        $orders = Order::get();
        return $orders;
    }

    public function allOpenedJobs($user_id, $page) {
        return Order::active()
                    ->where('status', 0)
                    ->where('user_id', '!=', $user_id)
                    ->with('category')
                    //->with('owner')
                    ->with(['myBid' => function ($query) use ($user_id) {
                        $query->where('bidder_id', $user_id);
                    }])->with(['favourite' => function ($query) use ($user_id) {
                $query->where('object_type', 'order')
                      ->where('user_id', $user_id);
            }])
                    ->orderBy('id', 'DESC')->paginate($page);

    }

    public function viewMoreJobs($user_id, $page) {
        $take = 10;
        if($page == 10) {
            $skip = 10;
        } else {
            $skip = $page - $take;
        }

        return Order::active()
                    ->where('status', 0)
                    ->where('user_id', '!=', $user_id)
                    ->with('category')
                    ->with('ownerWithRating')
                    ->orderBy('id', 'DESC')
                    ->take($take)
                    ->skip($skip)
                    ->get();

    }

    public function saveOrderPayment($response, $id, $item_value, $delivery_fee) {
        $transaction = new OrderPayment();

        $transaction->order_id         = $id;
        $transaction->gateway_id       = \Config::get('constant_settings.PAYMENT_GATEWAY.' . \Config::get('constant_settings.DEFAULT_GATEWAY') . '.ID');
        $transaction->type             = $response[ 'account_type' ];
        $transaction->state            = $response[ 'paymentStatus' ];
        $transaction->transaction_code = $response[ 'trans_id' ];
        $transaction->amount           = $response[ 'amount' ];
        $transaction->currency         = 'USD';
        $transaction->order_amount     = $item_value;
        $transaction->delivery_fee     = $delivery_fee;
        $transaction->response_object  = serialize($response);

        if($transaction->save()) {
            // $this->updateOrderStatus($id, \Config::get('constant_settings.ORDER_STATUS.PAYMENT_PAYED'));
        }
    }

    public function updateOrderStatus($id, $status) {
        $data = [
            'status' => $status
        ];
        if($this->update($data, $id)) {

            return TRUE;
        };
        return FALSE;

    }

    public function updateStatement($type, $parent, $order_id, $transaction_type, $currency, $user_id) {
        $sale = \Config::get('constant_settings.STATEMENT_TYPES.SALE');

        if($type == $sale) {
            // $order = $this->find($order_id);
            if($type == $sale) {
                $payment = OrderPayment::whereOrderId($order_id)->first();
                $amount  = $payment->amount;
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
            //$stObj->status           = 1;
            $stObj->save();
        }
        return TRUE;
    }

    private function alreadyExist($parent, $type, $order_id, $transaction_type, $user_id) {
        return Transaction::where('parent_type', $parent)
                          ->where('type', $type)
                          ->where('parent_id', $order_id)
                          ->where('transaction_type', $transaction_type)
                          ->where('user_id', $user_id)
                          ->count();
    }

    public function isFeedbackGiven($id, $user_id) {
        return Feedback::whereUserId($user_id)->whereOrderId($id)->first();
    }

    public function filterOrder($user_id, $status, $order, $relation) {

        $query = Order::whereUserId($user_id)
                      ->whereStatus($status)
                      ->with($relation)
                      ->orderBy('id', $order);
        if(\URLFilter::filter()) {
            return $query->get();
        } else {
            return $query->paginate(12);
        }

    }

    public function allOrders($user_id, $order, $relation) {

        $query = Order::whereUserId($user_id)
                      ->with($relation)
                      ->orderBy('updated_at', $order);
        if(\URLFilter::filter()) {
            return $query->get();
        } else {
            return $query->paginate(12);
        }
    }

    public function allInProgress($user_id, $order, $relation) {

        $query = Order::whereUserId($user_id)
                      ->where('status', '<>', \Config::get('constant_settings.ORDER_STATUS.RECEIVED'))
                      ->with($relation)
                      ->orderBy('id', $order);
        if(\URLFilter::filter()) {
            return $query->get();
        } else {
            return $query->paginate(12);
        }
    }

    public function orderApiDelete($id) {
        $order = Order::where('status', 0)->delete($id);
        if($order > 0) {
            return 1;
        } else {
            return 0;
        }

    }

    public function showFeedback($id, $user_id) {
        $data[ 'myFeedback' ]     = $this->getMyFeedback($id, $user_id);
        $data[ 'clientFeedback' ] = $this->getFeedback($id, $user_id);

        return $data;
    }

    public function getMyFeedback($id, $userId) {
        return Feedback::whereOrderId($id)->whereRateableId($userId)->first();
    }

    public function getFeedback($id, $userId) {
        return Feedback::whereOrderId($id)->whereUserId($userId)->first();
    }

    public function updateTransaction($id, $delivery_driver_id, $type) {

        $transaction = Transaction::whereUserId($delivery_driver_id)
                                  ->whereParentType($type)
                                  ->whereParentId($id)
                                  ->first();
        //echo '<tt><pre>'; print_r($transaction); die;
        $transaction->status = 1;
        $transaction->save();
        return TRUE;
    }

    public function saveOrder($order_id, $user_id) {
        $isSaved = $this->isSavedOrder($order_id, $user_id);
        if($isSaved == 0) {
            $saveOrder = new SavedOrder();

            $saveOrder->user_id  = $user_id;
            $saveOrder->order_id = $order_id;
            $saveOrder->save();
        }
        return TRUE;
    }

    private function isSavedOrder($order_id, $user_id) {
        return SavedOrder::whereOrderId($order_id)->whereUserId($user_id)->count();
    }

    public function getSavedJobs($user_id) {
        return SavedOrder::whereUserId($user_id)->with('order.owner')->paginate(25);
    }

    public function removeFavourite($id) {
        SavedOrder::destroy($id);
        return TRUE;
    }

    public function getBidsCount($orderIds) {
        return OrderBid::selectRaw('COUNT(order_id)  as count, order_id')
                       ->whereIn('order_id', $orderIds)
                       ->groupBy('order_id')
                       ->get()
                       ->keyBy('order_id')
                       ->toArray();
    }

    public function getCompleted($user_id, $relation) {
        $query = Order::whereUserId($user_id)
                      ->with($relation)
                      ->whereStatus(\Config::get('constant_settings.ORDER_STATUS.RECEIVED'))
                      ->orderBy('id', 'DESC');
        if(\URLFilter::filter()) {
            return $query->get();
        } else {
            return $query->paginate(12);
        }
    }

    public function getAllArchives($user_id) {
        $data = Order::whereIsArchive(1)
                     ->withoutGlobalScopes()
                     ->with('selectedBid')
                     ->with('bids')
                     ->whereUserId($user_id)
                     ->orderBy('updated_at', 'DESC');
        if(\URLFilter::filter()) {
            return $data->get();
        } else {
            return $data->paginate(12);
        }
    }

    public function removeArchive($data, $id) {
        $Order             = Order::withoutGlobalScopes()->whereId($id)->first();
        $Order->is_archive = 0;
        $Order->save();
        return TRUE;
    }

    public function archiveOrders($user_id) {
        Order::whereUserId($user_id)
             ->whereStatus(\Config::get('constant_settings.ORDER_STATUS.IN_PROCESS'))
             ->where('deliver_date_time', '<=', Carbon::now())
             ->update(['is_archive' => 1]);

    }

    public function rejectBid($bidId, $userID, $data) {
        $bidData = OrderBid::find($bidId);

        if(empty($bidData)) {
            return [
                'error'   => 1,
                'message' => 'Bid data not found'
            ];
        }
        $bidData->status          = \Config::get('constant_settings.BID_STATUS.REJECTED_PURCHASER');
        $bidData->rejected_reason = $data[ 'reason' ];
        $bidData->save();

        $attributes = array(
            'resource_id' => $bidData->bidder_id,
            'subject_id'  => $userID,
            'object_id'   => $bidData->id,
            'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.BID.NAME'),
            'type'        => \Config::get('constant_notifications.OBJECT_TYPES.BID.ACTIONS.REJECTED'),
        );

        \Event::fire(new Notification($attributes));
        return [
            'error'   => 0,
            'message' => 'Bid rejected successfully'
        ];
    }

    public function rePOstOrder($id) {
        $order = Order::whereId($id)->withoutGlobalScopes()->first();
        if(!empty($order)) {
            $newOrder = $order->replicate();

            $newOrder->deleted_at         = NULL;
            $newOrder->is_archive         = 0;
            $newOrder->delivery_driver_id = NULL;
            $newOrder->status             = 0;
            $newOrder->pin_number         =
                $newOrder->push();
            $newOrder->pin_number         = \HashId::encode($newOrder->id, 'pin_number');
            $newOrder->save();
            foreach ($order->items as $item) {
                $newItem           = $item->replicate();
                $newItem->order_id = $newOrder->id;
                $newItem->status   = 0;
                $newItem->save();
                //$newOrder->items()->attach($item);
            }
            return \HashId::encode($newOrder->id, 'orders');
        }
        return FALSE;
    }

    public function deliveredByPin($user_id, $data) {
        //$orderId = \HashId::deCode($data['job_id'],'orders');
        $order = $this->findBy('pin_number', $data[ 'pin_number' ]);
        if(empty($order)) {
            return [
                'error' => 1,
                'type'  => 'error',
                'msg'   => 'Job not found'
            ];
        } else {
            if($user_id != $order->delivery_driver_id) {
                return [
                    'error' => 1,
                    'type'  => 'error',
                    'msg'   => 'Permission denied'
                ];
            } else {
                return [
                    'error'  => 0,
                    'job_id' => $data[ 'job_id' ]
                ];
            }
        }
    }

}

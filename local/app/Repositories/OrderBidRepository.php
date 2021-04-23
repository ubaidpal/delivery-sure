<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 16-Jun-16 12:47 PM
 * File Name    : OrderBidRepository.php
 */

namespace Repositories;

use App\OrderBid;
use Repositories\Criteria\MyJobs;
use Repositories\Eloquent\Repository;

class OrderBidRepository extends Repository
{
    function model() {
        // TODO: Implement model() method.
        return 'App\OrderBid';
    }

    public function create(array $data) {
        $bid = new OrderBid();
        return $bid->create($data);
    }

    public function getAllBids($id) {
        return OrderBid::whereOrderId($id)->with('bidder')->orderBy('id', 'DESC')->get();
    }

    public function getMyBid($user_id, $id) {
        return OrderBid::whereOrderId($id)->whereBidderId($user_id)->first();
    }

    public function getBidsDetail($data) {
        $data[ 'data' ][ 'owner_name' ] = $data[ 'data' ][ 'owner' ][ 'display_name' ];
        $data[ 'data' ][ 'owner_url' ]  = $data[ 'data' ][ 'owner' ][ 'username' ];
        $data[ 'data' ][ 'order_id' ]   = \Hashids::connection('orders')->encode($data[ 'data' ]->id);
        unset($data[ 'data' ]->id);
        foreach ($data[ 'bids' ] as $item) {
            $data[ 'all_bids' ][] = $this->getBidDetail($item);
        }
        unset($data[ 'bids' ]);
        unset($data[ 'data' ][ 'owner' ]);
        unset($data[ 'data' ][ 'bids' ]);
        unset($data[ 'owner' ]);
        return $data;
    }

    private function getBidDetail($item) {
        $item[ 'bidder_url' ]  = $item[ 'bidder' ]->username;
        $item[ 'bidder_name' ] = $item[ 'bidder' ]->display_name;
        unset($item[ 'bidder' ]);
        return $item;
    }

    public function getBidsRange($id) {
        return OrderBid::select(\DB::raw('MAX(bid_amount)  as MaxBid, MIN(bid_amount) as MINBid, MAX(proposed_item_value) as maxItemValue, MIN(proposed_item_value) as minItemValue ,COUNT(id) as totalBids'))->whereOrderId($id)->first();
    }

    public function myJobs($user_id, $status = NULL) {
        $query = \DB::table('order_bids')
                    ->join('orders', 'orders.id', '=', 'order_bids.order_id')
                    ->join('users', 'users.id', '=', 'orders.user_id')
                    ->where('order_bids.status', config('constant_settings.BID_STATUS.SELECTED'))
                    ->where('order_bids.bidder_id', $user_id)
                    //->where('orders.status', '<>', config('constant_settings.ORDER_STATUS.RECEIVED'))
                    ->select(['orders.latitude as delivery_latitude','orders.longitude as delivery_longitude', 'orders.id as order_id', 'order_bids.id as bid_id', 'order_bids.bidder_id', 'order_bids.bid_amount', 'order_bids.proposed_item_value', 'order_bids.description as bid_description','order_bids.status as bid_status',  'users.*', 'users.id as clientId','orders.*'])
                    ->orderBy('orders.updated_at', 'DESC');
        if(!is_null($status)) {
            $query->where('orders.status', $status);
        }
        return $query->paginate(\Config::get('constant_settings.PAGINATE'));
    }
    public function completedJobs($user_id) {
        $query = \DB::table('order_bids')
            ->join('orders', 'orders.id', '=', 'order_bids.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('order_bids.status', config('constant_settings.BID_STATUS.SELECTED'))
            ->where('order_bids.bidder_id', $user_id)
            ->where('orders.status', config('constant_settings.ORDER_STATUS.RECEIVED'))
            ->select(['orders.latitude as delivery_latitude','orders.longitude as delivery_longitude','orders.id as order_id', 'order_bids.id as bid_id', 'order_bids.bidder_id', 'order_bids.bid_amount', 'order_bids.proposed_item_value', 'order_bids.description as bid_description', 'users.*', 'users.id as clientId','orders.*'])
            ->orderBy('orders.updated_at', 'DESC');

        return $query->paginate(\Config::get('constant_settings.PAGINATE'));
    }
    public function mySingleJob($user_id, $job_id) {
        return \DB::table('order_bids')
                  ->join('orders', 'orders.id', '=', 'order_bids.order_id')
                  ->join('users', 'users.id', '=', 'orders.user_id')
                  ->where('order_bids.bidder_id', $user_id)
                  ->where('orders.id', $job_id)
                  ->select([ 'orders.latitude as delivery_latitude','orders.longitude as delivery_longitude', 'orders.id as order_id', 'order_bids.id as bid_id', 'order_bids.bidder_id', 'order_bids.bid_amount', 'order_bids.proposed_item_value', 'order_bids.description as bid_description', 'users.*', 'users.id as clientId','orders.*'])
                  ->orderBy('orders.id', 'DESC')
                  ->first();
    }

    public function allJobs($user_id) {
        return \DB::table('order_bids')
                  ->join('orders', 'orders.id', '=', 'order_bids.order_id')
                  ->join('users', 'users.id', '=', 'orders.user_id')
            //->where('order_bids.status', config('constant_settings.BID_STATUS.SELECTED'))
                  ->where('order_bids.bidder_id', $user_id)
                  ->select([ 'orders.latitude as delivery_latitude','orders.longitude as delivery_longitude', 'orders.id as order_id', 'order_bids.id as bid_id', 'order_bids.bidder_id', 'order_bids.bid_amount', 'order_bids.proposed_item_value', 'order_bids.description as bid_description', 'users.*', 'users.id as clientId','orders.*'])
                  ->orderBy('orders.id', 'DESC')
                  ->get();
    }

    public function myProposals($user_id) {
        return \DB::table('order_bids')
                  ->join('orders', 'orders.id', '=', 'order_bids.order_id')
                  ->join('users', 'users.id', '=', 'orders.user_id')
            /*->where(function ($query) {
                $query->where('order_bids.status', config('constant_settings.BID_STATUS.NOT_SELECTED'))
                      ->orWhere('order_bids.status', config('constant_settings.BID_STATUS.CANCELED_DRIVER'));
            })*/
                  ->where('order_bids.status', config('constant_settings.BID_STATUS.NOT_SELECTED'))
                  ->where('orders.status', config('constant_settings.ORDER_STATUS.IN_PROCESS'))
                  ->where('order_bids.bidder_id', $user_id)
                  ->where('orders.is_archive', 0)
                  ->select([ 'orders.latitude as delivery_latitude','orders.longitude as delivery_longitude', 'orders.id as order_id', 'order_bids.id as bid_id', 'order_bids.bidder_id', 'order_bids.bid_amount', 'order_bids.proposed_item_value', 'order_bids.description as bid_description', 'users.*', 'users.id as clientId','orders.*'])
                  ->orderBy('orders.updated_at', 'DESC')
                  ->paginate(\Config::get('constant_settings.PAGINATE'));
    }

    public function myProposalsAwardedToOther($user_id) {
        return \DB::table('order_bids')
                  ->join('orders', 'orders.id', '=', 'order_bids.order_id')
                  ->join('users', 'users.id', '=', 'orders.user_id')
                  ->where(function ($query) {
                      $query->where('order_bids.status', config('constant_settings.BID_STATUS.NOT_SELECTED'))
                            ->orWhere('order_bids.status', config('constant_settings.BID_STATUS.CANCELED_DRIVER'));
                  })
                  ->where('order_bids.bidder_id', $user_id)
                  ->where('orders.delivery_driver_id', '<>', $user_id)
                  ->where('orders.is_archive', 0)
                  ->select(['orders.latitude as delivery_latitude','orders.longitude as delivery_longitude', 'orders.id as order_id', 'order_bids.id as bid_id', 'order_bids.bidder_id', 'order_bids.bid_amount', 'order_bids.proposed_item_value', 'order_bids.description as bid_description', 'users.*', 'users.id as clientId','orders.*'])
                  ->orderBy('orders.id', 'DESC')
                  ->paginate(\Config::get('constant_settings.PAGINATE'));
    }

    public function cancelBid($bid, $user_id) {

        if($bid->status == \Config::get('constant_settings.BID_STATUS.NOT_SELECTED')) {
            $bid->status = \Config::get('constant_settings.BID_STATUS.CANCELED_DRIVER');
            $bid->save();
        }

    }
}

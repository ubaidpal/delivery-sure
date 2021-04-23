<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 02-Jul-16 3:14 PM
 * File Name    : OrderDetails.php
 */

namespace App\Traits;

use App\Category;
use App\Feedback;
use App\OrderBid;
use App\OrderItem;
use App\Rating;
use App\User;
use Carbon\Carbon;

trait OrderDetailsTrait
{
    use UserDetail;

    public function getDetail($orders) {
        $allData = [];
        foreach ($orders as $order) {

            $data = $this->getOrderDetail($order, TRUE);

            $allData[] = $data;
        }
        return $allData;
    }

    public function getOrderDetail($order, $items = FALSE, $orderOwner = TRUE) {

        $orderDetail                          = $order;
        $orderDetail[ 'order_id' ]            = \HashId::encode($order->id, 'orders');
        $orderDetail[ 'order_id_invitation' ] = \HashId::encode($order->id, 'favourite');
        $orderDetail[ 'status' ]              = config('constant_settings.ORDER_STATUS_MSG.' . $order->status);
        $orderDetail[ 'category_name' ]       = getCategoryName($order->category_id);

        $bids         = $order->bids;
        $selected_bid = $order->selectedBid;
        $owner        = $order->owner;
        unset($order->owner);
        if(is_object($owner)) {
            $orderDetail[ 'owner' ] = $this->userDetail($owner);
        } else {
            if(isset($owner[ 'profile_picture' ])) {
                $orderDetail[ 'owner' ] = $owner;
            } else {
                $owner                  = User::find($order->user_id);
                $orderDetail[ 'owner' ] = $this->userDetail($owner);
            }

        }

        if($items) {
            $items                        = $this->getOrderItems($order->id);
            $orderDetail[ 'order_items' ] = $items;
        }
        unset($order[ 'id' ]);

        unset($order->bids);
        unset($order->selectedBid);
        if($orderOwner) {
            $orderDetail[ 'bids' ]         = $this->parseBidsData($bids);
            $orderDetail[ 'selected_bid' ] = $this->parseBidDetail($selected_bid);
        }

        return $orderDetail;
    }

    public function getOrderItems($id) {
        return OrderItem::whereOrderId($id)->get();
    }

    public function parseBidsData($bids) {

        $allBids = [];
        foreach ($bids as $bid) {
            $bidData   = $this->parseBidDetail($bid);
            $allBids[] = $bidData;
        }
        return $allBids;
    }

    public function parseBidDetail($bid) {
        // return $bid;
        if(!empty($bid)) {
            return [
                'bid_id'                => \HashId::encode($bid[ 'id' ], 'orders'),
                'bidder_id_for_contact' => \HashId::encode($bid[ 'bidder_id' ], 'message'),
                'bidder_id'             => $bid[ 'bidder_id' ],
                'bid_amount'            => $bid[ 'bid_amount' ],
                'proposed_item_value'   => $bid[ 'proposed_item_value' ],
                'message'               => $bid[ 'description' ],
                'status'                => $bid[ 'status' ],
                'created_at'            => Carbon::parse($bid[ 'created_at' ])->format('Y-m-d h:i:s'),
                'owner'                 => $this->userDetail((object)$bid[ 'bidder' ])
            ];
        }
        return "";
    }

    public function getOwnerDetail($ownerDetail) {
        $owner[ 'name' ]            = $ownerDetail->display_name;
        $owner[ 'profile_picture' ] = $ownerDetail->profile_photo_url;

        return $owner;
    }

//Items data that will be fetched through Relations;

    public function parseData($data) {
        $jobs = [];
        foreach ($data[ 'jobs' ] as $jobDetail) {
            if(!is_null($jobDetail->owner)) {
                $job    = $this->parseSingleItem($jobDetail);
                $jobs[] = $job;
            }

        }
        return $jobs;
    }

    public function parseSingleItem($jobDetail) {
        unset($jobDetail->category);
        $owner = $jobDetail->owner;
        unset($jobDetail->owner);
        $myBid = $jobDetail[ 'myBid' ];

        unset($jobDetail[ 'myBid' ]);

        $job             = $this->getOrderDetail($jobDetail, TRUE);
        $job[ 'my_bid' ] = $this->parseBidDetail($myBid);
        $job[ 'owner' ]  = $this->userDetail($owner);

        return $job;
    }

    //Items data that will be fetched through join;
    public function parseJobDetail($jobs, $user_id, $user = NULL) {
        $allJobs = [];
        foreach ($jobs as $jobDetail) {
            //echo '<tt><pre>'; print_r($jobDetail->order_id); die;
            $job = $this->parseSingleItemDetail(get_object_vars($jobDetail), $user_id, $user);

            $allJobs[] = $job;
        }
        return $allJobs;
    }

    public function parseSingleItemDetail($job, $user_id, $user = NULL) {
        $jobs = $job;
        if(isset($job[ 'delivery_latitude' ]) && isset($job[ 'delivery_longitude' ])) {
            $jobs[ 'latitude' ]  = $job[ 'delivery_latitude' ];
            $jobs[ 'longitude' ] = $job[ 'delivery_longitude' ];
        }

        $jobs[ 'order_id' ]    = \HashId::encode($job[ 'order_id' ], 'orders');
        $jobs[ 'od_id' ]       = $job[ 'order_id' ];
        $items                 = $this->getOrderItems($job[ 'order_id' ]);
        $jobs[ 'order_items' ] = $items;

        $jobs[ 'owner' ]             = $this->userDetail($job);
        $jobs[ 'feedback_received' ] = $this->getApiFeedbacks($user_id, $job[ 'order_id' ]);
        $jobs[ 'feedback_given' ]    = $this->getFeedbackGiven($job[ 'order_id' ], $user_id);

        $jobs[ 'my_bid' ]        = $this->getSingleBidDetail($job, $user);
        $jobs[ 'order_status' ]  = $this->getStatus($job, $user_id);
        $jobs[ 'category_name' ] = Category::find($job[ 'category_id' ])->name;

        return $jobs;
    }

    //Favourite data that will be fetched through join;

    public function getApiFeedbacks($user_id, $order_id) {
        return Rating::select('id', 'rating', 'feedback', 'rateable_id', 'updated_at')->where('user_id', $user_id)
                     ->where('order_id', $order_id)->first();
    }

    public function getFeedbackGiven($id, $userId) {

        return Feedback::whereOrderId($id)->whereRateableId($userId)->first();
    }

    public function getSingleBidDetail($job, $user = NULL) {

        return [
            'id'                  => $job[ 'bid_id' ],
            'bid_id'              => \HashId::encode($job[ 'bid_id' ], 'orders'),
            'bidder_id'           => $job[ 'bidder_id' ],
            'bid_amount'          => $job[ 'bid_amount' ],
            'proposed_item_value' => $job[ 'proposed_item_value' ],
            'message'             => $job[ 'bid_description' ],
            'owner'               => $this->userDetail($user)

        ];

    }

    public function getStatus($job, $user_id) {

        if($job[ 'status' ] != config('constant_settings.ORDER_STATUS.IN_PROCESS') && $job[ 'delivery_driver_id' ] != $user_id):
            $status = "Awarded to other";
        else:
            $status = config('constant_settings.ORDER_STATUS_MSG.' . $job[ 'status' ]);
        endif;

        return $status;
    }

    public function parseJobFavourite($jobs, $user_id, $user = NULL) {
        $allJobs = [];
        foreach ($jobs as $jobDetail) {
            $job = $this->parseSingleItemFavDetail(get_object_vars($jobDetail), $user_id, $user);

            $allJobs[] = $job;
        }
        return $allJobs;
    }

    //Items data that will be fetched through Relations;

    public function parseSingleItemFavDetail($job, $user_id, $user = NULL) {
        $jobs = $job;

        $jobs[ 'order_id' ]      = \HashId::encode($job[ 'order_id' ], 'orders');
        $jobs[ 'od_id' ]         = $job[ 'order_id' ];
        $jobs[ 'category_name' ] = Category::find($job[ 'category_id' ])->name;
        $items                   = $this->getOrderItems($job[ 'order_id' ]);
        $jobs[ 'order_items' ]   = $items;
        $jobs[ 'owner' ]         = $this->userDetail($job);
        $jobs[ 'status' ]        = $this->getStatus($job, $user_id);
        $myBid                   = $this->getMyBidbyId($job[ 'order_id' ], $user->id);

        $jobs[ 'my_bid' ] = "";
        if(!empty($myBid)) {
            $jobs[ 'my_bid' ] = $this->getSingleBidDetail($myBid, $user);
        }

        return $jobs;
    }

    public function getMyBidbyId($jobId, $userId) {
        $data = OrderBid::whereBidderId($userId)->whereOrderId($jobId)->select('*', 'id as bid_id', 'description as bid_description')->first();
        if(!empty($data)) {
            return $data->toArray();
        }

        return $data;
    }

    public function getMyBid($bids, $userId) {
        foreach ($bids as $bid) {
            if($bid[ 'bidder_id' ] == $userId) {
                return $bid;
            }
        }
    }
}

<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 02-Aug-16 11:52 AM
 * File Name    : UserDetail.php
 */

namespace App\Traits;

use App\Order;
use App\User;
use Carbon\Carbon;

trait UserDetail
{
    public function userDetail($user, $imageType = NULL) {

        if(isset($user->ratings)) {
            $allReviews = $user->ratings;
        } else {
            $reviews = User::whereid($user[ 'clientId' ])->with('ratings')->first();
            if(is_object($reviews)) {
                $allReviews = $reviews->ratings;
            } else {
                $allReviews = $reviews[ 'ratings' ];
            }

        }

        if(empty($allReviews)) {
            $reviewCount = 0;
        } else {
            $reviewCount = count($allReviews);
        }
        $data = [
            'id' => \HashId::encode($user['id'], 'favourite'),
            'name'            => $user[ 'display_name' ],
            'profile_picture' => getImage($user[ 'profile_photo_url' ], $imageType),
            'rating'          => $user[ 'rating' ],
            'profile_url'     => $user[ 'username' ],
            'member_since'    => Carbon::parse($user[ 'created_at' ])->format('Y-m-d H:i:s'),
            "userType"        => \Config::get('constant_settings.USERS.' . $user['user_type']),
            'review_count'    => $reviewCount,
        ];
        if($user[ 'user_type' ] == \Config::get('constant_settings.USER_TYPES.DELIVERY_MAN')) {
            $data[ 'success_ratio' ] = $this->getJobSuccess($user[ 'bidder_id' ]);
        }
        return $data;
    }

    public function userDetailWithArray($user) {
        return [
            'name'            => $user[ 'display_name' ],
            'profile_picture' => getImage($user->profile_photo_url),
            'rating'          => $user->rating,
            'review_count'    => count($user->ratings),
            'member_since'    => Carbon::parse($user[ 'created_at' ])->format('Y-m-d H:i:s'),
        ];
    }

    public function getJobSuccess($driverId) {
        $assigned  = Order::whereDeliveryDriverId($driverId)->count();
        $completed = Order::whereStatus(\Config::get('constant_settings.ORDER_STATUS.RECEIVED'))->count();
        return [
            'assigned'  => $assigned,
            'completed' => $completed
        ];
    }

    public function userBasicData($user) {
        return [
            'name'            => $user[ 'display_name' ],
            'id'              => $user[ 'id' ],
            'profile_picture' => getImage($user[ 'profile_photo_url' ]),
            'rating'          => $user[ 'rating' ],
            'member_since'    => Carbon::parse($user[ 'created_at' ])->format('Y-m-d H:i:s'),
        ];
    }
}

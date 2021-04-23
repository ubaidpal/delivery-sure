<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 23-Jun-16 12:17 PM
 * File Name    : DashBoardRepository.php
 */

namespace App\Repositories;

use App\Order;
use App\OrderBid;
use App\Subscriber;
use App\Traits\OrderDetailsTrait;
use App\User;
use Illuminate\Support\Str;

class DashBoardRepository
{
    use OrderDetailsTrait;

    public function filter($data, $user_id) {
        if((isset($data[ 'type' ]) && $data[ 'type' ]) == 'both' && !empty($data[ 'name' ])) {
            $name = trim($data[ 'name' ]);
            $user = User::whereActive(1);
            $user = $user->where(function ($query) use ($name) {
                $query->where('display_name', 'like', "$name%")
                      ->orWhere('business_name', 'like', "$name%");
            });
            $user = $user->lists('id')->toArray();

        } elseif(isset($data[ 'type' ]) && $data[ 'type' ] != 'both') {
            $user = User::whereActive(1);

            if($data[ 'type' ] == \Config::get('constant_settings.USER_TYPES.PURCHASER')) {
                if(!empty($name)) {
                    $user = $user->where('display_name', 'like', "$name%");
                }
                $user = $user->whereUserType($data[ 'type' ]);
            } elseif($data[ 'type' ] == \Config::get('constant_settings.USER_TYPES.RETAILER')) {
                if(!empty($name)) {
                    $user = $user->where(function ($query) use ($name) {
                        $query->where('display_name', 'like', "$name%")
                              ->orWhere('business_name', 'like', "$name%");
                    });
                }
                $user = $user->whereUserType($data[ 'type' ]);
            }
            $user = $user->lists('id')->toArray();
        }

        $query = Order::active()
                      ->whereStatus(0)
                      ->where('user_id', '!=', $user_id);
        //$query = "Select * from orders WHERE item_value BETWEEN $minBudget AND $maxBudget AND orders.status = 0 ";
        if(isset($data[ 'min_budget' ]) && !empty($data[ 'min_budget' ])) {
            $query = $query->where('estimate_delivery_fee', '>=', $data[ 'min_budget' ]);
        }

        if(isset($data[ 'max_budget' ]) && !empty($data[ 'max_budget' ])) {
            $query = $query->where('estimate_delivery_fee', '<=', $data[ 'max_budget' ]);
        }

        if(!empty($data[ 'keyword' ])) {
            $keyword = $data[ 'keyword' ];
            $query   = $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%")
                      ->orWhere('order_description', 'like', "%$keyword%");
            });
            //$query .= "AND (title like '%$keyword%' OR order_description LIKE '%$keyword%')";
        }

        if(isset($data[ 'categories' ]) && !empty($data[ 'categories' ])) {
            //$categories = implode(',', $data['categories']);
            //$query .= " AND category_id IN ($categories)";
            $query = $query->whereIn('category_id', $data[ 'categories' ]);
        }
        if(isset($data[ 'radius' ]) && !empty($data[ 'radius' ]) && $data[ 'radius' ] != 0) {
            $lat  = $data[ 'lat' ];
            $lng  = $data[ 'lng' ];
            $mile = 3959;
            $km   = 6371;
            $query->selectRaw("*, ( $mile * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance  ");
            $radius = $data[ 'radius' ];
            $query->having('distance', '<', "$radius");
        }

        //$data = \DB::select(\DB::raw($query));
        if((isset($data[ 'type' ]) && $data[ 'type' ] != 'both') || (isset($data[ 'type' ]) && $data[ 'type' ] == 'both' && !empty($name))) {
            $query = $query->whereIn('user_id', $user);
        }
        return $data = $query
            ->with('items')
            ->with('owner')
            ->with(['favourite' => function ($query) use ($user_id) {
                $query->where('object_type', 'order')
                      ->where('user_id', $user_id);
            }])
            ->orderBy('id', 'DESC')
            ->get();

    }

    public function markersPositions($jobs) {
        $markers = [];
        foreach ($jobs as $job) {
            if(!is_null($job->owner)) {

                // $marker = [$job->delivery_location,$job->latitude,$job->longitude,$job->id];
                if(!is_null($job->owner) && $job->owner->user_type == \Config::get('constant_settings.USER_TYPES.RETAILER')) {
                    $markerIcon = \Config::get('constant_settings.MARKERS.RETAILER.OTHER');
                } else {
                    $markerIcon = \Config::get('constant_settings.MARKERS.PURCHASER.OTHER');
                }

                $userType = \Config::get('constant_settings.USERS.' . $job->owner->user_type);

                $marker[ 'address' ]     = $job->delivery_location;
                $marker[ 'latitude' ]    = $job->latitude;
                $marker[ 'longitude' ]   = $job->longitude;
                $marker[ 'id' ]          = $job->id;
                $marker[ 'url' ]         = \HashId::encode($job->id, 'orders');
                $marker[ 'marker' ]      = $markerIcon;
                $marker[ 'userType' ]    = $userType;
                $marker[ 'title' ]       = Str::limit($job->title, 17);
                $marker[ 'deliveryFee' ] = format_currency($job->estimate_delivery_fee);
                $marker[ 'description' ] = Str::limit($job->order_description, 50);
                $marker[ 'time' ]        = getTimeByTZ($job->deliver_date_time, 'h:i A | d-m-y');
                $marker[ 'is_bidded' ]   = !empty($job->myBid ? '1' : '0');

                $marker[ 'owner' ] = [
                    'name'            => $job->owner->display_name,
                    'id'              => \HashId::encode($job->owner->id, 'favourite'),
                    'profile_picture' => getImage($job->owner->profile_photo_url, '41x41'),
                    'rating'          => (!is_null($job->owner->rating) ? $job->owner->rating : '0'),
                ];
                $markers[] = $marker;
            }

        }
        // echo '<tt><pre>'; print_r($markers); die;
        return $markers;
    }

    public function getBudgetRange() {
        return Order::selectRaw('MAX(item_value) as max_budget, MIN(item_value) as min_budget')->first();
    }

    public function subscribe($request) {
        $isSubscribe = $this->isSubscribe($request->email);
        if($isSubscribe == 0) {
            $subscriber        = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();
            return 1;
        }
        return 2;
    }

    private function isSubscribe($email) {
        return Subscriber::whereEmail($email)->count();
    }

    public function getCategories() {

        $categoriesList = \DB::table('item_categories')->orderBy('sort_order', 'ASC')->orderBy('name', 'ASC')->lists('name', 'id');
        //$categories     = [0=>'Other'];
        //$categoriesList =  $categoriesList + $categories;
        return $categoriesList;
    }

    public function getCategoriesDetail() {
        $categoriesList = \DB::table('item_categories')->orderBy('sort_order', 'ASC')->orderBy('name', 'ASC')->select('name', 'id', 'class')->get();
        //$categories     = [0=>'Other'];
        //$categoriesList =  $categoriesList + $categories;
        return $categoriesList;
    }

    public function myBid($id, $user_id) {
        return OrderBid::whereOrderId($id)->whereBidderId($user_id)->first();
    }
}

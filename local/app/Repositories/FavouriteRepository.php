<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 20-Jul-16 11:06 AM
 * File Name    : FavouriteRepository.php
 */

namespace Repositories;

use App\Favourite;
use App\Order;
use App\User;
use Illuminate\Support\Str;
use Repositories\Eloquent\Repository;

class FavouriteRepository extends Repository
{

    function model() {
        // TODO: Implement model() method.
        return 'App\Favourite';
    }

    public function getDrivers() {
        return User::whereUserType(\Config::get('constant_settings.USER_TYPES.DELIVERY_MAN'))
                   ->whereApproved(1)
                   ->whereActive(1)
                   ->orderBy('rating', 'DESC')
                   ->paginate(25);
    }

    public function getFavDrivers($user_id) {
        return Favourite::whereObjectType('user')->whereUserId($user_id)->with('driver')->paginate(25);
    }

    public function orderByRating($drivers) {
        $allDrivers = [];
        foreach ($drivers as $driver) {
            $driver[ 'rating' ] = $driver->averageRating();
            $allDrivers[]       = $driver;
        }

        //arrange data

        return $this->sort($allDrivers, SORT_DESC);
    }

    private function sort($allDrivers, $sort) {
        $price = array();
        foreach ($allDrivers as $key => $row) {
            $price[ $key ] = $row[ 'rating' ];
        }
        array_multisort($price, $sort, $allDrivers);
        return $allDrivers;
    }

    public function getFavourites($user_id) {
        return Favourite::whereObjectType('user')->whereUserId($user_id)->lists('object_id')->toArray();
    }

    public function searchDrivers($data) {
        $query = User::whereActive(1)
                     ->whereApproved(1)
                     ->whereUserType(\Config::get('constant_settings.USER_TYPES.DELIVERY_MAN'));

        if(!empty($data[ 'search' ])) {
            $driver = trim($data[ 'search' ]);
            $query  = $query->where('display_name', 'like', "%$driver%");
        }
        if(isset($data[ 'rating' ]) || !empty($data[ 'rating' ])) {
            if($data[ 'rating' ] == 'top') {
                $query = $query->orderBy('rating', 'desc');
            } else {
                $rating = $data[ 'rating' ];
                $query  = $query->where(function ($query) use ($rating) {
                    $query->where('rating', '>=', $rating)
                          ->where('rating', '<=', $rating . '.99')
                          ->orderBy('rating', 'desc');
                });
            }
        }

        if(isset($data[ 'radius' ]) && !empty($data[ 'radius' ]) && $data[ 'radius' ] != 0) {
            $lat    = $data[ 'latitude' ];
            $lng    = $data[ 'longitude' ];
            $mile   = 3959;
            $km     = 6371;
            $query  = $query->selectRaw("*, ( $mile * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance  ");
            $radius = $data[ 'radius' ];
            $query->having('distance', '<', "$radius");
        }

        return $query->take(25)->get();

    }

    public function driverMarkers($drivers) {

        $markers = [];
        foreach ($drivers as $driver) {
            // $marker = [$job->delivery_location,$job->latitude,$job->longitude,$job->id];
            if(!empty($driver->latitude) && !empty($driver->longitude)) {
                $marker[ 'name' ]            = $driver->display_name;
                $marker[ 'rating' ]          = $driver->rating;
                $marker[ 'profile_picture' ] = getImage($driver->profile_photo_url, '41x41');
                $marker[ 'city' ]            = $driver->city;
                $marker[ 'state' ]           = $driver->state;
                $marker[ 'country' ]         = getCountryName($driver->country);
                $marker[ 'address' ]         = $driver->city . ', ' . $marker[ 'country' ];
                $marker[ 'latitude' ]        = $driver->latitude;
                $marker[ 'longitude' ]       = $driver->longitude;
                $marker[ 'id' ]              = $driver->id;
                $marker[ 'member_since' ]    = dateFormat($driver->created_at);
                $marker[ 'progress_bar' ]    = progressBar($driver->rating,$driver->id);
                $marker[ 'url' ]             = url('profile/' . \HashId::encode($driver->id, 'favourite'));
                $marker[ 'marker' ]          = $this->getDriverType($driver->driver_type);
                $marker[ 'about' ]           = (!is_null($driver->about) ? Str::limit($driver->about, 50) : '');
                $markers[]                   = $marker;
            }

        }
        return $markers;

    }

    private function getDriverType($driver_type) {
        switch ($driver_type) {
            case \Config::get('constant_settings.DELIVERY_PERSON_TYPES.WALKER'):
                return 'walker';
                break;
            case \Config::get('constant_settings.DELIVERY_PERSON_TYPES.BIKER'):
                return 'biker';
                break;
            case \Config::get('constant_settings.DELIVERY_PERSON_TYPES.CAR DRIVER'):
                return 'car';
                break;
            case \Config::get('constant_settings.DELIVERY_PERSON_TYPES.TRUCK DRIVER'):
                return 'truck';
                break;
            default:
                return 'van';

        }
    }

    public function parseDrivers($data) {
        $all = [];
        foreach ($data[ 'drivers' ] as $driver) {
            // $markers = [];
            $d = $this->parseDriverDetail($driver, $data);

            $all[] = $d;
        }
        return $all;
    }

    private function parseDriverDetail($driver, $data) {
        if(isset($data[ 'driverMarkers' ][ $driver->id ])) {
            //$markers = $data[ 'driverMarkers' ][ $driver->id ];
        };
        $favorite = 0;

        if(!is_null($data)) {
            if(in_array($driver->id, $data[ 'favourites' ])) {
                $favorite = 1;
            }
        } elseif(is_null($data)) {
            $favorite = 1;
        }

        $ratio = getJobSuccess($driver->rating, $driver->id);

        $d                      = $driver;
        $d[ 'driver_id' ]       = \HashId::encode($driver->id, 'favourite');
        $d[ 'success_ratio' ]   = isset($ratio[ 'status' ]) ? $ratio[ 'message' ] : $ratio;
        $d[ 'country' ]         = getCountryName($driver->country);
        $d[ 'profile_picture' ] = getImage($driver->profile_photo_url);
        unset($driver->profile_photo_url);
        $d[ 'is_favorite' ] = $favorite;
        //$d[ 'markers' ]     = $markers;
        $d[ 'feedbacks' ] = $this->parseFeedbacks($driver->ratings);
        unset($driver->ratings);
        $d[ 'feedbackCount' ] = count($d[ 'feedbacks' ]);
        $d[ 'vehicles' ] = $driver->vehicles;

        return $d;
    }

    private function parseFeedbacks($feedbacks) {
        $all = [];
        foreach ($feedbacks as $feedback) {
            $feedback[ 'order_detail' ] = $this->getOrder($feedback->order_id);
            $all[]                      = $feedback;
        }
        return $all;
    }

    private function getOrder($order_id) {
        return Order::whereId($order_id)->select(['title', 'order_description'])->withoutGlobalScopes()->withTrashed()->first();
    }

    public function parseFavoriteDrivers($favorites) {
        $all = [];
        foreach ($favorites as $favorite) {
            // $markers = [];
            $d = $this->parseDriverDetail($favorite->driver, NULL);

            $all[] = $d;
        }
        return $all;
    }
}

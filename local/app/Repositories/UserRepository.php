<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 1/6/2016
 * Time: 9:31 PM
 */
namespace App\Repositories;

use App\Country;
use App\DriverVehicle;
use App\Events\SendEmail;
use App\Favourite;
use App\Order;
use App\Rating;
use App\Traits\UserDetail;
use App\User;
use App\UserDocument;
use Carbon\Carbon;
use Repositories\Eloquent\Repository;

class UserRepository extends Repository
{
    use UserDetail;

    public function updateProfile($request, $user_id) {
        $user = User::find($user_id);

        if(isset($user_id)) {

            $user->first_name = $request->first_name;
            //$user->last_name    = $request->last_name;
            $user->display_name = $request->first_name;
            $user->username     = $request->username;
            $user->gender       = $request->gender;
            $user->country      = $request->country;
            $user->phone_number = $request->phone_number;
            $user->address      = $request->address;
            $user->dob          = $request->dob;
            $user->latitude     = $request->address_latitude;
            $user->longitude    = $request->address_longitude;
            $user->state        = $request->state;
            $user->city         = $request->city;
            $user->post_code    = $request->post_code;
            $user->about        = $request->about;

            if($user->is('retailer')) {

                $user->business_name    = $request->business_name;
                $user->business_phone   = $request->business_phone;
                $user->business_lat     = $request->latitude;
                $user->business_lng     = $request->longitude;
                $user->business_address = $request->business_address;
            }

            if($user->is('delivery.man')) {

                $user->lift_weight    = $request->lift_weight;
                $user->driver_type    = $request->driver_type;
                $user->license_number = $request->license_number;

                $this->saveVehicles($user_id, $request);
            }
            $user->save();

            return 1;
        }

        return 0;
    }

    private function saveVehicles($user_id, $request) {

        if(!empty($request->vehicle)) {
            foreach ($request->vehicle as $index => $item) {
                if(!empty($item[ 'make' ])) {
                    $this->saveVehicle($user_id, $item);
                }
            }
        }
    }

    public function saveVehicle($user_id, $item) {

        if(isset($item[ 'id' ]) && !empty($item[ 'id' ])) {
            $vehicle = DriverVehicle::find($item[ 'id' ]);
        } else {
            $vehicle = new DriverVehicle();
        }
        $vehicle->driver_id    = $user_id;
        $vehicle->make         = $item[ 'make' ];
        $vehicle->model        = $item[ 'model' ];
        $vehicle->year         = $item[ 'year' ];
        $vehicle->color        = $item[ 'color' ];
        $vehicle->plate_number = $item[ 'plate_number' ];
        $vehicle->save();
    }

    public function accountIsActive($code) {

        $user                  = User::where('activation_code', '=', $code)->first();
        $user->active          = 1;
        $user->activation_code = '';
        if($user->save()) {
            \Auth::login($user);
        }
        return TRUE;
    }

    function model() {
        // TODO: Implement model() method.
        return 'App\User';
    }

    public function getFeedbacks($user_id) {
        return Order::whereUserId($user_id)->with(['feedback' => function ($query) use ($user_id) {
            $query->where('rateable_id', $user_id);
        }])->orderBy('updated_at', 'DESC')->get();
        //return Feedback::whereRateableId($user_id)->with('order')->get();
    }

    public function getJobsFeedbacks($user_id) {
        return Order::whereDeliveryDriverId($user_id)
                    ->with(['feedback' => function ($query) use ($user_id) {
                        $query->where('rateable_id', $user_id);
                    }])
                    ->orderBy('updated_at', 'DESC')
                    ->with('owner')
                    ->get();
    }

    public function getApiFeedbacks($user_id, $order_id) {
        return Rating::select('id', 'rating', 'feedback', 'rateable_id', 'updated_at')->where('user_id', $user_id)
                     ->where('order_id', $order_id)->first();
    }

    public function updateDocument($data, $user_id) {
        $check = $this->checkDocument($data, $user_id);
        if(!empty($check)) {
            $document = $check;

        } else {
            $document = new UserDocument();
        }
        $document->user_id      = $user_id;
        $document->type         = $data[ 'type' ];
        $document->status       = 0;
        $document->document_url = $data[ 'document-path' ];
        $document->save();

        return TRUE;

    }

    private function checkDocument($data, $user_id) {
        return UserDocument::whereUserId($user_id)->whereType($data[ 'type' ])->first();
    }

    public function getProfile($id) {
        return User::whereId($id)->with(['ratings.order' => function ($query) {
            $query->withOutGlobalScopes();
        }])->orderBy('updated_at', 'DESC')->first();
    }

    public function quickProfile($id) {
        return User::whereId($id)->orderBy('updated_at', 'DESC')->first();
    }

    public function checkFavourite($id, $user_id) {
        return Favourite::whereUserId($user_id)->whereObjectType('user')->whereObjectId($id)->first();
    }

    public function accessToken($accessToken) {
        $tokens = \Config::get('constant_settings.ACCESS_TOKENS');
        if(in_array($accessToken, $tokens)) {
            \Session::set('accessGranted', TRUE);
        }else{
           \Session::forget('accessGranted')  ;
        }
        //\Session::clear();
        return TRUE;
    }

    public function getCountries() {
        $countries = Country::orderBy('name', 'asc')->lists('name', 'iso');

        return $countries;
    }

    public function checkUsername($username, $id) {
        if(!is_null($id)) {
            return User::whereUsername($username)->where('id', '<>', $id)->count();
        }
        return User::whereUsername($username)->count();

    }

    public function deleteVehicle($id, $user_id) {
        $vehicle = DriverVehicle::find($id);
        if(empty($vehicle)) {
            return [
                'error' => 1,
                'msg'   => 'Vehicle not found120'
            ];
        }
        if($vehicle->driver_id == $user_id) {
            $vehicle->delete();
            return [
                'error' => 0,
                'msg'   => 'Deleted successfully'
            ];
        } else {
            return [
                'error' => 1,
                'msg'   => 'You are not owner of this vehicle'
            ];
        }
    }

    public function contactUs($data, $user) {
        $emailData = array(
            'subject'      => 'Contact Us',
            'message'      => $data[ 'message' ],
            'from'         => $user[ 'email' ],
            'name'         => $user[ 'name' ],
            'phone_number' => $user[ 'phone' ],
            'template'     => 'contact-us',
            'to'           => \Config::get('constant_settings.CONTACT_US_EMAIL'),
        );

        \Event::fire(new SendEmail($emailData));
    }

    public function parseProfileData($data) {

        $user                      = $data[ 'userData' ];
        $user[ 'profile_picture' ] = getImage($user->profile_photo_url, '254x254');
        $user[ 'feedbacks' ]       = $this->parseFeedbacks($user[ 'ratings' ]);
        $user[ 'favourite' ]       = $data[ 'favourite' ];
        $user[ 'vehicles' ]        = $data[ 'vehicles' ];
        return $user;
    }

    private function parseFeedbacks($ratings) {
        $rat = [];

        foreach ($ratings as $rating) {
            $item                  = [];
            $item[ 'rating' ]      = $rating->rating;
            $item[ 'feedback' ]    = $rating->feedback;
            $item[ 'date' ]        = Carbon::parse($rating->created_at)->format('Y-m-d H:i:s');
            $item[ 'order_title' ] = $rating->order->title;
            $rat[]                 = $item;
        }
        return $rat;
    }
}

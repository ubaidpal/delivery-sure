<?php

namespace App\Http\Controllers;

use Api;
use App\Classes\WebServerResponse;
use App\Http\Requests;
use App\Referrer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Validator;
use Carbon\Carbon;

class ApiController extends Controller
{
    private $is_api;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
        if(isset($request[ 'allData' ][ 'is_api' ])) {
            $this->is_api = $request[ 'allData' ][ 'is_api' ];

        }
    }

    public function login(Request $request) {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = \Auth::user();
            if($user->active == 0) {
                return \Api::other_error('Please activate your account first');
            }
            $access_token = Authorizer::issueAccessToken();
            $data         = array(
                'access_token' => $access_token,
                'data'         => \Auth::user()
            );
            return \Api::success($data);
        } else {
            return \Api::invalid_param('Please provide valid credentials!');

        }
    }

    public function signUp(Request $request) {

        $rules      = array(
            'email'       => 'required|unique:users|email',
            'password'    => 'required',
            'referrer_id' => 'exists:users,username',
        );
        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()) {
            $msg = '';
            if($validation->errors()->has('email')) {
                $email = $validation->errors()->get('email');
                $msg .= $email[ 0 ];
            }
            if($validation->errors()->has('password')) {
                $password = $validation->errors()->get('password');
                $msg .= '\n' . $password[ 0 ];
            }
            if($validation->errors()->has('referrer_id')) {
                $referrer_id = $validation->errors()->get('referrer_id');
                $msg .= '\n' . $referrer_id[ 0 ];
            }

            return \Api::already_done($msg);
        }
        if(isset($data[ 'user_type' ])) {
            $user_type = $data[ 'user_type' ];
        } else {
            $user_type = 100;
        }
        if($user_type == \Config::get('constant_settings.USER_TYPES.RETAILER')) {
            if(isset($data[ 'referrer_id' ]) && !empty($data[ 'referrer_id' ])) {
                $checkReferrer = $this->getReferrer($data[ 'referrer_id' ]);
                if(!$checkReferrer){
                    return Api::other_error('Referrer ID not match with our record');
                }
            }
        }
        $activation_code = str_random(60) . $request->input('email');
        //$username        = slugify($request->first_name, ['table' => 'users', 'field' => 'username']);
        $user            = new User();
        $user->email     = $request->email;

        $user->first_name   = $request->first_name;
        //$user->last_name    = $request->last_name;
        $user->display_name = $request->first_name;
        $user->username     = $request->username;
        $user->phone_number = $request->phone_number;
        // $user->retailer_name = $request->retailer_name;
        $user->password  = bcrypt($request->password);
        $user->active    = 0;
        $user->user_type = $request->user_type;
        // $user->dob   = (int) $request->year . '-' . (int) $request->month . '-' . (int) $request->date;

        $user->activation_code = $activation_code;
        $expiry_date           = Carbon::now();
        $expiry_date->addDays(29);
        $user->token_expiry_date = $expiry_date;

        $user->save();
        $this->sendEmail($user);

        $user->attachRole(\Config::get('constant_settings.USER_ROLES.' . $user->user_type));

        if($user->user_type == \Config::get('constant_settings.USER_TYPES.DELIVERY_MAN')) {
            $user->attachPermission(2);
        }
        if($user_type == \Config::get('constant_settings.USER_TYPES.RETAILER')) {

            $this->saveReferrer($user->id, $checkReferrer);

        }
        return \Api::success_with_message('Registered Successfully. Please Verify your email');

    }
    private function saveReferrer($id, $referrer_id) {

        $referrer = new Referrer();

        $referrer->user_id     = $id;
        $referrer->referrer_id = $referrer_id;
        $referrer->save();
        return TRUE;

    }
    private function getReferrer($referrer_id) {
        $referrerId = User::whereUsername($referrer_id)->first();
        if(!empty($referrerId)) {
            return $referrerId->id;
        }else{
            return FALSE;
        }
    }
    public function sendEmail(User $user) {

        $data = array(
            'name' => $user->first_name . ' ' . $user->last_name,
            'code' => $user->activation_code,
        );

        Mail::queue('emails.activateAccount', $data, function ($message) use ($user) {
            $message->subject('Account Activation: Please activate your account.');
            $message->to($user->email);
            $message->from("demedat@no-reply.com");
        });
    }

    public function gitCountryList() {

        $data[ 'countries' ] = DB::table('countries')->orderBy('name', 'ASC')->lists('name', 'id');
        return \Api::success($data);
    }

}

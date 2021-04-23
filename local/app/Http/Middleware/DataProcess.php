<?php

namespace App\Http\Middleware;

use App\Classes\UrlFilter;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DataProcess
{
    public function __construct() {

    }

    private static function get_url() {
        return UrlFilter::filter();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $data[ 'allData' ][ 'is_api' ]     = self::get_url();
        $userInfo                          = $this->get_user_detail();
        $data[ 'middleware' ][ 'user_id' ] = $userInfo[ 'user_id' ];
        $data[ 'middleware' ][ 'user' ]    = $userInfo[ 'user' ];
        $request->merge($data);

        \View::share(['user' => $data[ 'middleware' ][ 'user' ]]);

        $this->updateCoordinates($data);
        if(\Auth::check()) {

            if($data[ 'middleware' ][ 'user' ]->user_type == 1) {
                $admin_route = \Config::get('constant_settings.ADMIN_URL_PREFIX');
                $user        = \Auth::user();
                if($user->is('super.admin')) { // you can pass an id or slug
                    //echo 'Other'; die;
                    return redirect()->route('admin.home');
                } elseif($user->is('dispute.manager') || $user->is('arbitrator')) {
                    return redirect('admin/super-admin/claims-unassigned');
                } else {
                    return redirect('admin/withdrawalRequests');
                }

            }
        }

        return $next($request);
    }

    private function get_user_detail() {
        $is_api = self::get_url();

        if($is_api) {
            $user_id = Authorizer::getResourceOwnerId();
            $user    = User::findOrNew($user_id);
        } else {
            if(Auth::check()) {
                $user                  = Auth::user();
                $user[ 'user_detail' ] = $user;
                $user_id               = $user->id;
            }
        }

        if(isset($user_id)) {
            return ['user_id' => $user_id, 'user' => $user,];
        }
    }

    private function updateCoordinates($data) {
        if(\Auth::check()) {
            if($data[ 'middleware' ][ 'user' ]->is('retailer') && !empty($data[ 'middleware' ][ 'user' ]->business_lat) && !empty($data[ 'middleware' ][ 'user' ]->business_lng)) {
                \Config::set('constant_settings.DEFAULT_LATITUDE', $data[ 'middleware' ][ 'user' ]->business_lat);
                \Config::set('constant_settings.DEFAULT_LONGITUDE', $data[ 'middleware' ][ 'user' ]->business_lng);
            } elseif(!empty($data[ 'middleware' ][ 'user' ]->latitude) && !empty($data[ 'middleware' ][ 'user' ]->longitude)) {

                \Config::set('constant_settings.DEFAULT_LATITUDE', $data[ 'middleware' ][ 'user' ]->latitude);
                \Config::set('constant_settings.DEFAULT_LONGITUDE', $data[ 'middleware' ][ 'user' ]->longitude);
            } else {
                \Config::set('constant_settings.DEFAULT_LATITUDE', 40.711268);
                \Config::set('constant_settings.DEFAULT_LONGITUDE', -74.014328);
            }
        } else {
            \Config::set('constant_settings.DEFAULT_LATITUDE', 40.711268);
            \Config::set('constant_settings.DEFAULT_LONGITUDE', -74.014328);
        }
    }
}

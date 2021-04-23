<?php

namespace App\Http\Middleware;

use App\Classes\UrlFilter;
use Closure;

class ApiMiddleware
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
       /* $userInfo                          = $this->get_user_detail();
        $data[ 'middleware' ][ 'user_id' ] = $userInfo[ 'user_id' ];
        $data[ 'middleware' ][ 'user' ]    = $userInfo[ 'user' ];*/
        $request->merge($data);
       // \View::share(['user' => $data[ 'middleware' ][ 'user' ]]);
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
}

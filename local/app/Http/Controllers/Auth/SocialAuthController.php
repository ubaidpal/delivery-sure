<?php

namespace App\Http\Controllers\Auth;

use App\SocialUser;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class SocialAuthController extends Controller
{
    public function redirect($type) {
        $providerKey = \Config::get('services.' . $type);
        if(empty($providerKey))
            return redirect('login')->with('error', 'No such provider');

        return \Socialite::driver($type)->redirect();
    }

    public function callback($provider) {

        $user = \Socialite::driver($provider)->user();

        $socialUser = NULL;

        $userCheck = User::where('email', '=', $user->email)->first();
        if(!empty($userCheck)) {
            $socialUser = $userCheck;
        } else {
            $sameSocialId = SocialUser::whereSocialId($user->id)->whereProvider($provider)->first();

            if(empty($sameSocialId)) {
                //There is no combination of this social id and provider, so create new one
                $newSocialUser        = new User();
                $newSocialUser->email = $user->email;
                list($f_name, $l_name) = explode(' ', $user->name);
                $newSocialUser->first_name  = $f_name;
                $newSocialUser->last_name   = $l_name;
                $newSocialUser->display_name = $f_name . ' ' . $l_name;
                $newSocialUser->active      = 1;
                $newSocialUser->user_type   = 1;
                $newSocialUser->username    = slugify($f_name . '-' . $l_name, ['table' => 'users', 'field' => 'username']);

                $newSocialUser->save();

                $socialData            = new SocialUser();
                $socialData->user_id   = $newSocialUser->id;
                $socialData->social_id = $user->id;
                $socialData->provider  = $provider;
                $socialData->save();

                // Add role
                $socialUser = User::find($newSocialUser->id);
                $socialUser->attachRole(2);
            } else {
                //Load this existing social user
                $socialUser = $sameSocialId->user;
            }
        }
        \Auth::login($socialUser, TRUE);
        return redirect('/');
    }
}

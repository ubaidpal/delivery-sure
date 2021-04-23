<?php

namespace App\Listeners;

use App\Exceptions\RedirectException;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Redirect;

class LoginEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  auth .login  $event
     *
     * @return void
     */
    public function handle($event) {

        $this->checkProfile(\Auth::user());

    }

    private function checkProfile($user) {

        if($user->is('retailer')) {
            if(empty($user->business_address) || empty($user->business_name) || empty($user->business_phone)) {
                return redirect('profile-setting');
            }
        }
        if($user->is('delivery.man')) {
            if(empty($user->address) || empty($user->profile_photo_url)) {
                return redirect('profile-setting');
            }
        }

        if($user->is('purchaser')) {
            if(empty($user->address) || empty($user->profile_photo_url)) {
                throw new RedirectException("some msg here");

            }
        }
    }
}

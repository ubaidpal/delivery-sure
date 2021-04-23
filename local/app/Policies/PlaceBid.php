<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlaceBid
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function before($user, $ability) {
        /* if($user->can('delivery.man')) {
             return TRUE;
         } else {
             return FALSE;
         }*/
    }

    public function placeBid(User $user, Order $order) {
        return $user->id !== $order->user_id && $user->can('delivery.man');
    }

    public function getBids(User $user, Order $order) {
        return $user->id === $order->user_id;
    }

    public function approved(User $user) {
        if($user->approved === \Config::get('constant_settings.USERS_APPROVAL.APPROVED')) {
            return TRUE;
        }
        return FALSE;
    }
}

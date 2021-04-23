<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param \App\User $user
     * @param \App\Order $order
     *
     * @return bool
     */
    public function notOwner(User $user, Order $order) {
        return $order->user_id;
        return $user->id != $order->user_id;
    }
}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use willvincent\Rateable\Rateable;

class User extends Authenticatable implements  HasRoleAndPermissionContract
{
    use HasRoleAndPermission, Rateable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'display_name', 'username', 'first_name', 'last_name', 'activation_code', 'dob', 'active','phone_number','retailer_name', 'user_type', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function documents() {
        return $this->hasMany('App\UserDocument')->orderBy('type', 'ASC');
    }

    public function pendingDocument() {
        return $this->hasMany('App\UserDocument')->where('status',0);
    }

    public function ratings() {
        return $this->morphMany('App\Rating', 'rateable');
    }

    public function selected_bids() {
        return $this->hasMany('App\OrderBid', 'bidder_id')->where('status', 1);
    }

    public function vehicles() {
        return $this->hasMany('App\DriverVehicle','driver_id');
    }

    public function orders() {
        return $this->hasMany('App\Order')->whereNotNull('delivery_driver_id')->select(['id', 'user_id']);
    }
}

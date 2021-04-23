<?php

namespace App;

use App\Scops\RejectedBidScope;
use Illuminate\Database\Eloquent\Model;
use App\Scops\CancelBidScope;

class OrderBid extends Model
{
    protected $guarded =  [''];

    public function bidder() {
        return $this->hasOne('App\User','id','bidder_id');
    }

    public function order() {
        return $this->belongsTo('App\Order', 'order_id');
    }

    protected static function boot()
    {
        parent::boot();

       // static::addGlobalScope(new CancelBidScope());
        //static::addGlobalScope(new RejectedBidScope());
    }

}

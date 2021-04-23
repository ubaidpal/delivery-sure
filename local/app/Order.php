<?php

namespace App;

use App\Scops\ArchiveScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use SoftDeletes;
    protected $table = 'orders';
    protected $primaryKey = 'id';

    //protected $fillable =  ['title','order_description','category_id','estimate_delivery_fee'];
    protected $guarded = [''];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function driver()
    {
        return $this->hasOne('App\User', 'id', 'delivery_driver_id');
    }

    public function ownerWithRating()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function items()
    {
        return $this->hasMany('App\OrderItem', 'order_id');
    }

    public function bids()
    {
        return $this->hasMany('App\OrderBid', 'order_id')->with('bidder');
    }

    public function countBids()
    {
        return $this->hasMany('App\OrderBid', 'order_id')->with('bidder');
    }

    public function selectedBid()
    {
        return $this->hasOne('App\OrderBid', 'order_id')->where('status', \Config::get('constant_settings.BID_STATUS.SELECTED'))->with('bidder');
    }

    public function feedback()
    {
        return $this->hasOne('App\Feedback')->with('rider');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ArchiveScope());
    }

    public function myBid()
    {
        return $this->hasOne('App\OrderBid', 'order_id');
    }

    public function favourite()
    {
        return $this->hasOne('App\Favourite', 'object_id');
    }

    public function scopeActive($query)
    {
        return $query->where('deliver_date_time', '>=', Carbon::now());
    }

    public function order_payment() {
        return $this->hasOne('App\OrderPayment');
    }
}

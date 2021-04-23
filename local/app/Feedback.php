<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public function order() {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public $fillable = ['feedbacks'];
    protected $table = 'ratings';
    /**
     * @return mixed
     */
    public function rateable()
    {
        return $this->morphTo();
    }

    /**
     * Rating belongs to a user.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function rider() {
        return $this->belongsTo('App\User', 'user_id');
    }
}

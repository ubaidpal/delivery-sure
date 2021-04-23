<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referrers extends Model
{
    protected $table = 'referrers';
    protected $primaryKey = 'id';

    public function referrerId()
    {
        return $this->belongsTo('App\User', 'referrer_id');
    }

    public function referrerToId()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}

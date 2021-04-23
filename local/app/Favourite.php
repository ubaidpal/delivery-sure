<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    public function order() {
        return $this->belongsTo('App\Order','object_id')->withTrashed()->withoutGlobalScopes();
    }

    public function user() {
        return $this->belongsTo('App\User','object_id');
    }
    public function driver() {
        return $this->belongsTo('App\User','object_id');
    }
}

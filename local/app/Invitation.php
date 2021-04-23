<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function order() {
        return $this->belongsTo('App\Order', 'object_id')->withoutGlobalScopes();
    }
}

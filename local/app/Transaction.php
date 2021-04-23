<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user(){
        return $this->belongsTo('App\User','user_id')->select(['id','first_name','last_name','display_name']);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $table = 'withdrawals';
    protected $primaryKey = 'id';

    protected $fillable =  [''];
    public function seller(){
        return $this->belongsTo('App\User', 'seller_id')->select(['id','display_name','username']);
    }
}

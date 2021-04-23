<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 14-Oct-16 7:03 PM
 * File Name    : RejectedBidScope.php
 */

namespace App\Scops;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class RejectedBidScope implements Scope
{
    public function apply(Builder $builder, Model $model) {
        return $builder->where('status','<>' ,\Config::get('constant_settings.BID_STATUS.REJECTED_PURCHASER'));
    }
}

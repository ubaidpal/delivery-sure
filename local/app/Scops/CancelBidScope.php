<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 22-Jul-16 12:12 PM
 * File Name    : CancelBidScope.php
 */

namespace App\Scops;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CancelBidScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     *
     * @return $this|void
     */
    public function apply(Builder $builder, Model $model) {
        return $builder->where('status', '<>', \Config::get('constant_settings.BID_STATUS.CANCELED_DRIVER'));
    }}

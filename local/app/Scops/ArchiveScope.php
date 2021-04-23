<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 02-Jul-16 6:14 PM
 * File Name    : ArichiveScope.php
 */

namespace App\Scops;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ArchiveScope implements Scope
{
    public function apply(Builder $builder, Model $model) {
        return $builder->where('is_archive', 0);
    }
}

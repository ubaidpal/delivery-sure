<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 15-Jun-16 11:33 AM
 * File Name    : OpenedJobs.php
 */

namespace Repositories\Criteria;

use Repositories\Contracts\RepositoryInterface as Repository;

class OpenedJobs extends Criteria
{
    public function apply($model, Repository $repository) {
        $query = $model->where('status', '=', 0);
        return $query;
    }
}

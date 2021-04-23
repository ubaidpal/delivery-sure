<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 21-Jun-16 11:34 AM
 * File Name    : MyJobs.php
 */

namespace Repositories\Criteria;

use Repositories\Contracts\CriteriaInterface;
use Repositories\Contracts\RepositoryInterface as Repository;
use Repositories\Contracts\RepositoryInterface;

class MyJobs extends  Criteria
{
    protected $user_id;

    /**
     * MyJobs constructor.
     */
    public function __construct($user_id) {
         $this->user_id = $user_id;
    }

    /**
     * @param $model
     * @param \Repositories\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where('bidder_id', $this->user_id)->where('status',1);
        return $query;
    }
}

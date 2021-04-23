<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 13-Jun-16 11:29 AM
 * File Name    : Criteria.php
 */

namespace Repositories\Criteria;

use Repositories\Contracts\RepositoryInterface as Repository;

abstract class Criteria
{
    public abstract function apply($model, Repository $repository);
}

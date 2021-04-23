<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 13-Jun-16 11:31 AM
 * File Name    : CriteriaInterface.php
 */

namespace Repositories\Contracts;

use Repositories\Criteria\Criteria;

interface CriteriaInterface
{
    /**
     * @param bool $status
     *
     * @return $this
     */
    public function skipCriteria($status = TRUE);

    /**
     * @return mixed
     */
    public function getCriteria();

    /**
     * @param Criteria $criteria
     *
     * @return $this
     */
    public function getByCriteria(Criteria $criteria);

    /**
     * @param Criteria $criteria
     *
     * @return $this
     */
    public function pushCriteria(Criteria $criteria);

    /**
     * @return $this
     */
    public function  applyCriteria();
}

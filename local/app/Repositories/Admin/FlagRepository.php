<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 28-Oct-16 11:23 AM
 * File Name    : FlagRepository.php
 */

namespace Repositories\Admin;

use Repositories\Eloquent\Repository;

class FlagRepository extends Repository
{

    function model() {
        return 'App\Report';
    }

    public function getAllReports() {

    }
}

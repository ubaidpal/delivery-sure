<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 22-Jul-16 3:22 PM
 * File Name    : HashId.php
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class HashId extends Facade
{
    protected static function getFacadeAccessor() {
        return 'HashId';
    }
}

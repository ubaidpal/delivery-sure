<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 01-Nov-16 3:20 PM
 * File Name    : PrivacySettings.php
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PrivacySettings extends Facade
{
    protected static function getFacadeAccessor() {
        return 'Privacy';
    }
}

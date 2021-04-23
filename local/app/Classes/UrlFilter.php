<?php

/**
 * Created by   :  Muhammad Yasir
 * Project Name : local
 * Product Name : PhpStorm
 * Date         : 06-11-15 2:35 PM
 * File Name    : UrlFilter.php
 */

namespace App\Classes;

use Illuminate\Support\Facades\Request;

class UrlFilter {

	public static function filter( )
	{
		$uri =  Request::path();
		if (strpos($uri,config('constants_api.API_ROUTE_PREFIX')) !== false) {
			return true;
		}else{
			return false;
		}
	}
}

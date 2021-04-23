<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 22-Jul-16 3:21 PM
 * File Name    : HashId.php
 */

namespace App\Classes;

class HashId
{
    public function encode($id, $hash) {
        return \Hashids::connection($hash)->encode($id);
    }

    public function deCode($id, $hash) {
        return \Hashids::connection($hash)->decode($id)[0];
    }
}

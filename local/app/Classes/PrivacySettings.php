<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 01-Nov-16 3:19 PM
 * File Name    : PrivacySettings.php
 */

namespace App\Classes;

use App\PrivacySetting;

class PrivacySettings
{
    public function check($user_id, $privacy_type) {
        $privacy = $this->getPrivacy($user_id, $privacy_type);
        //echo '<tt><pre>'; print_r($privacy); die;
        if(empty($privacy)) {
            return TRUE;
        }
        if(\Config::get('constant_privacy.' . $privacy_type . '.LOGGED_IN')) {
            //echo '<tt><pre>'; print_r($privacy); die;
            if($privacy->privacy_value == 1) {
                if(\Auth::check()) {
                    return TRUE;
                }
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            //echo '<tt><pre>'; print_r($privacy); die;
            if($privacy->privacy_value == 1) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    private function getPrivacy($user_id, $privacy_type) {
        return $result = PrivacySetting::whereUserId($user_id)->wherePrivacyType($privacy_type)->first();
    }
}

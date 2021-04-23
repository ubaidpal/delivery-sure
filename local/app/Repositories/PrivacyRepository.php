<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 31-Oct-16 12:13 PM
 * File Name    : PrivacyRepository.php
 */

namespace Repositories;

use App\PrivacySetting;
use Repositories\Eloquent\Repository;

class PrivacyRepository extends Repository
{

    function model() {
        return 'App\PrivacySetting';
    }

    public function save($data, $user_id) {
        foreach ($data as $type => $value) {
            $savedPrivacy = $this->checkPrivacy($type, $user_id);
            if($savedPrivacy) {
                $savedPrivacy->privacy_value = $value;
                $savedPrivacy->save();
            } else {
                $privacy = new PrivacySetting();

                $privacy->user_id       = $user_id;
                $privacy->privacy_type  = $type;
                $privacy->privacy_value = $value;
                $privacy->save();
            }
        }
        return TRUE;
    }

    public function checkPrivacy($type,  $user_id) {
        $result = PrivacySetting::whereUserId($user_id)->wherePrivacyType($type)->first();
        return $result;
    }

    public function getPrivacySettings($user_id) {
        return PrivacySetting::whereUserId($user_id)->pluck('privacy_value', 'privacy_type')->toArray();
    }
}

<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 15-Oct-16 4:20 PM
 * File Name    : ShareRepository.php
 */

namespace Repositories;

use App\Notification;
use App\Share;
use App\User;
use Repositories\Eloquent\Repository;

class ShareRepository extends Repository
{

    function model() {
        return 'App\Share';
    }

    public function getPurchasers($user_id, $driverId, $data, $isApi = FALSE) {
        //$sentList = $this->getSentList($user_id, $driverId);

        $purchasers = User::where('id', '<>', $user_id)
                          ->inRandomOrder()
                          ->where('user_type', '<>', 101)
                          ->limit(10);

        if(!$isApi) {
            $purchasers->select(['id', 'display_name as name', 'profile_photo_url']);
        }
        if(!empty($data[ 'query' ])) {
            $purchasers->where('display_name', 'like', "%" . $data[ 'query' ] . "%");
        }

        $purchasers = $purchasers->get()->toArray();

        return $purchasers;
    }

    public function shareDriver($data, $user_id,$purchasers) {

        $driverId   = $data[ 'driver_id' ];

        foreach ($purchasers as $purchaser) {
            $isShared = $this->isShared($user_id, $purchaser, $driverId);
            if($isShared == 0) {
                $attributes   = array(
                    'resource_id' => $purchaser,
                    'subject_id'  => $user_id,
                    'object_id'   => $driverId,
                    'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.SHARE.NAME'),
                    'type'        => \Config::get('constant_notifications.OBJECT_TYPES.SHARE.ACTIONS.SINGLE_DRIVER'),
                );
                $notification = Notification::create($attributes);

                $notification_id = $notification->id;

                $shareData = [
                    'object_id'       => $driverId,
                    'user_id'         => $user_id,
                    'resource_id'     => $purchaser,
                    'notification_id' => $notification_id,
                    'object_type'     => 'driver'
                ];
                $this->saveShare($shareData);
            }
        }

    }

    private function getSentList($user_id, $driverId) {
        return Share::whereUserId($user_id)->whereDriverId($driverId)->pluck('purchaser_id');
    }

    private function saveShare($shareData) {
        $share                  = new Share();
        $share->object_id       = $shareData[ 'object_id' ];
        $share->user_id         = $shareData[ 'user_id' ];
        $share->resource_id     = $shareData[ 'resource_id' ];
        $share->notification_id = $shareData[ 'notification_id' ];
        $share->object_type     = $shareData[ 'object_type' ];
        $share->save();
    }

    private function isShared($user_id, $resourceId, $objectId, $objectType = 'driver') {
        return Share::whereUserId($user_id)
                    ->whereResourceId($resourceId)
                    ->whereObjectId($objectId)
                    ->whereObjectType($objectType)
                    ->count();
    }

    public function getDrivers($user_id, $driverId, $data, $isAPi = FALSE) {
        $purchasers = User::where('id', '<>', $user_id)
                          ->inRandomOrder()
                          ->where('user_type', 101)
                          ->limit(10);

        if(!$isAPi) {
            $purchasers->select(['id', 'display_name as name', 'profile_photo_url']);
        }
        if(!empty($data[ 'query' ])) {
            $purchasers->where('display_name', 'like', "%" . $data[ 'query' ] . "%");
        }

        $purchasers = $purchasers->get()->toArray();
        return $purchasers;
    }

    public function shareJobs($data, $user_id, $drivers) {

        $jobIid = $data[ 'job_id' ];

        foreach ($drivers as $driver) {
            $isShared = $this->isShared($user_id, $driver, $jobIid);
            if($isShared == 0) {
                $attributes   = array(
                    'resource_id' => $driver,
                    'subject_id'  => $user_id,
                    'object_id'   => $jobIid,
                    'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.SHARE.NAME'),
                    'type'        => \Config::get('constant_notifications.OBJECT_TYPES.SHARE.ACTIONS.SINGLE_JOB'),
                );
                $notification = Notification::create($attributes);

                $notification_id = $notification->id;

                $shareData = [
                    'object_id'       => $jobIid,
                    'user_id'         => $user_id,
                    'resource_id'     => $driver,
                    'notification_id' => $notification_id,
                    'object_type'     => 'job'
                ];
                $this->saveShare($shareData);
            }
        }

    }
}

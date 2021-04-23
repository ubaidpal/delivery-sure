<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 27-Oct-16 4:46 PM
 * File Name    : FlageInapproperiate.php
 */

namespace App\Traits;

use App\Report;
use App\ReportReason;

trait FlagInappropriate
{
    public function getFlagAllReasons($type) {
        return ReportReason::orderByRaw("reason = 'Other' ASC")->whereType($type)->pluck('reason', 'id');
    }

    public function saveOrderFlag($data, $user_id, $type) {
        if($type == 'job') {
            $object_id = \HashId::deCode($data[ 'object_id' ], 'orders');
        } else {
            $object_id = \HashId::deCode($data[ 'object_id' ], 'favourite');
        }

        //$this->isObjectExist($object_id);
        $isAlreadyFlaggedByUser = $this->isAlreadyFlaggedByUser($user_id, $object_id, $type);

        if($isAlreadyFlaggedByUser == 0) {
            $report              = new Report();
            $report->user_id     = $user_id;
            $report->object_type = $type;
            $report->reasons     = serialize($data[ 'flag_reason' ]);
            $report->object_id   = $object_id;
            $report->description = $data[ 'flag_description' ];
            $report->save();

            return [
                'error'   => 0,
                'type'    => 'success',
                'message' => ucfirst($type) . ' flagged successfully'
            ];
        }
        return [
            'error'   => 1,
            'type'    => 'error',
            'message' => ucfirst($type) . ' already flagged by you'
        ];
    }

    private function isAlreadyFlaggedByUser($user_id, $object_id, $type) {
        return Report::whereUserId($user_id)->whereObjectType($type)->whereObjectId($object_id)->count();
    }

    public function isObjectExist($id) {

    }
}

<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 22-Jul-16 11:17 AM
 * File Name    : NotificationRepository.php
 */

namespace Repositories;

use App\Facades\UrlFilter;
use App\Http\Requests\Request;
use App\Notification;
use App\Order;
use App\OrderBid;
use App\Share;
use App\Traits\OrderDetailsTrait;
use App\Traits\UserDetail;
use App\User;
use Carbon\Carbon;
use Repositories\Eloquent\Repository;

class NotificationRepository extends Repository
{

    use OrderDetailsTrait;

    function model() {
        // TODO: Implement model() method.
        return 'App\Notification';
    }

    private function is_api() {
        return \URLFilter::filter();
    }

    public function create_notification($data) {
        $attributes = array(

            'resource_id' => NULL,
            'subject_id'  => NULL,
            'object_id'   => NULL,
            'object_type' => NULL,
            'type'        => NULL,
        );

        $result = array_merge($attributes, $data);
        Notification::create($result);
    }

    public function getNotifications($user_id, $userDetail) {
        $this->markAllRead($user_id);
        $notifications = Notification::whereResourceId($user_id)->orderBy('id', 'DESC')->paginate(12);

        if(count($notifications) > 0) {
            return ['strings' => $this->generateNotificationData($notifications, $userDetail), 'notifications' => $notifications];
        }

    }

    private function generateNotificationData($notifications, $userDetail) {
        $notificationStrings = [];
        foreach ($notifications as $notification) {
            $data = $this->getObjectData($notification->object_type, $notification->object_id, $notification->id, $userDetail,$notification);

            $notificationStrings[] = $this->generateNotificationString($data, $notification);

        }
        return $notificationStrings;

    }

    private function getNotificationString($type) {
        return \Config::get('constant_notifications.NOTIFICATION_STRING.' . $type);
    }

    private function getObjectData($object_type, $object_id, $notificationId, $userDetail,$notification) {
        switch ($object_type) {
            /** @noinspection PhpMissingBreakStatementInspection */
            case \Config::get('constant_notifications.OBJECT_TYPES.ORDER.NAME'):
                $object = Order::whereId($object_id)->withTrashed()->first();
                if(!empty($object)) {
                    $objectUrl                     = route('order-detail', $this->encode($object->id, 'orders'));
                    $objectName                    = $object->title;
                    $orderDetail                   = $this->getOrderDetail($object, TRUE, TRUE);
                    $orderDetail[ 'order_status' ] = $orderDetail['status'];
                    if($userDetail->is('delivery.man')) {
                        $orderDetail[ 'my_bid' ] = $this->getMyBid($object->bids, $userDetail->id);
                        unset($orderDetail[ 'selected_bid' ]);
                        unset($orderDetail[ 'bids' ]);
                    }
                    if(!is_null($orderDetail->deleted_at)) {
                        $orderDetail = [];
                    }
                    $objectData = [
                        'objectUrl'       => $objectUrl,
                        'objectType'      => $object_type,
                        'objectId'        => $this->encode($object_id, 'orders'),
                        'objectName'      => $objectName,
                        'generatedUrl'    => $objectName,
                        'notificationUrl' => $this->generateUrl($objectName, $objectUrl, $notificationId),
                        'objectDetail'    => $orderDetail,
                    ];

                    return $objectData;
                    break;
                } else {
                    $object     = \DB::table('orders')->find($object_id);
                    $objectUrl  = route('order-detail', $this->encode($object_id, 'orders'));
                    $objectName = $object->title;
                    if($object->is_archive == 1) {
                        $objectData = [
                            'objectUrl'       => $objectUrl,
                            'objectType'      => $object_type,
                            'objectId'        => $this->encode($object_id, 'orders'),
                            'objectName'      => $objectName,
                            'generatedUrl'    => $objectName,
                            'notificationUrl' => $this->generateUrl($objectName, $objectUrl, $notificationId),
                            'objectDetail'    => []
                        ];
                        return $objectData;
                        break;
                    }

                }
            /** @noinspection PhpMissingBreakStatementInspection */
            case \Config::get('constant_notifications.OBJECT_TYPES.JOB.NAME'):
                $object = Order::find($object_id);
                if(!empty($object)) {
                    $objectUrl   = route('job-progress', $this->encode($object_id, 'orders'));
                    $objectName  = $object->title;
                    $orderDetail = $this->getOrderDetail($object, TRUE, TRUE);
                    if($userDetail->is('delivery.man')) {
                        $orderDetail[ 'my_bid' ] = $this->getMyBid($object->bids, $userDetail->id);
                        unset($orderDetail[ 'selected_bid' ]);
                        unset($orderDetail[ 'bids' ]);
                    }
                    $objectData = [
                        'objectUrl'       => $objectUrl,
                        'objectType'      => $object_type,
                        'objectId'        => $this->encode($object_id, 'orders'),
                        'objectName'      => $objectName,
                        'generatedUrl'    => $objectName,
                        'notificationUrl' => $this->generateUrl($objectName, $objectUrl, $notificationId),
                        'objectDetail'    => $orderDetail,
                    ];

                    return $objectData;
                    break;
                } else {
                    $object     = \DB::table('orders')->find($object_id);
                    $objectUrl  = route('order-detail', $this->encode($object_id, 'orders'));
                    $objectName = $object->title;
                    if($object->is_archive == 1) {
                        $objectData = [
                            'objectUrl'       => $objectUrl,
                            'objectType'      => $object_type,
                            'objectId'        => $this->encode($object_id, 'orders'),
                            'objectName'      => $objectName,
                            'generatedUrl'    => $objectName,
                            'notificationUrl' => $this->generateUrl($objectName, $objectUrl, $notificationId),
                            'objectDetail'    => [],
                        ];
                        return $objectData;
                        break;
                    }
                }
            case \Config::get('constant_notifications.OBJECT_TYPES.BID.NAME'):

                $object = OrderBid::find($object_id);
                $objectUrl   = route('get.bid.detail', $this->encode($object_id, 'orders'));
                $OrderDetail = Order::whereId($object->order_id)->withOutGlobalScopes()->withTrashed()->first();
                if(!empty($OrderDetail)){
                    $objectName  = $OrderDetail->title;
                    $bidDetail = $this->parseBidDetail($object);
                    $objectData = [
                        'objectUrl'       => $objectUrl,
                        'objectType'      => $object_type,
                        'objectId'        => $this->encode($object_id, 'orders'),
                        'objectName'      => $objectName,
                        'generatedUrl'    => $objectName,
                        'notificationUrl' => $this->generateUrl($objectName, $objectUrl, $notificationId),
                        'objectDetail'    => $bidDetail,
                    ];
                    return $objectData;
                }

                break;
            case \Config::get('constant_notifications.OBJECT_TYPES.SHARE.NAME'):

                if($notification->type == \Config::get('constant_notifications.OBJECT_TYPES.SHARE.ACTIONS.SINGLE_DRIVER')){
                    $object = Share::whereNotificationId($notification->id)->first();
                    $objectUrl   = route('profile', $this->encode($object->object_id, 'favourite'));
                    $objectDetail = User::find($object->object_id);

                        $objectName  = $objectDetail->display_name;

                        $objectData = [
                            'objectUrl'       => $objectUrl,
                            'objectType'      => $object_type,
                            'objectId'        => $this->encode($object_id, 'orders'),
                            'objectName'      => $objectName,
                            'generatedUrl'    => $objectName,
                            'notificationUrl' => $this->generateUrl($objectName, $objectUrl, $notificationId),
                            'objectDetail'    => $objectDetail,
                        ];
                        //echo '<tt><pre>'; print_r($objectData); die;
                        return $objectData;

                }elseif($notification->type == \Config::get('constant_notifications.OBJECT_TYPES.SHARE.ACTIONS.SINGLE_JOB')){
                $object = Share::whereNotificationId($notification->id)->first();
                $objectUrl   = route('order-detail', $this->encode($object->object_id, 'orders'));
                $objectDetail = Order::whereId($object->object_id)->withOutGlobalScopes()->withTrashed()->first();
                    $orderDetail                   = $this->getOrderDetail($objectDetail, TRUE, TRUE);
                    $orderDetail[ 'order_status' ] = $orderDetail[ 'status' ];
                    if($userDetail->is('delivery.man')) {
                        $orderDetail[ 'my_bid' ] = $this->getMyBid($objectDetail->bids, $userDetail->id);
                        unset($orderDetail[ 'selected_bid' ]);
                        unset($orderDetail[ 'bids' ]);
                    }
                    if(!is_null($orderDetail->deleted_at)) {
                        $orderDetail = [];
                    }
                $objectName  = $objectDetail->title;

                $objectData = [
                    'objectUrl'       => $objectUrl,
                    'objectType'      => $object_type,
                    'objectId'        => $this->encode($object_id, 'orders'),
                    'objectName'      => $objectName,
                    'generatedUrl'    => $objectName,
                    'notificationUrl' => $this->generateUrl($objectName, $objectUrl, $notificationId),
                    'objectDetail'    => $orderDetail,
                ];
                //echo '<tt><pre>'; print_r($objectData); die;
                return $objectData;

            }
                break;
            default:
                return '';
                break;
        }
    }

    public function encode($id, $hash) {
        return \Hashids::connection($hash)->encode($id);
    }

    public function deCode($id, $hash) {
        return \Hashids::connection($hash)->decode($id)[ 0 ];
    }

    private function generateNotificationString($data, $notification) {
        //echo '<tt><pre>'; print_r($data); die;
        if(!empty($data)) {
            $string       = $this->getNotificationString($notification->type);
            $resourceData = User::find($notification->subject_id);

            if(!$this->is_api()) {
                $subjectName = "<strong>$resourceData->display_name</strong>";
            } else {
                $subjectName = $resourceData->display_name;
            }

            if($this->is_api()) {
                $notificationString = str_replace('$resource', '', $string);

            } else {
                if(!empty($data[ 'objectName' ])) {

                    $string = str_replace('$object', $data[ 'generatedUrl' ], $string);
                }
                $notificationString = str_replace('$resource', $subjectName, $string);
            }

            return [
                'string'          => $notificationString,
                'notificationUrl' => $data[ 'notificationUrl' ],
                'url'             => $data[ 'objectUrl' ],
                'object'          => [
                    'name'             => $data[ 'objectName' ],
                    'type'             => $data[ 'objectType' ],
                    'id'               => $data[ 'objectId' ],
                    'notificationType' => $notification->type
                ],
                'notification_id' => $notification->id,
                'is_clicked'      => $notification->clicked,
                'is_read'         => $notification->read,
                'subject_id'      => \HashId::encode($notification->subject_id, 'orders'),
                'date'            => Carbon::parse($notification->created_at)->format('Y-m-d H:i:s'),
                'userData'        => $this->userDetail($resourceData, '41x41'),
                'objectDetail'    => $data[ 'objectDetail' ]
            ];
        }
    }

    private function generateUrl($objectName, $objectUrl, $notificationId) {
        $url = base64_encode($objectUrl);
        return $url = route('read-notification', [$url, $this->encode($notificationId, 'notifications')]);
        //return "<a href='$url'>$objectName</a>";
    }

    public function markRead($id, $userId) {
        $notification = Notification::find($this->deCode($id, 'notifications'));
        if($notification->resource_id == $userId) {
            $notification->read    = 1;
            $notification->clicked = 1;
            $notification->save();
            return TRUE;
        }
        return FALSE;
    }

    public function getNotificationCount($userId) {
        return Notification::whereResourceId($userId)->whereRead(0)->whereClicked(0)->count();
    }

    private function markAllRead($user_id) {
        Notification::whereResourceId($user_id)->update(['read' => 1]);
    }
}

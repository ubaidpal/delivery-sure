<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 20-Jul-16 11:06 AM
 * File Name    : FavouriteRepository.php
 */

namespace Repositories;

use App\Events\Notification;
use App\Events\SendEmail;
use App\Favourite;
use App\Order;
use App\Traits\OrderDetailsTrait;
use App\Traits\UserDetail;
use App\User;
use Illuminate\Support\Facades\Config;
use Repositories\Eloquent\Repository;
use App\Invitation;

class InvitationRepository extends Repository
{
    use OrderDetailsTrait;

    //use Invitation;

    function model() {
        // TODO: Implement model() method.
        return 'App\Invitation';
    }

    public function getMyJobs($user_id) {
        return Order::whereUserId($user_id)
                    ->whereStatus(\Config::get('constant_settings.ORDER_STATUS.IN_PROCESS'))
                    ->orderBy('id', 'DESC')
                    ->get();
    }

    /**
     * @param $jobs
     * @param $driverId
     * @param $user_id
     */
    public function sendInvitation($jobs, $driverId, $user_id, $type) {
        $driverId = \Hashids::connection('favourite')->decode($driverId)[ 0 ];
        $user     = User::find($user_id);
        $driver   = User::find($driverId);
        foreach ($jobs as $job) {
            $this->isInvited($job, $driverId, $user_id, $type);
            $invitation = new Invitation();
            $job        = \Hashids::connection('favourite')->decode($job)[ 0 ];

            $invitation->user_id     = $user_id;
            $invitation->object_id   = $job;
            $invitation->object_type = $type;
            $invitation->driver_id   = $driverId;
            $invitation->save();

            $attributes = array(
                'resource_id' => $driverId,
                'subject_id'  => $user_id,
                'object_id'   => $job,
                'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.ORDER.NAME'),
                'type'        => \Config::get('constant_notifications.OBJECT_TYPES.ORDER.ACTIONS.INVITATION'),
            );

            \Event::fire(new Notification($attributes));

        }
        $emailData = array(
            'subject'  => 'Job Invitation',
            'message'  => $user->display_name . ' Invited you to apply on his jobs.',
            'from'     => \Config::get('constant_settings.CONTACT_US_EMAIL'),
            'name'     => \Config::get('constant_settings.APP_NAME'),
            'template' => 'invitation',
            'to'       => $driver->email,
            'jobs'     => $jobs
        );

        \Event::fire(new SendEmail($emailData));

    }

    private function isInvited($job, $driverId, $user_id, $type) {
        return Invitation::whereUserId($user_id)
                         ->whereObjectType($type)
                         ->whereObjectId($job)
                         ->whereDriverId($driverId)
                         ->count();
    }

    public function getInvitedDrivers($user_id, $driverId, $type) {
        return Invitation::whereDriverId($driverId)->whereUserId($user_id)->whereObjectType($type)->lists('object_id')->toArray();
    }

    public function getInvitations($user_id, $type) {
        return Invitation::whereObjectType($type)
                         ->whereDriverId($user_id)
                         ->whereIsArchived(0)
                         ->with('order.owner.ratings')
                         ->paginate(25);
    }

    public function cancelInvitation($id) {
        $invitation              = Invitation::find($id);
        $invitation->is_archived = 1;
        $invitation->save();
        return TRUE;
    }

    public function getAllSendInvitation($id, $type) {
        return Invitation::whereObjectType($type)->whereObjectId($id)->lists('driver_id');
    }

    public function sendJobInvitation($drivers, $job_id, $user_id, $type) {
        $job_id = \HashId::deCode($job_id, 'favourite');
        $user   = User::find($user_id);

        foreach ($drivers as $driver) {
            $driverId = \HashId::deCode($driver, 'favourite');
            $driver   = User::find($driverId);
            $this->isInvitedFromJob($driverId, $job_id, $user_id, $type);

            $invitation = new Invitation();

            $invitation->user_id     = $user_id;
            $invitation->object_id   = $job_id;
            $invitation->object_type = $type;
            $invitation->driver_id   = $driverId;
            $invitation->save();

            $attributes = array(
                'resource_id' => $driverId,
                'subject_id'  => $user_id,
                'object_id'   => $job_id,
                'object_type' => \Config::get('constant_notifications.OBJECT_TYPES.ORDER.NAME'),
                'type'        => \Config::get('constant_notifications.OBJECT_TYPES.ORDER.ACTIONS.INVITATION'),
            );

            \Event::fire(new Notification($attributes));

            $emailData = array(
                'subject'  => 'Job Invitation',
                'message'  => $user->display_name . ' Invited you to apply on his jobs.',
                'from'     => \Config::get('constant_settings.CONTACT_US_EMAIL'),
                'name'     => \Config::get('constant_settings.APP_NAME'),
                'template' => 'invitation-from-job',
                'to'       => $driver->email,
                'job_id'   => $job_id
            );

            \Event::fire(new SendEmail($emailData));

        }

    }

    private function isInvitedFromJob($driver, $job_id, $user_id, $type) {
        return Invitation::whereUserId($user_id)
                         ->whereObjectType($type)
                         ->whereDriverId($driver)
                         ->whereObjectId($job_id)
                         ->count();
    }

    public function parseJobsForInvitation($data) {
        $all = [];
        foreach ($data[ 'jobs' ] as $job) {
            $j                 = $job;
            $j[ 'job_id' ]     = \HashId::encode($job->id, 'favourite');
            $j[ 'is_invited' ] = in_array($job->id, $data[ 'invitedDrivers' ]) ? 1 : 0;
            $all[]             = $j;
        }
        // $all['driver'] = $this->userDetail($data['driver']);
        return $all;
    }

    public function parseDrivers($data) {
        $all = [];
        foreach ($data[ 'drivers' ] as $driver) {
            $d                = $this->userDetail($driver->user);
            $d[ 'driver_id' ] = \HashId::encode($driver->user->id, 'favourite');
            $all[]            = $d;
        }
        return $all;
    }

    public function parseInvitations($invitations, $userId) {

        $all = [];
        $i = 0;
        foreach ($invitations as $invitation) {

            $inv = $this->getOrderDetail($invitation->order, TRUE, TRUE);


            $inv['invitation_id'] = \HashId::encode($invitation->id, 'favourite');
            // $inv['my_bid'] = $this->parseBidDetail($this->getMyBid($invitation->order->bids, $userId));
            $inv[ 'my_bid' ] = $this->getMyBid($invitation->order->bids, $userId);
            $inv[ 'order_status' ] = $invitation->order['status'];
            unset($inv[ 'selected_bid' ]);

            unset($inv[ 'bids' ]);
            unset($invitation->order);
            $all[] = $inv;
            $i++;
        }

        return $all;
    }
}

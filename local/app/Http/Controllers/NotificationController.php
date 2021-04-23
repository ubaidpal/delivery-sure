<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Repositories\NotificationRepository;

class NotificationController extends Controller
{
    protected $user_id;
    protected $user;
    protected $is_api;
    /**
     * @var \Repositories\NotificationRepository
     */
    private $notification;

    /**
     * NotificationController constructor.
     *
     * @param \Repositories\NotificationRepository $notification
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(NotificationRepository $notification, Request $request) {
        $this->notification = $notification;
        $this->user_id   = $request[ 'middleware' ][ 'user_id' ];
        $this->user      = $request[ 'middleware' ][ 'user' ];
        $this->is_api    = $request[ 'allData' ][ 'is_api' ];
    }

    public function index() {
        $data[ 'title' ] = 'All Notifications';
        $data = $this->notification->getNotifications($this->user_id, $this->user);
       if($this->is_api){
           return \Api::success(['results'=> $data['strings']]);
       }
       if(count($data) == 0){
           $data['notifications'] = [];
       }
     //  echo '<tt><pre>'; print_r($data); die;
        return view('notifications.index', $data);
    }

    public function readNotification($url, $id) {
        if($this->notification->markRead($id, $this->user_id)){
            return redirect(base64_decode($url));
        }else{
            return redirect()->back();
        }
    }

    /**
     * @param $userId
     *
     * @return int
     */
    public function getNotificationCount($userId) {
        return $this->notification->getNotificationCount($userId);
    }
}

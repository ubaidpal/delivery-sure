<?php

namespace App\Listeners;

use App\Events\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Repositories\NotificationRepository;

class NotificationListener
{
    protected $notification;

    /**
     * Create the event listener.
     *
     * @param \Repositories\NotificationRepository $notification
     */
    public function __construct(NotificationRepository $notification) {
        $this->notification = $notification;
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\Notification $notification
     *
     * @internal param \App\Listeners\SomeEvent $event
     */
    public function handle(Notification $notification) {
        $data = $notification->getData();
        $this->notification->create_notification($data);
    }
}

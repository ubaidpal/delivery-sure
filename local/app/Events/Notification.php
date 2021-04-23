<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Notification extends Event
{
    use SerializesModels;
    protected $data;

    /**
     * Create a new event instance.
     *
     * @param array $data
     */
    public function __construct(array $data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn() {
        return [];
    }
}

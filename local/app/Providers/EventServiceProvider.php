<?php

namespace App\Providers;

use App\Events\SendEmail;
use App\Events\Notification;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],

        SendEmail::class    => ['App\Listeners\SendEmailListener',],
        Notification::class => ['App\Listeners\NotificationListener',],
        //'Illuminate\Auth\Events\Login'     => ['App\Listeners\LoginEventListener@handle'],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events) {
        parent::boot($events);

        //
    }
}

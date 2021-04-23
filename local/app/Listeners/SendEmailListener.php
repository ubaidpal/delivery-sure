<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 30-Jun-16 2:07 PM
 * File Name    : SendEmailListener.php
 */

namespace App\Listeners;

use App\Events\SendEmail;
use Mail;

class SendEmailListener
{
    public function __construct()
    {
        //
    }

    public function handle(SendEmail $event)
    {
        $data = $event->getData();

        $option = array(
            'to' => \Config::get('constant_settings.FEEDBACK_EMAIL'),
            'from' => null,
            'name' => null,
            'message' => null,
            'from_name'=> \Config::get('constant_settings.APP_NAME'),
            'template' => 'feedback',
            'subject' => 'Feedback!',
        );

        $data= array_merge($option,$data);

        Mail::send('emails.'.$data['template'], ['data' => $data], function ($m) use ($data) {
            $m->from($data['from'], $data['name']);
            $m->to($data['to'], $data['from_name'])->subject($data['subject']);
        });
    }
}

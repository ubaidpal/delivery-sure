<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 22-Jul-16 10:52 AM
 * File Name    : constant_notifications.php
 */
return [
    'OBJECT_TYPES'        => [
        'ORDER' => [
            'NAME'    => 'order',
            'ACTIONS' => [
                'PLACE_BID'    => 'place-bid',
                'INVITATION'   => 'invitation',
                'BID_SELECTED' => 'bid-selected',
            ]
        ],
        'JOB'   => [
            'NAME'    => 'job',
            'ACTIONS' => [
                'READY_TO_DEPART' => 'ready-to-depart',
                'DELIVERED'       => 'delivered',
                'RECEIVED'        => 'received',
            ]
        ],
        'BID'   => [
            'NAME'    => 'bid',
            'ACTIONS' => [
                'REJECTED' => 'reject',
            ]
        ],
        'SHARE' => [
            'NAME'    => 'share',
            'ACTIONS' => [
                'SINGLE_DRIVER' => 'driver',
                'SINGLE_JOB'    => 'job',
                'MULTI_DRIVER'  => 'multi_driver',
            ]
        ]
    ],
    'NOTIFICATION_STRING' => [
        'place-bid'       => '$resource place a bid on your order $object',
        'invitation'      => '$resource invite you to place bid on this job "<b>$object"</b>',
        'bid-selected'    => '$resource has selected your bid for job $object',
        'ready-to-depart' => '$resource is on its way to deliver your order $object',
        'delivered'       => '$resource has been delivered the order $object',
        'received'        => '$resource has been received the order $object you delivered',
        'reject'          => '$resource has been rejected the bid you placed on $object',
        'driver'          => '$resource shared a driver with you "$object"',
        'job'             => '$resource shared a job with you "$object"',
    ]
];

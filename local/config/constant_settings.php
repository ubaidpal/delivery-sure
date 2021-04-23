<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 14-Jun-16 2:00 PM
 * File Name    : constant_settings.php
 */
$url = '';
if(isset($_SERVER[ 'REQUEST_URI' ])) {
    $uri = $_SERVER[ 'REQUEST_URI' ];
    if(strpos($uri, config('constants_api.API_ROUTE_PREFIX')) !== FALSE) {
        $url = '';
    } else {
        $url = config('app.url');
    }
}
return [
    "FEEDBACK_EMAIL"        => "yasir9398@gmail.com",
    "CONTACT_US_EMAIL"      => "yasir9398@gmail.com",
    "APP_NAME"              => "Demedat",
    'USER_TYPES'            => [
        'SUPER_ADMIN'  => 1,
        'PURCHASER'    => 100,
        'DELIVERY_MAN' => 101,
        'RETAILER'     => 102
    ],
    'USER_ROLES'            => [
        '1'   => 1,
        '100' => 2,
        '101' => 3,
        '102' => 4
    ],
    'USERS'                 => [
        100 => 'Purchaser',
        101 => 'Delivery Person',
        102 => 'Business',
    ],
    'DELIVERY_PERSON_FLIP_TYPES' => [
        '1' => 'WALKER',
        '2' => 'BIKER',
        '3' => 'CAR DRIVER',
        '4' => 'SUV DRIVER',
        "6" => 'Stepdeck',
        7 => 'Reefer',
        8 => 'Power Only',
        9 => 'Hopper Bottom',
        10 => 'Double Drop',
        11 => 'Dump Trailer',
        12 => 'Low Boy',
        13 => 'Auto Carrier',
        14 => "Tanker",
        15 => 'B-Train',
        16 => 'Containers',
        17 => 'Conestoga',

        ],

    'DELIVERY_PERSON_TYPES' => [
        'WALKER'       => 1,
        'BIKER'        => 2,
        'CAR DRIVER'   => 3,
        'SUV DRIVER'   => 4,
        'TRUCK DRIVER' => [
            "Stepdeck"      => 6,
            "Reefer"        => 7,
            "Power Only"    => 8,
            "Hopper Bottom" => 9,
            "Double Drop"   => 10,
            "Dump Trailer"  => 11,
            "Low Boy"       => 12,
            "Auto Carrier"  => 13,
            "Tanker"        => 14,
            "B-Train"       => 15,
            "Containers"    => 16,
            "Conestoga"     => 17,

        ],
    ],
    'VEHICLE_TYPES'         => [
        1       => 'Walker',
        2       => 'Biker',
        3       => 'Car',
        4       => 'SUV',
        "TRUCK" => [
            6  => 'Stepdeck',
            7 => 'Reefer',
            8  => 'Power Only',
            9  => 'Hopper Bottom',
            10 => 'Double Drop',
            11 => 'Dump Trailer',
            12 => 'Low Boy',
            13 => 'Auto Carrier',
            14 => 'Tanker',
            15 => 'B-Train',
            16 => 'Containers',
            17 => 'Conestoga',
        ],
    ],
    'WORLDPAY_CLIENT_KEY'   => 'T_C_538a50bd-60ef-4ae1-b6be-810a5193fab5',
    'WORLDPAY_SERVICE_KEY'  => 'T_S_e1f83b95-f873-45e4-8185-5ea35bd5cde5',

    'ORDER_STATUS'     => [
        'IN_PROCESS'      => 0,
        'PAYMENT_PAYED'   => 1,
        'READY_TO_DEPART' => 2,
        'DELIVERED'       => 3,
        'RECEIVED'        => 4,
        //'PENDING_ACCEPTATION' => 5,
    ],
    'ORDER_STATUS_MSG' => [
        0 => 'In Progress',
        1 => 'Job Awarded',
        2 => 'Ready to Depart',
        3 => 'Order Delivered',
        4 => 'Completed',
        //5 => 'Pending Acceptation',
    ],

    'BID_STATUS'               => [
        'SELECTED'           => '1',
        'NOT_SELECTED'       => '0',
        'CANCELED_DRIVER'    => '2',
        'REJECTED_PURCHASER' => '3',
    ],
    'ATTACHMENT_PATH'          => storage_path(),
    'ATTACHMENT_THUMB'         => $url . '/attachment_thumb/',
    'ATTACHMENT_VIDEO_URL_MOD' => $url . '/local/storage/app/attachments/',
    'ATTACHMENT_URL'           => '/photo/',

    'MESSAGES_ATTACHMENT_WIDTH' => 480,
    'ORDER_MESSAGES_TYPE'       => 'orders',

    'STATEMENT_TYPES' => [
        'SALE'                     => 1,
        'WITHDRAW'                 => 2,
        'WITHDRAW_FEE'             => 3,
        'REVERSAL'                 => 4,
        'ORDER_SHIPPING_FEE'       => 5,
        'REVERSAL_FEE'             => 6,
        'DISPUTE_PARTIAL_TRANSFER' => 7
    ],

    'STATEMENT_TYPES_STRING' => [
        1 => 'Sale',
        2 => 'Withdrawal',
        3 => 'Withdrawal Fee',
        4 => 'Sale Reversal',
        5 => 'Order Shipping Fee',
        6 => 'Reversal Fee',
        7 => 'Dispute Partial Payment'
    ],

    'ADMIN_URL_PREFIX'  => 'admin',
    'DEFAULT_LATITUDE'  => '31.56726',
    'DEFAULT_LONGITUDE' => '74.36540',
    //'MAP_API_KEY'       => 'AIzaSyA8Enjob4tWnlsVvCfjYxLAGxczgLnRmg8',
    'MAP_API_KEY'       => 'AIzaSyALvmiLV1E9yZZckxCYDKNPszj5M9ehQp8',

    'DOCUMENT-TYPES' => [
        'FRONT_PICTURE'              => 1,
        'BACK_PICTURE'               => 2,
        'LICENSE_PICTURE'            => 3,
        'COMMERCIAL_LICENSE_PICTURE' => 4,
    ],
    'USERS_APPROVAL' => [
        'START_APPROVAL' => 2,
        'APPROVED'       => 1,
        'BAN'            => 0
    ],
    'ACCESS_TOKENS'  => [
        'bond007', 'bond007'
    ],
    'MARKERS'        => [
        'PURCHASER' => [
            'DEFAULT' => 'purchaser',
            'OTHER'   => 'purchaser_small',
        ],
        'DRIVER'    => [
            'DEFAULT' => 'driver',
            'OTHER'   => 'driver_small',
        ],
        'RETAILER'  => [
            'DEFAULT' => 'retailer',
            'OTHER'   => 'retailer_small',
        ]
    ],
    'PROFILE_IMAGE'  => [
        'MAIN_IMAGE'  => [
            'HEIGHT' => 252,
            'WIDTH'  => 252
        ],
        'SMALL_IMAGE' => [
            'HEIGHT' => 41,
            'WIDTH'  => 41
        ],

        'MEDIUM_IMAGE'  => [
            'HEIGHT' => 61,
            'WIDTH'  => 61
        ],
        'LARGE_IMAGE'   => [
            'HEIGHT' => 254,
            'WIDTH'  => 254
        ],
        'X_LARGE_IMAGE' => [
            'HEIGHT' => 500,
            'WIDTH'  => 500
        ]
    ],
    'PAGINATE'       => 12,

    'PAYMENT_GATEWAY' => [
        'AUTHORIZE_NET' => [
            'ID'              => 1,
            'LOGIN_ID'        => '2q63xDDm',
            //'LOGIN_ID'        => '22q2k8REG',
            'TRANSACTION_KEY' => '2Cb925E82v47BsUn',
            //'TRANSACTION_KEY' => '8GmZ9UX5n378xC8G',
            'SECRET_KEY'      => 'Simon'
        ],
        'WORLDPAY'      => 2,
    ],
    'DEFAULT_GATEWAY' => 'AUTHORIZE_NET',

];

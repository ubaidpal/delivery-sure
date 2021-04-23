<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 01-Nov-16 12:52 PM
 * File Name    : constant-privacy.php
 */
return [
    'PROFILE_PRIVACY'  => [
        'TITLE'     => 'Profile Privacy',
        'KEY'       => 'PROFILE_PRIVACY',
        'LOGGED_IN' => TRUE,
        'OPTIONS'   => [
            0 => 'Public',
            1 => 'Private'
        ]
    ], 'PROFILE_SHARE' => [
        'TITLE'     => 'Profile Share',
        'KEY'       => 'PROFILE_SHARE',
        'LOGGED_IN' => FALSE,
        'OPTIONS'   => [
            0 => 'Yes',
            1 => 'No'
        ]
    ], 'JOB_VIEW'      => [
        'TITLE'     => 'Job View',
        'KEY'       => 'JOB_VIEW',
        'LOGGED_IN' => TRUE,
        'OPTIONS'   => [
            0 => 'Public',
            1 => 'Private'
        ]
    ], 'JOB_SHARE'     => [
        'TITLE'     => 'Job Share',
        'KEY'       => 'JOB_SHARE',
        'LOGGED_IN' => FALSE,
        'OPTIONS'   => [
            0 => 'Yes',
            1 => 'No'
        ]
    ]
];

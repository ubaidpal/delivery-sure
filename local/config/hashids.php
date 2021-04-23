<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'orders' => [
            'salt' => 'demedatsaltpyaasshiar',
            'length' => '8',
            'alphabet' => '1234567890ABCXYZ',
        ],
        'message' => [
            'salt' => 'demedatmessagespyaasshiar',
            'length' => '8',
            'alphabet' => '1234567890ABCXYZ',
        ],
        'favourite' => [
            'salt' => 'demedatfavouritepyaasshiar',
            'length' => '10',
            'alphabet' => '1234567890ABCXYZ',
        ],
        'notifications' => [
            'salt' => 'demedatnotificationspyaasshiar',
            'length' => '9',
            'alphabet' => '1234567890ABCXYZ',
        ],
        'pin_number' => [
            'salt' => 'demedatpinnumberonspyaasshiar',
            'length' => '4',
            'alphabet' => '1234567890ABCDEF',
        ],
        'alternative' => [
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
            'alphabet' => 'your-alphabet-string',
        ],

    ],

];

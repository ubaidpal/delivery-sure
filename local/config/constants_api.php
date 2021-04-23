<?php

/**
 * Created by PhpStorm.
 * User: ubaid.ullah
 * Date: 6/8/2016
 * Time: 11:28 AM
 * File Name    : constants_api.php
 */

    return array(
        'ERROR_CODES'      => array(
            'INVALID_PARAM'    => 1,
            'RESULT_NOT_FOUND' => 2,
            'DETAIL_NOT_FOUND' => 3,
            'TOKEN_EXPIRED'    => 4,
            'ACCESS_DENIED'    => 5,
            'ALREADY_DONE'     => 6,
            'OTHER_ERROR'      => 7,
            'DELETED'          => 7,
            'ALREADY_RATED'     => 8,
        ),
        'ERROR_MESSAGES'   => array(
            'INVALID_PARAM'    => 'Invalid parameters!',
            'RESULT_NOT_FOUND' => 'Result not found!',
            'DETAIL_NOT_FOUND' => 'Detail not found!',
            'code_4'           => 'Access Token Expired!',
            'ACCESS_DENIED'    => 'Access Denied!',
            'TOKEN_EXPIRED'    => 'Access token is Expired!',
            'DELETED'          => 'Item is deleted!',

        ),
        'SUCCESS_MESSAGES' => array(
            'SUCCESS' => 'success',
        ),
        'API_ROUTE_PREFIX' => 'api/v1'
    );

<?php
/**
 * Created by   :  yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 10-Jun-16 2:55 PM
 * File Name    : ubaid-routes.php
 */


Route::group(['middleware' => ['data','auth']], function () {
    Route::get('/withdrawls', 'ManagementController@requestWithdrawal');
    Route::get('/getBankAccount', 'ManagementController@getBankAccount');
    Route::post('/addBankAccount', 'ManagementController@addBankAccount');

    Route::post('/sendWithdrawalRequest', 'ManagementController@sendWithdrawalRequest');
    Route::get('cancelWithdrawalRequest/{id}', 'ManagementController@cancelWithdrawalRequest');

    //Route::get('dashboard/{page?}', 'UserController@dashboard');
});

<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : kinnect2
 * Product Name : PhpStorm
 * Date         : 03-Mar-2016 3:52 PM
 * File Name    : admin-routes.php
 */
Route::get('users/administration/activate/{activation_code}', 'Admin\UsersController@activateAdminAccount');

Route::group(['middleware' => ['auth','admin']], function () {

    Route::group(['prefix' => Config::get('constant_settings.ADMIN_URL_PREFIX')], function () {

        Route::group(['prefix' => 'super-admin'], function () {
            Route::get('claims-unassigned', ['as' => 'super-admin.claims-unassigned', 'uses' => 'Admin\ClaimController@index']);
            Route::get('claims-assigned', ['as' => 'super-admin.claims-assigned', 'uses' => 'Admin\ClaimController@assigned']);
            Route::get('claims-resolved', ['as' => 'super-admin.claims-resolved', 'uses' => 'Admin\ClaimController@get_resolved']);
        });

        Route::group(['middleware' => 'role:super.admin'], function () {
            //Route::get('/', ['as' => 'super', 'uses' => 'Admin\SuperAdminController@index']);
            Route::get('/', ['as' => 'admin.home', 'uses' => 'Admin\SuperAdminController@index']);
            Route::get('users', ['as' => 'admin.users', 'uses' => 'Admin\UsersController@show']);
            Route::get('normal-users', ['as' => 'normal.users', 'uses' => 'Admin\UsersController@normal_users']);
            Route::get('normal-users-edit/{id}', ['as' => 'normal.users.edit', 'uses' => 'Admin\UsersController@normal_users_edit']);
            Route::patch('normal-users-edit/{id}', ['as' => 'normal.users.edit', 'uses' => 'Admin\UsersController@update_normal_user']);
            Route::get('login-admin/{id}', ['as' => 'admin.login', 'uses' => 'Admin\UsersController@admin_login']);
            Route::get('user_search', ['as' => 'admin.user.search', 'uses' => 'Admin\UsersController@search_user']);
            Route::get('pending-approvals', ['as' => 'admin.users.pending', 'uses' => 'Admin\UsersController@pendingUsers']);


            //Approval
            Route::get('users/approve-user/{id}', ['as' => 'users.approve-user', 'uses' => 'Admin\UsersController@approveUser']);
            Route::get('users/ban-user/{id}', ['as' => 'users.ban-user', 'uses' => 'Admin\UsersController@banUser']);
            Route::post('users/reject-document', ['as' => 'users.reject-document', 'uses' => 'Admin\UsersController@rejectDocument']);
            Route::post('users/leave-comment', ['as' => 'users.leave-comment', 'uses' => 'Admin\UsersController@leaveComment']);
            Route::get('users/start-approval/{id}', ['as' => 'users.start-approval', 'uses' => 'Admin\UsersController@startApproval']);
            Route::get('users/get-user/{id}', ['as' => 'users.get-user', 'uses' => 'Admin\UsersController@getUser']);
            Route::get('users/verify-document/{id}/{type?}', ['as' => 'users.verify-document', 'uses' => 'Admin\UsersController@verifyDocument']);
            Route::get('users/disapprove-document/{id}', ['as' => 'users.disapprove-document', 'uses' => 'Admin\UsersController@disapproveDocument']);
            //Settings Routes
            Route::get('settings', ['as' => 'admin.settings', 'uses' => 'Admin\SettingsController@index']);
            Route::post('settings-assign-permission', ['as' => 'admin.assign-permission', 'uses' => 'Admin\SettingsController@store']);

            Route::get('store_transactions', ['as' => 'admin.transactions', 'uses' => 'Admin\SuperAdminController@storeTransactions']);

            //Flag Posts
            Route::get('flagged-posts', ['as' => 'admin.flaggedPosts', 'uses' => 'Admin\SuperAdminController@flaggedPosts']);
            Route::get('dismiss-report/{id}', ['as' => 'admin.dismiss-report', 'uses' => 'Admin\SuperAdminController@dismissReport']);
            Route::get('block-post/{id}', ['as' => 'admin.dismiss-report', 'uses' => 'Admin\SuperAdminController@blockPost']);
            Route::get('postDetail/{id}', 'HomeController@postDetail');

        });

        Route::group(['middleware' => 'role:dispute.manager'], function () {

        });

        // =======******   Start Other Routes    ***** ========  //

        Route::get('claims/search', ['as' => 'claim.search', 'uses' => 'Admin\ClaimController@search']);
        Route::get('order-invoice/{id}', 'Admin\ClaimController@getOrderInvoice');
        // =======******    End Other Routes    ***** ========  //

        Route::group(['prefix' => 'users', 'middleware' => ['permission:create.users']], function () {
            //Route::get('/', 'Admin\UsersController@index');
            Route::get('dashboard', 'Admin\UsersController@index');
            Route::get('create', 'Admin\UsersController@create');
            Route::post('store', 'Admin\UsersController@store');

            Route::post('delete', 'Admin\UsersController@destroy');
            Route::get('edit/{id}', 'Admin\UsersController@edit');
            Route::get('superAdmin/edit/{id}', 'Admin\UsersController@superAdminEdit');
            Route::patch('superAdmin/update/{id}', 'Admin\UsersController@superAdminUpdate');
            Route::patch('update/{id}', 'Admin\UsersController@update');
            Route::post('userStatus', 'Admin\UsersController@userActiveDisabled');
            Route::post('userStatus', 'Admin\UsersController@userActiveDisabled');
            Route::get( 'activate/{activation_code}', 'Admin\UsersController@activateAdminAccount' );
            // =======******   All User Delete    ***** ========  //
            Route::post('allUsrDelete', 'Admin\UsersController@allUsrDelete');

//
        });

        Route::group(['prefix' => 'transactions'], function () {
            Route::get('/', 'Admin\TransactionsController@index');
        });

        //Dashboard Routes
        Route::group(['prefix' => 'dashboard'], function () {
            Route::post('get-date-data', 'Admin\SuperAdminController@getDateData');
        });

        //Other Routes

        Route::get('claim-detail/{id}', ['as' => 'claims-detail', 'uses' => 'Admin\ClaimController@claim_detail']);
        Route::post('claim/assign', ['as' => 'claim.assign', 'uses' => 'Admin\ClaimController@assign']);
        Route::get('claim/assign/{id}', ['as' => 'claim.assign', 'uses' => 'Admin\ClaimController@assign_arbitrator']);
        Route::post('claim/resolved', ['as' => 'claim.resolved', 'uses' => 'Admin\ClaimController@resolved']);

        Route::post('claim/message', 'Admin\ClaimController@message');

        Route::get('withdrawalRequests', 'Admin\TransactionsController@withddrawalRequests');
        Route::post('viewPaymentMethodDetails', 'Admin\TransactionsController@viewPaymentMethodDetails');
        Route::post('chagePaymentStatus', 'Admin\TransactionsController@chagePaymentStatus');
        Route::get('startPaymentProcess/{id}', 'Admin\TransactionsController@startPaymentProcess');
        Route::get('claimRequests', 'Admin\TransactionsController@claimRequests');
        Route::get('startClaimPaymentProcess/{id}', 'Admin\TransactionsController@startClaimPaymentProcess');
        Route::get('viewBankDetails/{id}', 'Admin\TransactionsController@viewBankDetails');
        Route::get('chageClaimPaymentStatus/{id}', 'Admin\TransactionsController@chageClaimPaymentStatus');
        Route::post('saveClaimPaymentinfo/{id}', 'Admin\TransactionsController@saveClaimPaymentinfo');
        Route::post('viewPaymentInfo', 'Admin\TransactionsController@viewPaymentInfo');
        Route::get('makeClaimPayment/{id}', 'Admin\TransactionsController@makeClaimPayment');
        Route::get('getClaimInfo/{id}', 'Admin\TransactionsController@getClaimInfo');

        Route::post('savePaymentinfo/{id}', 'Admin\TransactionsController@savePaymentinfo');
        Route::get('getAttachment/{type}/{id}/{name}', 'Admin\TransactionsController@getAttachment');
        Route::get('changePassword', 'Admin\UsersController@changePassword');
        Route::patch('changePassword/update/{id}', 'Admin\UsersController@adminUpdatePassword');

        Route::get('getProfile', 'Admin\UsersController@getProfile');
        Route::patch('updateProfile', 'Admin\UsersController@updateProfile');

        //=============================== Refer Route ==================================
        Route::get('userRefer', 'Admin\UsersController@getRefer');

        //=============================== Messages Route ==================================
        Route::get('users/{type}', 'Admin\UsersController@getUsers');
        Route::get('getDeliveryMessages', 'Admin\UsersController@getDeliveryMessages');
        Route::get('getBusinessMessages', 'Admin\UsersController@getBusinessMessages');
        //Flagged Reports Routes

        Route::group(['prefix' => 'flagged'], function(){
            Route::get('/all',['as' => 'flagged.all', 'uses' => 'Admin\FlagController@index']);
        });

        Route::post('send-message', 'Admin\SuperAdminController@sendMessage');
    });
});
Route::get('photo/{type}/{file_name}/{fileType?}', 'UserController@getPhoto');

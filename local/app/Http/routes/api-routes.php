<?php
/**
 * Created by PhpStorm.
 * User: ubaid.ullah
 * Date: 6/8/2016
 * Time: 2:09 PM
 */

Route::group(array('prefix' => config('constants_api.API_ROUTE_PREFIX'), 'middleware' => ['oauth', 'data']), function () {
    /* Route::post('test',function(){
       return  $access_token = Authorizer::issueAccessToken();
     });*/

    Route::post('/getBankAccount', 'ManagementController@getBankAccount');
    Route::post('/addBankAccount', 'ManagementController@addBankAccount');

    Route::post('/withdrawls', 'ManagementController@requestWithdrawal');
    Route::post('/sendWithdrawalRequest', 'ManagementController@sendWithdrawalRequest');
    Route::post('/cancelWithdrawalRequest', 'ManagementController@cancelWithdrawalRequest');
    Route::post('/availableBalance', 'ManagementController@getAvailableBalance');
    //get profile api
    Route::post('/profile-setting/{message?}', 'UserController@index');
    Route::post('/profile-setting-update', 'UserController@updateProfile');
    Route::post('delete-vehicle', 'UserController@deleteVehicle');
    Route::post('add-vehicle', 'UserController@addVehicle');

    //========================******  Statement   ******============================//
    Route::group(['prefix' => 'statement'], function () {
        Route::any('/', ['as' => 'statement', 'uses' => 'ManagementController@statement']);
    });
    Route::post('profile', ['as' => 'profile', 'uses' => 'UserController@getProfile']);
    //========================******  Orders Routes   ******============================//

    Route::post('place-order', ['as' => 'place-order', 'uses' => 'OrdersController@getPlaceOrder']);
    Route::post('my-orders/{completed?}', ['as' => 'my-orders', 'uses' => 'OrdersController@myOrders']);
    Route::post('update-order', ['as' => 'update-order', 'uses' => 'OrdersController@update']);
    Route::post('delete-order', ['as' => 'delete-order', 'uses' => 'OrdersController@delete']);
    Route::post('save-order', ['as' => 'save-order', 'uses' => 'OrdersController@allPlaceOrdersPlace']);
    Route::post('archives', ['as' => 'archives', 'uses' => 'OrdersController@getArchives']);
    Route::post('archive-remove', ['as' => 'archive.remove', 'uses' => 'OrdersController@archiveRemove']);
    Route::post('order-payment', ['uses' => 'OrdersController@makeOrderPayment', 'as' => 'order-payment']);

    //========================******  DashBoard   ******============================//

    Route::post('dashboard', ['uses' => 'HomeController@dashboard', 'as' => 'dashboard']);
    Route::post('quick-view', ['uses' => 'HomeController@quickView', 'as' => 'quick-view']);

    //Route::get('dashboard/{page?}', 'UserController@dashboard');

    //========================******  Bid Routes   ******============================//
    Route::post('place-bid', ['uses' => 'OrdersController@placeBid', 'as' => 'place-bid']);
    Route::post('update-bid', ['uses' => 'OrdersController@updateBid', 'as' => 'update-bid']);
    Route::post('all-bids', ['uses' => 'OrdersController@getAllBids', 'as' => 'all-bids']);
    Route::post('reject-bid', ['uses' => 'OrdersController@rejectBid', 'as' => 'reject-bid']);
//========================******  My jobs Routes   ******============================//
    Route::post('my-jobs/{all?}', ['as' => 'my-jobs', 'uses' => 'JobsController@index']);
    Route::post('job-progress', ['as' => 'job-progress', 'uses' => 'JobsController@jobProgress']);
    Route::post('ready-to-depart', ['as' => 'ready-to-depart', 'uses' => 'JobsController@jobDepart']);
    Route::post('delivered', ['as' => 'delivered', 'uses' => 'JobsController@delivered']);
    Route::post('received', ['as' => 'received', 'uses' => 'JobsController@received']);
    Route::post('checklist', ['as' => 'checklist', 'uses' => 'JobsController@checklist']);
    Route::post('my-proposals', ['as' => 'my-proposals', 'uses' => 'JobsController@myProposals']);
    Route::post('completed-jobs', ['as' => 'completed-jobs', 'uses' => 'JobsController@completed']);

    //Job Invitation
    Route::post('invite-job', ['as' => 'invite-job', 'uses' => 'InvitationController@getFavourites']);
    Route::post('send-job-invitation', ['as' => 'send-job-invitation', 'uses' => 'InvitationController@sendJobInvitation']);

    //========================****** For Driver Routes   ******============================//
    Route::post('favourite-jobs', ['as' => 'favourites', 'uses' => 'JobsController@favourites']);
    Route::post('save-job', ['as' => 'save-job', 'uses' => 'JobsController@saveJob']);
    Route::post('remove-job', ['as' => 'remove-job', 'uses' => 'JobsController@saveJob']);

    //========================******  add lat lng driver Info   ******============================//
    Route::post('get-loc', ['as' => 'favourites', 'uses' => 'JobsController@gatLat']);
    Route::post('save-loc', ['as' => 'save-job', 'uses' => 'JobsController@saveLat']);

    //========================******  ready to depart Jobs   ******============================//
    Route::post('get-jobs', ['as' => 'get-jobs', 'uses' => 'JobsController@getDepartJobs']);
    //========================****** For Purchaser Routes   ******============================//

    //========================****** archive Routes   ******============================//
    Route::post('archive', ['as' => 'archive', 'uses' => 'OrdersController@archive']);
    Route::post('remove-archive', ['as' => 'remove-archive', 'uses' => 'OrdersController@removeArchive']);

    //========================****** FeedBacks Routes   ******============================//
    Route::post('feedback', ['as' => 'feedback', 'uses' => 'JobsController@feedback']);
    Route::post('feedback-delivery-person', ['as' => 'feedback-delivery-person', 'uses' => 'JobsController@feedbackClient']);
    Route::post('show-feedback', ['as' => 'show-feedback', 'uses' => 'JobsController@showFeedback']);
    Route::post('checklist', ['as' => 'checklist', 'uses' => 'JobsController@checklist']);
    //========================****** My Jobs FeedBacks Routes   ******============================//
    Route::post('deliveryFeedback', ['as' => 'feedbackMyJobs', 'uses' => 'UserController@getDeliveryApiJobsFeedbacks']);
    //========================****** My Jobs FeedBacks Routes   ******============================//
    Route::post('purchaserFeedback', 'UserController@getPurchaserApiJobsFeedbacks');
    //========================****** Messages Routes   ******============================//
    Route::group(['prefix' => 'messages'], function () {

        Route::post('/', ['uses' => 'MessageController@index', 'as' => 'messages']);
        Route::post('contact-bidder', ['uses' => 'MessageController@contactBidder', 'as' => 'contact-bidder']);
        Route::post('store', ['uses' => 'MessageController@store', 'as' => 'message.store']);
        Route::post('singleConversation', 'MessageController@get_messages');

    });

    //========================******  My Invitations   ******============================//
    Route::post('notifications', ['as' => 'notifications', 'uses' => 'NotificationController@index']);
    Route::post('read-notification/{url}/{id}', ['as' => 'read-notification', 'uses' => 'NotificationController@readNotification']);
    Route::post('invite', ['as' => 'invite', 'uses' => 'InvitationController@getJobs']);
    Route::post('send-invitation', ['as' => 'send-invitation', 'uses' => 'InvitationController@sendInvitation']);
    //Favourites

    Route::post('find-driver', ['as' => 'find-driver', 'uses' => 'FavouriteController@index']);

    // Find Drivers
    Route::post('invitations', ['as' => 'invitations', 'uses' => 'InvitationController@index']);
    Route::post('cancel-invitation', ['as' => 'cancel-invitation', 'uses' => 'InvitationController@cancelInvitation']);
    Route::post('search-driver/{screen?}', ['as' => 'search-driver', 'uses' => 'FavouriteController@searchDriver']);
    Route::post('add-favourite-driver', ['as' => 'add-favourite', 'uses' => 'FavouriteController@addFavourite']);
    Route::post('remove-favourite-driver', ['as' => 'remove-favourite-driver', 'uses' => 'FavouriteController@addFavourite']);
    Route::post('favourite-driver-list', ['as' => 'favourites', 'uses' => 'FavouriteController@favouritesDriver']);

    //Make a deail

    Route::post('get-make-deal', ['uses' => 'OrdersController@getBidDetail', 'as' => 'get-bid-detail']);
    Route::post('order-payment/{id}', ['uses' => 'OrdersController@makeOrderPayment', 'as' => 'order-payment-app']);


    //Share
    Route::group(['prefix' => 'share'], function () {
        Route::get('modal/{id}', ['as' => 'share.modal', 'uses' => 'ShareController@index']);
        Route::post('share-driver', ['as' => 'share.driver', 'uses' => 'ShareController@shareDriver']);
        Route::get('share-job/{id}', ['as' => 'share.job', 'uses' => 'ShareController@getDrivers']);
        Route::post('share-job', ['as' => 'share.jobs', 'uses' => 'ShareController@shareJobs']);
        Route::post('purchasers-list', ['as' => 'share.get-purchasers', 'uses' => 'ShareController@getPurchasers']);
        Route::post('drivers-list', ['as' => 'share.get-drivers', 'uses' => 'ShareController@getDriversAll']);
    });

    // Reports Route
    Route::group(['prefix' => 'flag'], function () {
        Route::post('save', 'OrdersController@saveOrderFlag');
        Route::post('get-reasons', 'OrdersController@getReportReasons');
    });

});

Route::group(array('prefix' => config('constants_api.API_ROUTE_PREFIX'), 'middleware' => ['api_middleware']), function () {
    Route::post('/login', 'ApiController@login');
    Route::post('/signUp-user', 'ApiController@signUp');
    Route::get('/country-list', 'ApiController@gitCountryList');

//========================******  Orders Routes   ******============================//
    Route::post('order-detail', ['as' => 'order-detail', 'uses' => 'OrdersController@orderDetail']);

    Route::post('{type}/{file_name}', 'UserController@getPhoto');

    Route::post('filter', ['as' => 'filter', 'uses' => 'HomeController@filter']);
    Route::post('forget-password', ['as' => 'forget-password', 'uses' => 'Auth\ApiPasswordController@forget_password']);

});

<?php
// Withdraws Routes

Route::group(['middleware' => ['data','auth']], function () {
    Route::get('/withdrawls', 'ManagementController@requestWithdrawal');
    Route::get('/getBankAccount', 'ManagementController@getBankAccount');
    Route::post('/addBankAccount', 'ManagementController@addBankAccount');

    Route::post('/sendWithdrawalRequest', 'ManagementController@sendWithdrawalRequest');
    Route::get('cancelWithdrawalRequest/{id}', 'ManagementController@cancelWithdrawalRequest');

    //Route::get('dashboard/{page?}', 'UserController@dashboard');
});

Route::group(['middleware' => ['auth', 'data']], function () {


    Route::group(['middleware' => ['permission:create.order']], function () {

        Route::get('place-order', ['as' => 'place-order', 'uses' => 'OrdersController@getPlaceOrder']);
        Route::get('my-orders/{all?}', ['as' => 'my-orders', 'uses' => 'OrdersController@myOrders']);
        Route::post('place-order', ['as' => 'place-order', 'uses' => 'OrdersController@allPlaceOrdersPlace']);
        Route::get('update-order/{id}', ['as' => 'update-order', 'uses' => 'OrdersController@edit']);
        Route::put('update-order/{id}', ['as' => 'update-order', 'uses' => 'OrdersController@update']);
        Route::get('delete-order/{id}', ['as' => 'delete-order', 'uses' => 'OrdersController@delete']);
        Route::get('archive/{id}', ['as' => 'archive', 'uses' => 'OrdersController@archive']);
        Route::get('archive-remove/{id}', ['as' => 'archive.remove', 'uses' => 'OrdersController@archiveRemove']);
        Route::get('archives', ['as' => 'archives', 'uses' => 'OrdersController@getArchives']);

        Route::get('all-bids/{id}', ['uses' => 'OrdersController@getAllBids', 'as' => 'all-bids']);
        Route::post('order-payment/{id}', ['uses' => 'OrdersController@makeOrderPayment', 'as' => 'order-payment']);
        Route::get('contact-bidder/{id}/{order_id}', ['uses' => 'MessageController@contactBidder', 'as' => 'contact-bidder']);
        Route::post('reject-bid', ['uses' => 'OrdersController@rejectBid', 'as' => 'reject-bid']);


        Route::get('order/re-post/{id}', ['uses' => 'OrdersController@rePostOrder', 'as' => 'order.repost']);
    });

    //========================******  Place Bid   ******============================//
    Route::group(['middleware' => ['permission:delivery.man']], function () {
        //========================******  DashBoard   ******============================//

        Route::get('dashboard', ['uses' => 'HomeController@dashboard', 'as' => 'dashboard']);
        Route::get('quick-view/{id}', ['uses' => 'HomeController@quickView', 'as' => 'quick-view']);

        //Route::get('dashboard/{page?}', 'UserController@dashboard');

        Route::get('dashboard/viewMoreCategory/{page?}', ['uses' => 'HomeController@viewMoreCategory', 'as' => 'dashboard-categories']);
        Route::post('dashboard/showMoreCategory/{page?}', ['uses' => 'HomeController@showMoreJob', 'as' => 'dashboard-all-jobs']);

        Route::post('place-bid', ['uses' => 'OrdersController@placeBid', 'as' => 'place-bid']);
        Route::put('update-bid/{id}', ['uses' => 'OrdersController@updateBid', 'as' => 'update-bid']);
        Route::get('cancel-bid/{id}', ['uses' => 'OrdersController@cancelBid', 'as' => 'cancel-bid']);
    });

    Route::get('get-bid-detail/{id}', ['uses' => 'OrdersController@getBidDetail', 'as' => 'get-bid-detail']);
    Route::get('bid-detail/{id}', ['uses' => 'OrdersController@getSelectedBid', 'as' => 'bid.detail']);
    Route::get('single-bid-detail/{id}', ['uses' => 'OrdersController@singleBid', 'as' => 'get.bid.detail']);
    Route::get('my-bid-detail/{id}', ['uses' => 'OrdersController@bidDetailDriver', 'as' => 'bid.detail-driver']);

    //========================******  My JOBS   ******============================//
    Route::group(['middleware' => ['permission:delivery.man']], function () {
        Route::get('my-jobs/{all?}', ['as' => 'my-jobs', 'uses' => 'JobsController@index']);
        Route::get('favourite-jobs', ['as' => 'favourites', 'uses' => 'JobsController@favourites']);
        Route::get('remove-favourite/{id}', ['as' => 'remove-favourite', 'uses' => 'JobsController@removeFavourite']);

        Route::post('order/delivered-pin', ['as' => 'order.received.pin', 'uses' => 'JobsController@deliveredByPin']);

    });
    Route::get('completed-jobs/{all?}', ['as' => 'completed-jobs', 'uses' => 'JobsController@completed']);
    Route::get('job-progress/{id}', ['as' => 'job-progress', 'uses' => 'JobsController@jobProgress']);
    Route::get('ready-to-depart/{id}', ['as' => 'ready-to-depart', 'uses' => 'JobsController@jobDepart']);
    Route::get('delivered/{id}', ['as' => 'delivered', 'uses' => 'JobsController@delivered']);
    Route::post('feedback', ['as' => 'feedback', 'uses' => 'JobsController@feedback']);
    Route::post('feedback-delivery-person', ['as' => 'feedback-delivery-person', 'uses' => 'JobsController@feedbackClient']);
    Route::post('checklist', ['as' => 'checklist', 'uses' => 'JobsController@checklist']);
    Route::get('my-proposals/{other?}', ['as' => 'my-proposals', 'uses' => 'JobsController@myProposals']);
    Route::get('show-feedback/{id}', ['as' => 'show-feedback', 'uses' => 'JobsController@showFeedback']);
    Route::get('received/{id}/{path?}', ['as' => 'received', 'uses' => 'JobsController@received']);
    Route::post('save-job', ['as' => 'save-job', 'uses' => 'JobsController@saveJob']);

    //========================******  My Invitations   ******============================//
    Route::group(['middleware' => ['permission:delivery.man']], function () {
        Route::get('invitations', ['as' => 'invitations', 'uses' => 'InvitationController@index']);
        Route::get('cancel-invitation/{id}', ['as' => 'cancel-invitation', 'uses' => 'InvitationController@cancelInvitation']);

    });

    //========================******  My Invitations   ******============================//
    Route::get('notifications', ['as' => 'notifications', 'uses' => 'NotificationController@index']);
    Route::get('read-notification/{url}/{id}', ['as' => 'read-notification', 'uses' => 'NotificationController@readNotification']);
//========================******  Messages   ******============================//
    Route::group(['prefix' => 'messages'], function () {

        Route::get('/', ['uses' => 'MessageController@index', 'as' => 'messages']);
        Route::post('store', ['uses' => 'MessageController@store', 'as' => 'message.store']);
        Route::post('/create-group', 'MessageController@create_group');
        Route::post('/add-member-to-group', 'MessageController@add_member_to_group');
        Route::post('/new-message', 'MessageController@get_new_message');
        Route::get('new-thread', 'MessageController@get_new_message');
        Route::post('/rename-conversation', 'MessageController@update');
        Route::get('leave-group/{id}', 'MessageController@leave_group');
        Route::post('get-thread', 'MessageController@get_thread');
        Route::post('members-detail', 'MessageController@get_user_detail');
        Route::post('get-group-name', 'MessageController@get_conv_name');
        Route::get('leave-group-api/{id}/{user}', 'MessageController@leave_group');
        Route::post('upload-attachment', 'MessageController@upload_attachment');
        Route::post('friends-detail', 'MessageController@get_friends_detail');
        Route::post('getUserByID', 'MessageController@getUserByID');
        Route::post('save-chat-message', 'MessageController@store');
        Route::post('/{userid}/{id}', 'MessageController@show');
        Route::get('/{userid}/{id}', 'MessageController@get_messages');
        Route::post('update', 'MessageController@updateMessages');
    });

    //========================******  Statement   ******============================//
    Route::group(['prefix' => 'statement'], function () {
        Route::any('/', ['as' => 'statement', 'uses' => 'ManagementController@statement']);
    });
    Route::get('change-password', ['as' => 'change-password', 'uses' => 'UserController@changePassword']);
    Route::post('change-password', ['as' => 'change-password', 'uses' => 'UserController@updatePassword']);

    //Favourites
    Route::group(['middleware' => ['permission:create.order']], function () {
        Route::get('find-driver/', ['as' => 'find-driver', 'uses' => 'FavouriteController@index']);
        Route::get('find-driver/{screen?}', ['as' => 'find-driver', 'uses' => 'FavouriteController@index']);
        Route::post('add-favourite', ['as' => 'add-favourite', 'uses' => 'FavouriteController@addFavourite']);
        Route::get('search-driver/{screen?}', ['as' => 'search-driver', 'uses' => 'FavouriteController@searchDriver']);
        Route::get('driver-quick-view/{id}', ['as' => 'quick-view.driver', 'uses' => 'UserController@quickView']);

        Route::get('invite/{id}', ['as' => 'invite', 'uses' => 'InvitationController@getJobs']);
        Route::post('send-invitation', ['as' => 'send-invitation', 'uses' => 'InvitationController@sendInvitation']);
        Route::post('send-job-invitation', ['as' => 'send-job-invitation', 'uses' => 'InvitationController@sendJobInvitation']);
        Route::get('invite-job/{id}', ['as' => 'invite-job', 'uses' => 'InvitationController@getFavourites']);

        Route::get('favourite-drivers', ['as' => 'favourite-jobs-purchaser', 'uses' => 'FavouriteController@favouritesDriver']);
        Route::post('removed-favourite-driver', ['as' => 'removed-favourite-driver', 'uses' => 'FavouriteController@addFavourite']);

        //

    });

    //Route::get('profile/{userId}', ['as' => 'profile', 'uses' => 'UserController@getProfile']);

    // Share Routes

    Route::group(['prefix' => 'share'], function () {
        Route::get('modal/{id}', ['as' => 'share.modal', 'uses' => 'ShareController@index']);
        Route::post('share-driver', ['as' => 'share.driver', 'uses' => 'ShareController@shareDriver']);
        Route::get('share-job/{id}', ['as' => 'share.job', 'uses' => 'ShareController@getDrivers']);
        Route::post('share-job', ['as' => 'share.jobs', 'uses' => 'ShareController@shareJobs']);
        Route::post('get-purchaser', ['as' => 'share.get-purchasers', 'uses' => 'ShareController@getPurchasers']);
        Route::post('get-drivers', ['as' => 'share.get-drivers', 'uses' => 'ShareController@getDriversAll']);
    });

    // Reports Route
    Route::group(['prefix' => 'settings/privacy'], function () {
        Route::get('/',['as' => 'privacy.settings','uses' => 'PrivacyController@index']);
        Route::post('save',['as' => 'settings.save-privacy','uses' => 'PrivacyController@save']);
    });



    Route::group(['prefix' => 'flag'], function () {
        Route::post('save',['as' => 'flag.save','uses' => 'OrdersController@saveOrderFlag']);
        Route::get('get-reasons/{id}/{type?}',['as' => 'flag.get-reasons', 'uses' => 'OrdersController@getReportReasons']);
    });


});
Route::group(['middleware' => ['data']], function () {
    Route::get('/', ['as' => 'landing-page', 'uses' => 'HomeController@index']);
    Route::get('delivery-driver', ['as' => 'delivery-driver', 'uses' => 'HomeController@deliveryDriver']);
    Route::get('retailer', ['as' => 'retailer', 'uses' => 'HomeController@retailer']);
    Route::get('purchaser', ['as' => 'purchaser', 'uses' => 'HomeController@purchaser']);

    Route::get('order-detail/{id}', ['as' => 'order-detail', 'uses' => 'OrdersController@getOrder']);
    Route::get('view-map/{lat}/{lng}/{type}', ['as' => 'view-map', 'uses' => 'OrdersController@viewMap']);

    Route::get('filter', ['as' => 'filter', 'uses' => 'HomeController@filter']);

    Route::post('contact-us', ['as' => 'contact-us', 'uses' => 'UserController@contactUsPost']);
    Route::post('subscribe', ['as' => 'subscribe', 'uses' => 'HomeController@subscribe']);
    Route::get('profile/{userId}', ['as' => 'profile', 'uses' => 'UserController@getProfile']);
    Route::get('terms', 'HomeController@terms');
    Route::get('privacy-policy', 'HomeController@privacyPolicy');
    Route::get('contact-us', ['as' => 'contact-us', 'uses' => 'UserController@contactUs']);
   // Route::post('contact-us', ['as' => 'contact-us', 'uses' => 'UserController@contactUsPost']);
    // Route::get('user/{userId}', ['as' => 'user.profile', 'uses' => 'PagesController@getProfile']);
});

Route::post('access-token', ['as' => 'access-token', 'uses' => 'UserController@accessToken']);
Route::post('check-username', ['as' => 'check-username', 'uses' => 'UserController@checkUsername']);
Route::get('order-details/{id}', ['as' => 'order-detail.share', 'uses' => 'OrdersController@getOrderShare']);
Route::get('user/{userId}', ['as' => 'user.profile', 'uses' => 'PagesController@getProfile']);


Route::group(['prefix' => 'social'], function () {
    Route::get('auth/{type}', 'Auth\SocialAuthController@redirect');
    Route::get('handle/{type}', 'Auth\SocialAuthController@callback');
});


<?php
Route::group(array('middleware' => ['auth','data']), function () {
    Route::post('/profile-setting/update-user-type/{message?}', 'UserController@updateUserType');

    Route::get('/profile-setting/{message?}', 'UserController@index');
    Route::post('/profile-setting', 'UserController@updateProfile');
    Route::post('delete-vehicle', 'UserController@deleteVehicle');

    Route::post('/profile-setting/upload-photo', 'UserController@savePhoto');


    Route::get('my-feedback/{message?}', 'UserController@getFeedbacks');

    Route::get('feedback/my-jobs', ['as'=>'feedback.my-jobs', 'uses'=>'UserController@getJobsFeedbacks']);


});
Route::get('photo/{type}/{file_name}', 'UserController@getPhoto');
Route::get('/activate/resendEmail', 'Auth\AuthController@resendEmail');
Route::get('/activate/{code}', 'Auth\AuthController@activateAccount');
Route::get('user/already-registered', 'Auth\AuthController@userAlreadyRegistered');
Route::get('/registered/login/', 'Auth\AuthController@welcomeMessage');
Route::get('/welcome', 'UserController@index');

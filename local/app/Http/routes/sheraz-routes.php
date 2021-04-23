<?php

Route::group(['middleware' => ['auth', 'data']], function () {
    Route::get('messages/message-center', 'MessagesController@index');
    Route::get('jobs/my-jobs', 'JobsController@index');
    Route::get('jobs/job-progress', 'JobsController@jobprogress');
    Route::get('jobs/job-depart', 'JobsController@jobdepart');
    Route::get('jobs/job-delivered', 'JobsController@jobdelivered');
})

?>

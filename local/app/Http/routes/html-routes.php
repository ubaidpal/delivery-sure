<?php 

Route::get('pages/hello', 'PagesController@hello');
Route::get('pages/index', 'PagesController@index');
Route::get('pages/dashboard', 'PagesController@dashboard');
Route::get('pages/add-bank', 'PagesController@add-bank');
Route::get('pages/add_bank', 'PagesController@add_bank');
Route::get('pages/bidder_view', 'PagesController@bidder_view');
Route::get('pages/change_password', 'PagesController@change_password');
Route::get('pages/job_detail', 'PagesController@job_detail');
Route::get('pages/job_in_progress', 'PagesController@job_in_progress');
Route::get('pages/job_in_progress_depart', 'PagesController@job_in_progress_depart');
Route::get('pages/job_in_progress_feedback', 'PagesController@job_in_progress_feedback');
Route::get('pages/message_center', 'PagesController@message_center');
Route::get('pages/my_jobs', 'PagesController@my_jobs');
Route::get('pages/my_orders', 'PagesController@my_orders');
Route::get('pages/notifications', 'PagesController@notifications');
Route::get('pages/place_an_order', 'PagesController@place_an_order');
Route::get('pages/profile_setting', 'PagesController@profile_setting');
Route::get('pages/statements', 'PagesController@statements');
Route::get('pages/withdrawls', 'PagesController@withdrawls');
Route::get('pages/profile_setting_feedback', 'PagesController@profile_setting_feedback');
Route::get('pages/index_driver', 'PagesController@index_driver');
Route::get('pages/index_purchaser', 'PagesController@index_purchaser');
Route::get('pages/index_retailer', 'PagesController@index_retailer');
Route::get('pages/index_new', 'PagesController@index_new');
Route::get('pages/signup', 'PagesController@signup');
Route::get('pages/rider_profile', 'PagesController@rider_profile');
Route::get('pages/drivers_list', 'PagesController@drivers_list');
Route::get('pages/popups', 'PagesController@popups');
Route::get('pages/order_summary', 'PagesController@order_summary');
Route::get('pages/map-route', 'PagesController@mapRoute');

?>

<?php
Route::group(['namespace' => 'MDHossain\laravelLogs\Http\Controllers', 'middleware' => ['web']], function(){
    Route::get('audit-logs', 'AuditLogsController@index');
    Route::post('audit-logs', 'AuditLogsController@sendMail')->name('audit-logs');
    Route::get('error-logs', 'ErrorLogsController@index');
    Route::post('error-logs', 'ErrorLogsController@sendMail')->name('error-logs');
});
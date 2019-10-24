<?php
Route::group(['namespace' => 'Mdhossain\LaravelLogs\Http\Controllers', 'middleware' => ['web']], function(){
   
    // Audit Logs (22-05-2019, Created By Rajan Bhatta)

    Route::get('audit-log', 'AuditLogsController@index')->name('audit-log');
    Route::get('audit-log-ajax', 'AuditLogsController@ajax')->name('audit-log-ajax');
    Route::get('audit-log-print', 'AuditLogsController@_print')->name('audit-log-print');


    // Error Logs (22-05-2019, Created By Rajan Bhatta)

    Route::get('error-log', 'ErrorLogsController@index')->name('error-log');
    Route::get('error-log-ajax', 'ErrorLogsController@ajax')->name('error-log-ajax');
    Route::get('error-log-print', 'ErrorLogsController@_print')->name('error-log-print');
});
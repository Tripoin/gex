<?php
// arz
Route::group([ 'prefix'=>'request/v2'], function ()
{

    Route::get('/approvable', [
        'as'    => 'manager.request.approvable',
        'uses'  => 'Arz\_ArzManagerController@request_approvable'
    ]);

    Route::get('/approved', [
        'as'    => 'manager.request.approved',
        'uses'  => 'Arz\_ArzManagerController@request_approved'
    ]);

    Route::post('/submit-approved', [
        'as'    => 'manager.request.submit-approved',
        'uses'  => 'Arz\_ArzManagerController@request_submit_approved'
    ]);

});

Route::group([ 'prefix'=>'report/v2'], function ()
{
    Route::group([ 'prefix'=>'request'], function ()
    {
        Route::get('/approved', [
            'as'    => 'manager.report.request.approved',
            'uses'  => 'Arz\_ArzManagerController@report_request_approved'
        ]);

    });
});
// eof arz

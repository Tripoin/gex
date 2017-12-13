<?php
// arz
Route::group([ 'prefix'=>'request/v2'], function ()
{

    Route::get('/approvereq-payable', [
        'as'    => 'manager.request.approvereq.payable',
        'uses'  => 'Arz\_ArzManagerController@request_payable'
    ]);

    Route::get('/approved', [
        'as'    => 'manager.request.approved',
        'uses'  => 'Arz\_ArzManagerController@request_approved'
    ]);

    Route::post('/submit-payable', [
        'as'    => 'manager.request.submit',
        'uses'  => 'Arz\_ArzManagerController@req_submit'
    ]);

    Route::post('/submit-approved-payable', [
        'as'    => 'manager.request.submit-approved-payable',
        'uses'  => 'Arz\_ArzManagerController@request_submit_payable'
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

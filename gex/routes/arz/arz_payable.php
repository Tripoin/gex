<?php

// arz
Route::group([ 'prefix'=>'request/v2'], function ()
{
    Route::get('/list', [
        'as'    => 'payable.request.list',
        'uses'  => 'Arz\_ArzPayableController@request_list'
    ]);

    Route::get('/create', [
        'as'    => 'payable.request.create',
        'uses'  => 'Arz\_ArzPayableController@request_create'
    ]);

    Route::post('/store', [
        'as'    => 'payable.request.store',
        'uses'  => 'Arz\_ArzPayableController@request_store'
    ]);

    Route::post('/update-status', [
        'as'    => 'payable.request.update-status',
        'uses'  => 'Arz\_ArzPayableController@request_update_status'
    ]);

    Route::post('/submit-approvable', [
        'as'    => 'payable.request.submit-approvable',
        'uses'  => 'Arz\_ArzPayableController@request_submit_approvable'
    ]);

    Route::post('/store', [
        'as'    => 'payable.request.store',
        'uses'  => 'Arz\_ArzPayableController@request_store'
    ]);

    Route::get('/detail-jobsheet/{id}', [
        'as'    => 'payable.request.detail-jobsheet',
        'uses'  => 'Arz\_ArzPayableController@request_detail_jobsheet'
    ]);

    Route::get('/approvable', [
        'as'    => 'payable.request.approvable',
        'uses'  => 'Arz\_ArzPayableController@request_approvable'
    ]);

    Route::get('/approved', [
        'as'    => 'payable.request.approved',
        'uses'  => 'Arz\_ArzPayableController@request_approved'
    ]);

    Route::get('/', [
        'as'    => 'payable.request.index',
        'uses'  => 'Arz\_ArzPayableController@request_index'
    ]);
});

Route::group([ 'prefix'=>'report/v2'], function ()
{
    Route::group([ 'prefix'=>'request'], function ()
    {
        Route::get('/requested', [
            'as'    => 'payable.report.request.requested',
            'uses'  => 'Arz\_ArzPayableController@report_request_requested'
        ]);

        Route::get('/approvable', [
            'as'    => 'payable.report.request.approvable',
            'uses'  => 'Arz\_ArzPayableController@report_request_approvable'
        ]);

        Route::get('/approved', [
            'as'    => 'payable.report.request.approved',
            'uses'  => 'Arz\_ArzPayableController@report_request_approved'
        ]);

    });
});
// eof arz
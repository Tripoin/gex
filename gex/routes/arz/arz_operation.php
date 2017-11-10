<?php
// arz
Route::group([ 'prefix'=>'request/v2'], function ()
{
    Route::get('/list', [
        'as'    => 'operation.request.list',
        'uses'  => 'Arz\_ArzOperationController@request_list'
    ]);

    Route::get('/create', [
        'as'    => 'operation.request.create',
        'uses'  => 'Arz\_ArzOperationController@request_create'
    ]);

    Route::post('/store', [
        'as'    => 'operation.request.store',
        'uses'  => 'Arz\_ArzOperationController@request_store'
    ]);

    Route::get('/detail-jobsheet/{id}', [
        'as'    => 'operation.request.detail-jobsheet',
        'uses'  => 'Arz\_ArzOperationController@request_detail_jobsheet'
    ]);

    Route::get('/approvable', [
        'as'    => 'operation.request.approvable',
        'uses'  => 'Arz\_ArzOperationController@request_approvable'
    ]);

    Route::get('/approved', [
        'as'    => 'operation.request.approved',
        'uses'  => 'Arz\_ArzOperationController@request_approved'
    ]);

    Route::get('/', [
        'as'    => 'operation.request.index',
        'uses'  => 'Arz\_ArzOperationController@request_index'
    ]);
});

Route::group([ 'prefix'=>'report/v2'], function ()
{
    Route::group([ 'prefix'=>'jobsheet'], function ()
    {
        Route::get('/all', [
            'as'    => 'operation.report.jobsheet.all',
            'uses'  => 'Arz\_ArzOperationController@report_jobsheet_all'
        ]);

        Route::get('/completed', [
            'as'    => 'operation.report.jobsheet.completed',
            'uses'  => 'Arz\_ArzOperationController@report_jobsheet_completed'
        ]);

        Route::get('/uncompleted', [
            'as'    => 'operation.report.jobsheet.uncompleted',
            'uses'  => 'Arz\_ArzOperationController@report_jobsheet_uncompleted'
        ]);
    });
    Route::group([ 'prefix'=>'request'], function ()
    {
        Route::get('/requested', [
            'as'    => 'operation.report.request.requested',
            'uses'  => 'Arz\_ArzOperationController@report_request_requested'
        ]);

        Route::get('/approvable', [
            'as'    => 'operation.report.request.approvable',
            'uses'  => 'Arz\_ArzOperationController@report_request_approvable'
        ]);

        Route::get('/approved', [
            'as'    => 'operation.report.request.approved',
            'uses'  => 'Arz\_ArzOperationController@report_request_approved'
        ]);

    });
});
// eof arz
<?php
// arz
Route::group([ 'prefix'=>'request-rc/v2'], function ()
{
    Route::get('/list', [
        'as'    => 'marketing.request-rc.list',
        'uses'  => 'Arz\_ArzMarketingController@request_rc_list'
    ]);

    Route::get('/create', [
        'as'    => 'marketing.request-rc.create',
        'uses'  => 'Arz\_ArzMarketingController@request_rc_create'
    ]);

    Route::post('/store', [
        'as'    => 'marketing.request-rc.store',
        'uses'  => 'Arz\_ArzMarketingController@request_rc_store'
    ]);

    Route::get('/detail-jobsheet/{id}', [
        'as'    => 'marketing.request-rc.detail-jobsheet',
        'uses'  => 'Arz\_ArzMarketingController@request_rc_detail_jobsheet'
    ]);

    Route::get('/approvable', [
        'as'    => 'marketing.request-rc.approvable',
        'uses'  => 'Arz\_ArzMarketingController@request_rc_approvable'
    ]);

    Route::get('/approved', [
        'as'    => 'marketing.request-rc.approved',
        'uses'  => 'Arz\_ArzMarketingController@request_rc_approved'
    ]);

    Route::get('/', [
        'as'    => 'marketing.request-rc.index',
        'uses'  => 'Arz\_ArzMarketingController@request_rc_index'
    ]);
});

Route::group([ 'prefix'=>'report/v2'], function ()
{
    Route::group([ 'prefix'=>'jobsheet'], function ()
    {
        Route::get('/all', [
            'as'    => 'marketing.report.jobsheet.all',
            'uses'  => 'Arz\_ArzMarketingController@report_jobsheet_all'
        ]);

        Route::get('/completed', [
            'as'    => 'marketing.report.jobsheet.completed',
            'uses'  => 'Arz\_ArzMarketingController@report_jobsheet_completed'
        ]);

        Route::get('/uncompleted', [
            'as'    => 'marketing.report.jobsheet.uncompleted',
            'uses'  => 'Arz\_ArzMarketingController@report_jobsheet_uncompleted'
        ]);
    });
    Route::group([ 'prefix'=>'request-rc'], function ()
    {
        Route::get('/requested', [
            'as'    => 'marketing.report.request-rc.requested',
            'uses'  => 'Arz\_ArzMarketingController@report_request_rc_requested'
        ]);

        Route::get('/approvable', [
            'as'    => 'marketing.report.request-rc.approvable',
            'uses'  => 'Arz\_ArzMarketingController@report_request_rc_approvable'
        ]);

        Route::get('/approved', [
            'as'    => 'marketing.report.request-rc.approved',
            'uses'  => 'Arz\_ArzMarketingController@report_request_rc_approved'
        ]);

    });
});
// eof arz

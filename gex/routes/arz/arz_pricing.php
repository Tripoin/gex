<?php
// arz
Route::group([ 'prefix'=>'request/v2'], function ()
{
    Route::get('/list', [
        'as'    => 'pricing.request.list',
        'uses'  => 'Arz\_ArzPricingController@request_list'
    ]);

    Route::get('/create', [
        'as'    => 'pricing.request.create',
        'uses'  => 'Arz\_ArzPricingController@request_create'
    ]);

    Route::post('/store', [
        'as'    => 'pricing.request.store',
        'uses'  => 'Arz\_ArzPricingController@request_store'
    ]);

    Route::post('/store-rc', [
        'as'    => 'pricing.request-rc.store',
        'uses'  => 'Arz\_ArzPricingController@request_rc_store'
    ]);

    Route::get('/detail-jobsheet/{id}', [
        'as'    => 'pricing.request.detail-jobsheet',
        'uses'  => 'Arz\_ArzPricingController@request_detail_jobsheet'
    ]);

    Route::get('/approvable', [
        'as'    => 'pricing.request.approvable',
        'uses'  => 'Arz\_ArzPricingController@request_approvable'
    ]);

    Route::get('/approved', [
        'as'    => 'pricing.request.approved',
        'uses'  => 'Arz\_ArzPricingController@request_approved'
    ]);

    Route::get('/', [
        'as'    => 'pricing.request.index',
        'uses'  => 'Arz\_ArzPricingController@request_index'
    ]);
});

Route::group([ 'prefix'=>'report/v2'], function ()
{
    Route::group([ 'prefix'=>'request'], function ()
    {
        Route::get('/requested', [
            'as'    => 'pricing.report.request.requested',
            'uses'  => 'Arz\_ArzPricingController@report_request_requested'
        ]);

        Route::get('/approvable', [
            'as'    => 'pricing.report.request.approvable',
            'uses'  => 'Arz\_ArzPricingController@report_request_approvable'
        ]);

        Route::get('/approved', [
            'as'    => 'pricing.report.request.approved',
            'uses'  => 'Arz\_ArzPricingController@report_request_approved'
        ]);

    });
});
// eof arz
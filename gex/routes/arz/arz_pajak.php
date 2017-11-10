<?php
// arz
Route::group([ 'prefix'=>'report/v2'], function ()
{
    Route::group([ 'prefix'=>'pajak'], function ()
    {
        Route::get('/all', [
            'as'    => 'pajak.report.all',
            'uses'  => 'Arz\ArzPajakController@report_all'
        ]);
    });

});
// eof arz

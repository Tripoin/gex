<?php
// arz
Route::group([ 'prefix'=>'report/v2'], function ()
{
    Route::group([ 'prefix'=>'receivable'], function ()
    {
        Route::get('/all', [
            'as'    => 'invoice.report.receivable.all',
            'uses'  => 'Arz\_ArzInvoiceController@report_receivable_all'
        ]);

    });

    Route::group([ 'prefix'=>'reimbursement'], function ()
    {
        Route::get('/all', [
            'as'    => 'invoice.report.reimbursement.all',
            'uses'  => 'Arz\_ArzInvoiceController@report_reimbursement_all'
        ]);

    });
});
// eof arz

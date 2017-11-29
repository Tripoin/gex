<?php

include "arz/arz_utility.php";

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
});

Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/home', ['as'=>'home', 'uses'=>'HomeController@index']);

Route::get('/customer','JobsheetController@search');

Route::group(['middleware' => ['web','auth']], function ()
{
    Route::group(['prefix'=>'operation'], function ()
    {
        Route::group([ 'prefix'=>'jobsheet'], function ()
        {
            Route::get('/index', [
                'as'    => 'operation.jobsheet.index',
                'uses'  => '_OperationController@jobsheet_index'
            ]);

            Route::get('/uncreated', [
                'as'    => 'operation.jobsheet.uncreated',
                'uses'  => '_OperationController@jobsheet_uncreated'
            ]);

            Route::post('/store', [
                'as'    => 'operation.jobsheet.store',
                'uses'  => '_OperationController@jobsheet_store'
            ]);

            Route::get('/{id}/show', [
                'as'    => 'operation.jobsheet.show',
                'uses'  => '_OperationController@jobsheet_show'
            ]);

            Route::get('/{id}/edit', [
                'as'    => 'operation.jobsheet.edit',
                'uses'  => '_OperationController@jobsheet_edit'
            ]);

            Route::put('/{id}/update', [
                'as'    => 'operation.jobsheet.update',
                'uses'  => '_OperationController@jobsheet_update'
            ]);

            Route::get('/index/revision', [
                'as'    => 'operation.jobsheet.revision',
                'uses'  => '_OperationController@jobsheet_revision'
            ]);
        });

        include "arz/arz_operation.php";
    });

    Route::group(['prefix'=>'marketing'], function ()
    {
        Route::group([ 'prefix'=>'jobsheet'], function ()
        {
            Route::get('/index/uncreated', [
                'as'    => 'marketing.jobsheet.uncreated',
                'uses'  => '_MarketingController@jobsheet_uncreated'
            ]);

            Route::get('/{job_id}/create', [
                'as'    => 'marketing.jobsheet.create',
                'uses'  => '_MarketingController@jobsheet_create'
            ]);

            Route::post('/{job_id}/store', [
                'as'    => 'marketing.jobsheet.store',
                'uses'  => '_MarketingController@jobsheet_store'
            ]);

            Route::get('/index', [
                'as'    => 'marketing.jobsheet.index',
                'uses'  => '_MarketingController@jobsheet_index'
            ]);

            Route::get('/{job_id}/show', [
                'as'    => 'marketing.jobsheet.show',
                'uses'  => '_MarketingController@jobsheet_show'
            ]);

            Route::get('/{job_id}/edit', [
                'as'    => 'marketing.jobsheet.edit',
                'uses'  => '_MarketingController@jobsheet_edit'
            ]);

            Route::put('/{job_id}/update', [
                'as'    => 'marketing.jobsheet.update',
                'uses'  => '_MarketingController@jobsheet_update'
            ]);

            Route::get('/revisions', [
                'as'    => 'marketing.jobsheet.revision',
                'uses'  => '_MarketingController@jobsheet_revision'
            ]);

            Route::post('/decline', [
                'as'    => 'marketing.jobsheet.decline',
                'uses'  => '_MarketingController@jobsheet_decline'
            ]);
        });

        include "arz/arz_marketing.php";

        //=====UNCREATED================================



        // Route::get('/uncreated/{id}/make', [
        //     'as'    => 'jobsheet.marketing.uncreated.make',
        //     'uses'  => '_MarketingController@uncreated_make'
        // ]);

        // Route::post('/uncreated/{id}/store', [
        //     'as'    => 'jobsheet.marketing.uncreated.store',
        //     'uses'  => '_MarketingController@uncreated_store'
        // ]);

        //=====INDEX====================================

        // Route::get('/index', [
        //     'as'    => 'jobsheet.marketing.index',
        //     'uses'  => '_MarketingController@index'
        // ]);

        // Route::get('/{id}/show', [
        //     'as'    => 'jobsheet.marketing.show',
        //     'uses'  => '_MarketingController@show'
        // ]);

        // Route::get('/{id}/edit', [
        //     'as'    => 'jobsheet.marketing.edit',
        //     'uses'  => '_MarketingController@edit'
        // ]);

        // Route::put('/{id}/update', [
        //     'as'    => 'jobsheet.marketing.update',
        //     'uses'  => '_MarketingController@update'
        // ]);

        // Route::put('/{id}/destroy', [
        //     'as'    => 'jobsheet.marketing.receivable.destroy',
        //     'uses'  => '_MarketingController@receivable_destroy'
        // ]);

        // Route::post('/decline', [
        //     'as'    => 'jobsheet.marketing.decline',
        //     'uses'  => '_MarketingController@decline'
        // ]);

        // Route::get('/revision', [
        //     'as'    => 'jobsheet.marketing.revision',
        //     'uses'  => '_MarketingController@revision'
        // ]);

        // Route::get('/report-job', [
        //     'as'    => 'jobsheet.marketing.reportjob',
        //     'uses'  => '_MarketingController@reportjob'
        // ]);

        // Route::get('/report-charge', [
        //     'as'    => 'jobsheet.marketing.reportcharge',
        //     'uses'  => '_MarketingController@reportcharge'
        // ]);
    });

    Route::group(['prefix'=>'pricing'], function ()
    {
        Route::group([ 'prefix'=>'jobsheet'], function ()
        {
            Route::get('/index', [
                'as'    => 'pricing.jobsheet.index',
                'uses'  => '_PricingController@jobsheet_index'
            ]);

            Route::get('/uncreated', [
                'as'    => 'pricing.jobsheet.uncreated',
                'uses'  => '_PricingController@jobsheet_uncreated'
            ]);

            Route::get('/{id}/create', [
                'as'    => 'pricing.jobsheet.create',
                'uses'  => '_PricingController@jobsheet_create'
            ]);

            Route::put('/{id}/update', [
                'as'    => 'pricing.jobsheet.update',
                'uses'  => '_PricingController@jobsheet_update'
            ]);

            Route::get('/{id}/show', [
                'as'    => 'pricing.jobsheet.show',
                'uses'  => '_PricingController@jobsheet_show'
            ]);

            Route::post('/decline', [
                'as'    => 'pricing.jobsheet.decline',
                'uses'  => '_PricingController@jobsheet_decline'
            ]);

            Route::get('/revision', [
                'as'    => 'pricing.jobsheet.revision',
                'uses'  => '_PricingController@jobsheet_revision'
            ]);
        });

        include "arz/arz_pricing.php";

    });

    Route::group(['prefix'=>'payable'], function ()
    {
        Route::group(['prefix'=>'jobsheet'], function ()
        {
            Route::get('/create_new', [
                'as'    => 'payable.jobsheet.create_new',
                'uses'  => '_PayableController@jobsheet_createnew'
            ]);
            Route::get('/index', [
                'as'    => 'payable.jobsheet.index',
                'uses'  => '_PayableController@jobsheet_index'
            ]);

            Route::get('/{job_id}/show', [
                'as'    => 'payable.jobsheet.show',
                'uses'  => '_PayableController@jobsheet_show'
            ]);

            Route::get('/{job_id}/edit', [
                'as'    => 'payable.jobsheet.edit',
                'uses'  => '_PayableController@jobsheet_edit'
            ]);

            Route::put('/{job_id}/update', [
                'as'    => 'payable.jobsheet.update',
                'uses'  => '_PayableController@jobsheet_update'
            ]);

            Route::put('/decline', [
                'as'    => 'payable.jobsheet.decline',
                'uses'  => '_PayableController@jobsheet_decline'
            ]);
        });

        include "arz/arz_payable.php";

        Route::group(['prefix'=>'payment'], function ()
        {
            Route::get('/payment/payable', [
                'as'    => 'payable.payment',
                'uses'  => '_PayableController@payment_payable'
            ]);

            Route::get('/payment/rc', [
                'as'    => 'payable.payment.rc',
                'uses'  => '_PayableController@payment_rc'
            ]);
        });

        Route::get('{id}/{role}/payment-created', [
            'as'    => 'payable.payment.created',
            'uses'  => '_PayableController@paymentcreated'
        ]);

        Route::post('/payment-submit', [
            'as'    => 'payable.payment.submit',
            'uses'  => '_PayableController@paymentsubmit'
        ]);

        Route::post('/payment-store', [
            'as'    => 'payable.payment.store',
            'uses'  => '_PayableController@paymentstore'
        ]);

        Route::get('/list-payment', [
            'as'    => 'payable.listpayment',
            'uses'  => '_PayableController@listpayment'
        ]);

        Route::get('/list-payment-rc', [
            'as'    => 'payable.listpaymentrc',
            'uses'  => '_PayableController@listpaymentrc'
        ]);

        Route::get('/{id}/{role}/show-payment', [
            'as'    => 'payable.showpayment',
            'uses'  => '_PayableController@showpayment'
        ]);


        Route::post('/decline', [
            'as'    => 'payable.decline',
            'uses'  => '_PayableController@decline'
        ]);

        Route::get('/report', [
            'as'    => 'payable.report',
            'uses'  => '_PayableController@report'
        ]);

        Route::get('/report-payment', [
            'as'    => 'payable.reportpayment',
            'uses'  => '_PayableController@reportpayment'
        ]);

        Route::get('/report-paymentrc', [
            'as'    => 'payable.reportpaymentrc',
            'uses'  => '_PayableController@reportpaymentrc'
        ]);

        Route::get('/overpayment', [
            'as'    => 'payable.overpayment',
            'uses'  => '_PayableController@overpayment'
        ]);

        Route::get('{id}/{type}/show-invoice', [
            'as'    => 'payable.showinvoice',
            'uses'  => '_PayableController@showinvoice'
        ]);

        Route::post('/request-overpayment', [
            'as'    => 'payable.requestoverpayment',
            'uses'  => '_PayableController@requestoverpayment'
        ]);

        Route::get('/list-overpayment', [
            'as'    => 'payable.listoverpayment',
            'uses'  => '_PayableController@listoverpayment'
        ]);
    });

    Route::group(['prefix'=>'invoice'], function ()
    {
        Route::get('index/uncreated', [
            'as'    => 'invoice.receivable.uncreated',
            'uses'  => '_InvoiceController@receivable_uncreated'
        ]);

        Route::get('{job_id}/selection', [
            'as'    => 'invoice.receivable.selection',
            'uses'  => '_InvoiceController@receivable_selection'
        ]);

        Route::post('{job_id}/decline', [
            'as'    => 'invoice.receivable.decline',
            'uses'  => '_InvoiceController@receivable_decline'
        ]);

        Route::post('{id}/create', [
            'as'    => 'invoice.receivable.create',
            'uses'  => '_InvoiceController@receivable_create'
        ]);

        Route::post('{id}/store', [
            'as'    => 'invoice.receivable.store',
            'uses'  => '_InvoiceController@receivable_store'
        ]);

        Route::get('/index', [
            'as'    => 'invoice.receivable.index',
            'uses'  => '_InvoiceController@receivable_index'
        ]);

        Route::get('/{id}/receivable/{rec}/show', [
            'as'    => 'invoice.receivable.show',
            'uses'  => '_InvoiceController@receivable_show'
        ]);

        Route::get('{id}/{type}/edit', [
            'as'    => 'invoice.edit',
            'uses'  => '_InvoiceController@edit'
        ]);

        // Route::get('/{id}/receivable/{rec}/edit', [
        //     'as'    => 'invoice.receivable.edit',
        //     'uses'  => '_InvoiceController@receivable_edit'
        // ]);
    });

    Route::group(['prefix'=>'manager'], function ()
    {
        include "arz/arz_manager.php";

        // temp disable
        //if( 1==2 ) {
            /* Approve Payable */
            Route::get('/payment', [
                'as' => 'listpayment',
                'uses' => '_ManagerController@listpayment'
            ]);

            Route::get('/payment-rc', [
                'as' => 'listpaymentrc',
                'uses' => '_ManagerController@listpaymentrc'
            ]);

            Route::get('/{id}/{role}/show-approve-payment', [
                'as' => 'approve.showpayment',
                'uses' => '_ManagerController@showpayment'
            ]);

            Route::get('{id}/{role}/approve', [
                'as' => 'approve.payment',
                'uses' => '_ManagerController@approvepayment'
            ]);

            Route::get('{id}/{role}/reject', [
                'as' => 'reject.payment',
                'uses' => '_ManagerController@rejectpayment'
            ]);

            Route::get('/approve-payment', [
                'as' => 'approve.payable',
                'uses' => '_ManagerController@payable'
            ]);

            Route::get('/approve-payment-rc', [
                'as' => 'approve.paymentrc',
                'uses' => '_ManagerController@paymentrc'
            ]);

            Route::get('/report', [
                'as' => 'approve.report',
                'uses' => '_ManagerController@report'
            ]);

            /* Approve Receivable */

            Route::get('invoice-cancel', [
                'as'    => 'approverec.invoicecancel',
                'uses'  => '_ManagerController@invoicecancel'
            ]);

            Route::get('invoice-collection', [
                'as'    => 'approverec.invoice',
                'uses'  => '_ManagerController@invoice'
            ]);

            Route::get('/{id}/{type}/show', [
                'as'    => 'approverec.show',
                'uses'  => '_ManagerController@show'
            ]);

            Route::get('/{id}/{type}/print-pdf-invoice', [
                'as'    => 'approverec.printpdf',
                'uses'  => '_ManagerController@pdf'
            ]);

            Route::get('{id}/approve-invoice', [
                'as'    => 'approverec.approve',
                'uses'  => '_ManagerController@approve'
            ]);

            Route::get('{id}/approve-revisi', [
                'as'    => 'approverec.approverevisi',
                'uses'  => '_ManagerController@approverevisi'
            ]);

            Route::post('/decline', [
                'as'    => 'approverec.decline',
                'uses'  => '_ManagerController@decline'
            ]);
        //}
    });

    Route::group(['prefix'=>'pajak'], function ()
    {
        Route::get('/jobsheet', [
            'as'    => 'pajak.jobsheet',
            'uses'  => '_PajakController@jobsheet'
        ]);

        Route::get('/{id}/show', [
            'as'    => 'jobsheet.pajak.show',
            'uses'  => '_PajakController@show'
        ]);

        Route::get('invoice-collection', [
            'as'    => 'pajak.invoice',
            'uses'  => '_PajakController@invoice'
        ]);

        Route::get('{id}/{type}/show-invoice', [
            'as'    => 'pajak.showinvoice',
            'uses'  => '_PajakController@showinvoice'
        ]);

        Route::post('{id}/add-faktur', [
            'as'    => 'pajak.addfaktur',
            'uses'  => '_PajakController@faktur'
        ]);

        Route::get('/report', [
            'as'    => 'pajak.report',
            'uses'  => '_PajakController@report'
        ]);

        include "arz/arz_pajak.php";
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'invoice'], function ()
    {
        Route::post('/{id}/{type}/cancel', [
            'as'    => 'invoice.cancel',
            'uses'  => '_InvoiceController@cancel'
        ]);

        Route::get('uncreated-receivable', [
            'as'    => 'invoice.receivable.uncreatedreceivable',
            'uses'  => '_InvoiceController@uncreatedreceivable'
        ]);

        // Route::get('/{id}/created-receivable', [
        //         'as'    => 'invoice.receivable.created',
        //         'uses'  => '_InvoiceController@createdreceivable'
        // ]);

        // Route::post('/{id}/receivable-store', [
        //         'as'    => 'invoice.receivable.store',
        //         'uses'  => '_InvoiceController@storereceivable'
        // ]);

        // Route::get('/{id}/created-invoice', [
        //         'as'    => 'invoice.created',
        //         'uses'  => '_InvoiceController@createdinvoice'
        // ]);

        Route::post('/{id}/store-invoice', [
            'as'    => 'invoice.store',
            'uses'  => '_InvoiceController@storeinvoice'
        ]);

        Route::post('/decline-receivable', [
            'as'    => 'invoice.decline.receivable',
            'uses'  => '_InvoiceController@declinereceivable'
        ]);

        // Route::get('/invoice-receivable', [
        //         'as'    => 'invoice.receivable',
        //         'uses'  => '_InvoiceController@invoicereceivable'
        // ]);

        // Route::get('/{id}/show-receivable', [
        //         'as'    => 'invoice.show.receivable',
        //         'uses'  => '_InvoiceController@showreceivable'
        // ]);

        Route::get('/{id}/print-pdf-invoice', [
            'as'    => 'invoice.printpdf',
            'uses'  => '_InvoiceController@pdf'
        ]);

        Route::get('/revision-receivable', [
            'as'    => 'invoice.revision.receivable',
            'uses'  => '_InvoiceController@revisionreceivable'
        ]);

        // reimbursement
        Route::get('uncreated-reimbursement', [
            'as'    => 'invoice.reimbursement.uncreatedreimbursement',
            'uses'  => '_InvoiceController@uncreatedreimbursement'
        ]);

        Route::get('/{id}/created-reimbursement', [
            'as'    => 'invoice.reimbursement.created',
            'uses'  => '_InvoiceController@createdreimbursement'
        ]);

        Route::post('/{id}/reimbursement-store', [
            'as'    => 'invoice.reimbursement.store',
            'uses'  => '_InvoiceController@storereimbursement'
        ]);

        Route::post('/{id}/store-invoice-rmb', [
            'as'    => 'invoice.store.reimbursement',
            'uses'  => '_InvoiceController@storeinvoicereimbursement'
        ]);

        Route::get('/invoice-reimbursement', [
            'as'    => 'invoice.reimbursement',
            'uses'  => '_InvoiceController@invoicereimbursement'
        ]);

        Route::get('/{id}/show-reimbursement', [
            'as'    => 'invoice.show.reimbursement',
            'uses'  => '_InvoiceController@showreimbursement'
        ]);

        Route::get('/{id}/print-pdf-invoice-reimbursement', [
            'as'    => 'invoice.printpdfrmb',
            'uses'  => '_InvoiceController@pdfrmb'
        ]);

        Route::get('/revision-reimbursement', [
            'as'    => 'invoice.revision.reimbursement',
            'uses'  => '_InvoiceController@revisionreimbursement'
        ]);

        Route::post('/decline-reimbursement', [
            'as'    => 'invoice.decline.reimbursement',
            'uses'  => '_InvoiceController@declinereimbursement'
        ]);


        // report
        Route::get('/report-receivable', [
            'as'    => 'invoice.report.receivable',
            'uses'  => '_InvoiceController@reportrec'
        ]);
        Route::get('/report-reimbursement', [
            'as'    => 'invoice.report.reimbursement',
            'uses'  => '_InvoiceController@reportrmb'
        ]);

        // Route::get('{id}/{type}/edit', [
        //         'as'    => 'invoice.edit',
        //         'uses'  => '_InvoiceController@edit'
        // ]);

        Route::post('{id}/{type}/{invoice_id}/next-edit', [
            'as'    => 'invoice.nextedit',
            'uses'  => '_InvoiceController@nextedit'
        ]);

        Route::post('{id}/{type}/{invoice_id}/store-edit', [
            'as'    => 'invoice.storeedit',
            'uses'  => '_InvoiceController@storeedit'
        ]);

        include "arz/arz_invoice.php";

    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'receivables'], function ()
    {
        Route::get('invoice-collection', [
            'as'    => 'receivable.invoice',
            'uses'  => '_ReceivableController@invoice'
        ]);

        Route::get('/{id}/{type}/show', [
            'as'    => 'receivable.show',
            'uses'  => '_ReceivableController@show'
        ]);

        Route::get('/{id}/{type}/print-pdf-invoice', [
            'as'    => 'receivable.printpdf',
            'uses'  => '_ReceivableController@pdf'
        ]);

        Route::post('/{id}/add-date', [
            'as'    => 'receivable.adddate',
            'uses'  => '_ReceivableController@adddate'
        ]);

        Route::any('payment', [
            'as'    => 'receivable.payment.create',
            'uses'  => '_ReceivableController@create_payment'
        ]);

        Route::get('overpayment', [
            'as'    => 'receivable.payment.createover',
            'uses'  => '_ReceivableController@create_overpayment'
        ]);

        Route::group(['middleware' => ['auth'], 'prefix' => 'profit'], function ()
        {
            Route::any('index', [
                'as'    => 'receivable.profit.index',
                'uses'  => '_ReceivableController@profit_index'
            ]);

            Route::any('show/{id}', [
                'as'    => 'receivable.profit.show',
                'uses'  => '_ReceivableController@profit_show'
            ]);
        });

        Route::post('filter-invoice', [
            'as'    => 'receivable.filter',
            'uses'  => '_ReceivableController@filter'
        ]);

        Route::post('payment-store', [
            'as'    => 'receivable.payment.store',
            'uses'  => '_ReceivableController@payment_store'
        ]);

        Route::post('filter-invoice-over', [
            'as'    => 'receivable.filterover',
            'uses'  => '_ReceivableController@filterover'
        ]);

        Route::post('payment-store-over', [
            'as'    => 'receivable.payment.storeover',
            'uses'  => '_ReceivableController@payment_storeover'
        ]);

        Route::get('invoice/history', [
            'as'    => 'receivable.history',
            'uses'  => '_ReceivableController@history'
        ]);

        Route::get('{id}/detail-history', [
            'as'    => 'receivable.detailhistory',
            'uses'  => '_ReceivableController@detailhistory'
        ]);

        Route::get('{id}/detail-history', [
            'as'    => 'receivable.detailhistory',
            'uses'  => '_ReceivableController@detailhistory'
        ]);
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'approverec'], function ()
    {
        // move to manager
    });

    Route::group(['prefix'=>'approve'], function ()
    {
        // move to manager
    });


    Route::group(['prefix'=>'master'], function ()
    {
        Route::get('/', function(){
            return redirect('home');
        });

        Route::group(['prefix'=>'users'], function ()
        {
            Route::get('index', [
                'as'    => 'master.user.index',
                'uses'  => 'MasterUserController@index'
            ]);

            Route::post('store', [
                'as'    => 'master.user.store',
                'uses'  => 'MasterUserController@store'
            ]);

            Route::put('{id}/update', [
                'as'    => 'master.user.update',
                'uses'  => 'MasterUserController@update'
            ]);

            Route::delete('{id}/destroy', [
                'as'    => 'master.user.destroy',
                'uses'  => 'MasterUserController@destroy'
            ]);
        });

        Route::group(['prefix'=>'roles'], function ()
        {
            Route::get('index', [
                'as'    => 'master.role.index',
                'uses'  => 'MasterRoleController@index'
            ]);

            Route::post('store', [
                'as'    => 'master.role.store',
                'uses'  => 'MasterRoleController@store'
            ]);

            Route::put('{id}/update', [
                'as'    => 'master.role.update',
                'uses'  => 'MasterRoleController@update'
            ]);

            Route::delete('{id}/destroy', [
                'as'    => 'master.role.destroy',
                'uses'  => 'MasterRoleController@destroy'
            ]);
        });

        Route::group(['prefix'=>'customers'], function ()
        {
            Route::get('index', [
                'as'    => 'master.customer.index',
                'uses'  => 'MasterCustomerController@index'
            ]);

            Route::post('store', [
                'as'    => 'master.customer.store',
                'uses'  => 'MasterCustomerController@store'
            ]);

            Route::put('{id}/update', [
                'as'    => 'master.customer.update',
                'uses'  => 'MasterCustomerController@update'
            ]);

            Route::delete('{id}/destroy', [
                'as'    => 'master.customer.destroy',
                'uses'  => 'MasterCustomerController@destroy'
            ]);
        });

        Route::group(['prefix'=>'vendors'], function ()
        {
            Route::get('index', [
                'as'    => 'master.vendor.index',
                'uses'  => 'MasterVendorController@index'
            ]);

            Route::post('store', [
                'as'    => 'master.vendor.store',
                'uses'  => 'MasterVendorController@store'
            ]);

            Route::put('{id}/update', [
                'as'    => 'master.vendor.update',
                'uses'  => 'MasterVendorController@update'
            ]);

            Route::delete('{id}/destroy', [
                'as'    => 'master.vendor.destroy',
                'uses'  => 'MasterVendorController@destroy'
            ]);
        });

        Route::group(['prefix'=>'banks'], function ()
        {
            Route::get('index', [
                'as'    => 'master.bank.index',
                'uses'  => 'MasterBankController@index'
            ]);

            Route::post('store', [
                'as'    => 'master.bank.store',
                'uses'  => 'MasterBankController@store'
            ]);

            Route::put('{id}/update', [
                'as'    => 'master.bank.update',
                'uses'  => 'MasterBankController@update'
            ]);

            Route::delete('{id}/destroy', [
                'as'    => 'master.bank.destroy',
                'uses'  => 'MasterBankController@destroy'
            ]);
        });

        Route::group(['prefix'=>'documents'], function ()
        {
            Route::get('index', [
                'as'    => 'master.document.index',
                'uses'  => 'MasterDocumentController@index'
            ]);

            Route::get('index/payable', [
                'as'    => 'master.document.index_payable',
                'uses'  => 'MasterDocumentController@index_payable'
            ]);

            Route::post('store', [
                'as'    => 'master.document.store',
                'uses'  => 'MasterDocumentController@store'
            ]);

            Route::put('{id}/update', [
                'as'    => 'master.document.update',
                'uses'  => 'MasterDocumentController@update'
            ]);

            Route::delete('{id}/destroy', [
                'as'    => 'master.document.destroy',
                'uses'  => 'MasterDocumentController@destroy'
            ]);
        });

        Route::group(['prefix'=>'ports'], function ()
        {
            Route::get('index', [
                'as'    => 'master.port.index',
                'uses'  => 'MasterPortController@index'
            ]);

            Route::post('store', [
                'as'    => 'master.port.store',
                'uses'  => 'MasterPortController@store'
            ]);

            Route::put('{id}/update', [
                'as'    => 'master.port.update',
                'uses'  => 'MasterPortController@update'
            ]);

            Route::delete('{id}/destroy', [
                'as'    => 'master.port.destroy',
                'uses'  => 'MasterPortController@destroy'
            ]);
        });

        Route::group(['prefix'=>'rates'], function ()
        {
            Route::get('index', [
                'as'    => 'master.rate.index',
                'uses'  => 'MasterRateController@index'
            ]);

            Route::post('store', [
                'as'    => 'master.rate.store',
                'uses'  => 'MasterRateController@store'
            ]);

            Route::put('{id}/update', [
                'as'    => 'master.rate.update',
                'uses'  => 'MasterRateController@update'
            ]);

            Route::delete('{id}/destroy', [
                'as'    => 'master.rate.destroy',
                'uses'  => 'MasterRateController@destroy'
            ]);
        });

        Route::group(['prefix'=>'units'], function ()
        {
            Route::get('index', [
                'as'    => 'master.unit.index',
                'uses'  => 'MasterUnitController@index'
            ]);

            Route::post('store', [
                'as'    => 'master.unit.store',
                'uses'  => 'MasterUnitController@store'
            ]);

            Route::put('{id}/update', [
                'as'    => 'master.unit.update',
                'uses'  => 'MasterUnitController@update'
            ]);

            Route::delete('{id}/destroy', [
                'as'    => 'master.unit.destroy',
                'uses'  => 'MasterUnitController@destroy'
            ]);
        });

        Route::group(['prefix'=>'terms'], function ()
        {
            Route::get('index', [
                'as'    => 'master.term.index',
                'uses'  => 'MasterTermController@index'
            ]);

            Route::post('store', [
                'as'    => 'master.term.store',
                'uses'  => 'MasterTermController@store'
            ]);

            Route::put('{id}/update', [
                'as'    => 'master.term.update',
                'uses'  => 'MasterTermController@update'
            ]);

            Route::delete('{id}/destroy', [
                'as'    => 'master.term.destroy',
                'uses'  => 'MasterTermController@destroy'
            ]);
        });
    });

    // Route::group(['middleware' => 'level', 'prefix'=>'report'], function ()
    // {
    //     Route::get('/all', [
    //         'as'    => 'report.all',
    //         'uses'  => '_ReportController@all'
    //     ]);

    //     Route::get('/completed', [
    //         'as'    => 'report.completed',
    //         'uses'  => '_ReportController@completed'
    //     ]);

    //     Route::get('/uncompleted', [
    //         'as'    => 'report.uncompleted',
    //         'uses'  => '_ReportController@uncompleted'
    //     ]);

    //     Route::get('requested', [
    //         'as'    => 'report.requested',
    //         'uses'  => '_ReportController@requested'
    //     ]);

    //     Route::get('/unrequested', [
    //         'as'    => 'report.unrequested',
    //         'uses'  => '_ReportController@unrequested'
    //     ]);
    // });

});
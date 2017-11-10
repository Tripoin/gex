<?php
/**
 * Cache Routes Library
 */

Route::group([ 'prefix'=>'artisan'], function () {
    //Clear Cache facade value:
    Route::get('/clear-cache', function () {
        $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
        return '<h1>Cache facade value cleared</h1>';
    });

    //Reoptimized class loader:
    Route::get('/optimize', function () {
        $exitCode = Artisan::call('optimize');
        return '<h1>Reoptimized class loader</h1>';
    });

    //Clear Route cache:
    Route::get('/route-cache', function () {
        $exitCode = Artisan::call('route:cache');
        return '<h1>Route cache cleared</h1>';
    });

    //Clear View cache:
    Route::get('/view-clear', function () {
        $exitCode = Artisan::call('view:clear');
        return '<h1>View cache cleared</h1>';
    });

    //Clear Config cache:
    Route::get('/config-cache', function () {
        $exitCode = Artisan::call('config:cache');
        return '<h1>Clear Config cleared</h1>';
    });

    //Clear Config cache:
    Route::get('/migrate', function () {
        $exitCode = Artisan::call('migrate');
        return '<h1>Migration Complete</h1>';
    });
    Route::get('/seed', function () {
        $exitCode = Artisan::call('db:seed');
        return '<h1>Seed Complete</h1>';
    });

    Route::get('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect('/');
    });
});
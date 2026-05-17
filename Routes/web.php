<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'redirect',
], function ($router) {



    Route::group([
        'as' => 'redirect.',
        'middleware' => 'auth.both:api'
    ], function ($router) {

        Route::match(['get', 'post'], '/forward/{idOrName}', 'RedirectController@redirect')->name("forward"); // Allows GET and POST for index

        Route::match(['get', 'post'], '/forward/device/{idOrName}', 'DeviceRedirectController@redirect')->name("device.forward"); // Allows GET and POST for device redirect index

    });
    



    // You can still have separate routes for other functionality if needed
    Route::middleware(["web","auth"])->group(function () {

        // Exclude 'index' and 'show' for the RedirectController (we don't need them again in this group)
        Route::resource('redirect', 'RedirectController');

        // Exclude 'index' and 'show' for the DeviceRedirectController (we don't need them again in this group)
        Route::resource('device-redirects', 'DeviceRedirectController');
        
    });

    
});

<?php
/*
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'as' => 'api.redirects.',
    'prefix' => 'redirects'
], function ($router) {

    //redirects/forward/{idOrName}
    //redirects/forward/device/{idOrName}

    Route::middleware(['auth.both:api'])->group(function () {

        Route::match(['get', 'post'], '/forward/{idOrName}', 'Api\RedirectController@redirect')->name("forward"); // Allows GET and POST for index

        Route::match(['get', 'post'], '/forward/device/{idOrName}', 'Api\DeviceRedirectController@redirect')->name("device.forward"); // Allows GET and POST for device redirect index

    });
   

    
});
*/
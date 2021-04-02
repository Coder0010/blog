<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.media.'], function () {
    Route::post('media', 'APIWebsiteController@mediaStore')->name('store');
    Route::get('media/{mediaItem}/{size?}', 'APIWebsiteController@mediaShow')->name('show');
});
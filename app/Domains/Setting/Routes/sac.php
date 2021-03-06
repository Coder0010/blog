<?php

/*
|--------------------------------------------------------------------------
| sac Routes
|--------------------------------------------------------------------------
|
| Here is where you can register sac routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'sac' middleware group. Now create something great!
|
*/

Route::group(['middleware' => [ 'auth', 'IsActive' ]], function () {
    Route::get('get-slider-options', 'GetSliderOptions')->name('get-slider-options');
    Route::get('media-setting/key/{key}', 'GetSettingMedia')->name('media-setting');
});

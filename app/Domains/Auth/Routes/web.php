<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Auth::routes(['verify' => false ]);
Route::group(['namespace' => '\App\Domains\Auth\Http\Controllers\EndUser\Auth'], function () {
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group(['middleware' => [ 'auth', 'IsActive' ],], function () {
    Route::post('comment/store', 'EndUserAuthDomainController@storeComment')->name('storeComment');
    Route::put('comment/{comment}/update', 'EndUserAuthDomainController@updateComment')->name('updateComment');
    Route::delete('comment/{comment}/delete', 'EndUserAuthDomainController@deleteComment')->name('deleteComment');
});

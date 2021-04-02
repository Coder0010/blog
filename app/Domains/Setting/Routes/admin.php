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

Route::group(['middleware' => [ 'auth', 'IsAdmin' ]], function () {
    Route::get('settings', 'AdminPanelSettingDomainController@index')->name('settings');

    Route::get('settings/edit', 'AdminSettingController@edit')->name('settings.edit');
    Route::post('settings/update', 'AdminSettingController@update')->name('settings.update');

    Route::resource('blogs', 'AdminBlogsController')->except(['show',]);
    Route::group(['as' => 'blogs.', 'prefix' => 'blogs'], function () {
        Route::get('blogs/{blog}/changeStatus', 'AdminBlogsController@changeStatus')->name('changeStatus');
        Route::delete('/{blog}/delete', 'AdminBlogsController@delete')->name('delete');
        Route::post('/{blog}/restore', 'AdminBlogsController@restore')->name('restore');
        Route::post('/multi-delete', 'AdminBlogsController@multiDelete')->name('multi.delete');
        Route::post('/multi-restore', 'AdminBlogsController@multiRestore')->name('multi.restore');
        Route::post('/multi-order', 'AdminBlogsController@multiOrder')->name('multi.order');
    });
    /*AddAdminRoutesCrud*/
});

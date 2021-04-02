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
    Route::get('generals', 'AdminPanelGeneralDomainController@index')->name('generals');

    Route::group(['namespace' => 'Categories'], function () {
        Route::resource('categories', 'AdminCategoriesController')->except(['show',]);
        Route::group(['as' => 'categories.', 'prefix' => 'categories'], function () {
            Route::get('/{category}/changeStatus', 'AdminCategoriesController@changeStatus')->name('changeStatus');
            Route::delete('/{category}/delete', 'AdminCategoriesController@delete')->name('delete');
            Route::post('/{category}/restore', 'AdminCategoriesController@restore')->name('restore');
            Route::post('/multi-delete', 'AdminCategoriesController@multiDelete')->name('multi.delete');
            Route::post('/multi-restore', 'AdminCategoriesController@multiRestore')->name('multi.restore');
            Route::post('/multi-order', 'AdminCategoriesController@multiOrder')->name('multi.order');
        });
    });
    /*AddAdminRoutesCrud*/
});

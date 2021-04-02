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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'AdminLoginController@showLoginForm')->name('showlogin');
    Route::post('login-check', 'AdminLoginController@login')->name('login');
    Route::post('process-logout', 'AdminLoginController@logout')->name('logout');
    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::get('reset-form', 'AdminForgetPasswordController@showLinkRequestForm')->name('request');
        Route::post('email', 'AdminForgetPasswordController@sendResetLinkEmail')->name('email');
        Route::get('reset/{token?}', 'AdminResetPasswordController@showResetForm')->name('reset');
        Route::post('reset', 'AdminResetPasswordController@reset')->name('update');
    });
});
Route::group(['middleware' => [ 'auth', 'IsAdmin' ]], function () {
    Route::get('auths', 'AdminPanelAuthDomainController@index')->name('auths');

    Route::get('dashboard', 'AdminDashboardController@index')->name('dashboard');
    Route::resource('users', 'AdminUsersController');
    Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
        Route::get('/{user}/changeStatus', 'AdminUsersController@changeStatus')->name('changeStatus');
        Route::delete('/{user}/delete', 'AdminUsersController@delete')->name('delete');
        Route::post('/{user}/restore', 'AdminUsersController@restore')->name('restore');
        Route::post('/multi-delete', 'AdminUsersController@multiDelete')->name('multi.delete');
        Route::post('/multi-restore', 'AdminUsersController@multiRestore')->name('multi.restore');
        Route::post('/multi-order', 'AdminUsersController@multiOrder')->name('multi.order');
    });

    Route::resource('roles', 'AdminRolesController')->except(['show','destory',]);
    Route::group(['as' => 'roles.', 'prefix' => 'roles'], function () {
        Route::delete('/{role}/delete', 'AdminRolesController@delete')->name('delete');
        Route::post('/multi-delete', 'AdminRolesController@multiDelete')->name('multi.delete');
        Route::post('/multi-restore', 'AdminRolesController@multiRestore')->name('multi.restore');
        Route::post('/multi-order', 'AdminRolesController@multiOrder')->name('multi.order');
    });
    /*AddAdminRoutesCrud*/
});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('blogs', 'EndUserSettingDomainController@blogsIndex')->name("blogsIndex");
Route::get('blogs/{blog}', 'EndUserSettingDomainController@blogsShow')->name("blogsShow");
Route::get('blog/{blog}/comments', 'EndUserSettingDomainController@blogComments')->name('blogComments');

Route::group(['middleware' => [ 'auth' ],], function () {

});

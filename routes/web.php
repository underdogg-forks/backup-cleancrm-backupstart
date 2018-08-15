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

Route::get('/', function () {
    return view('front.home');
});

Route::get('/admin', function () {
    return view('auth.login');
});

Auth::routes();

// Dashboard
//Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('dashboard', ['uses' => 'HomeController@index', 'as' => 'dashboard.index']);



// Administrator & owner Control Panel Routes
Route::group(['prefix' => '', 'middleware' => 'auth', 'middleware' => ['role:administrator|owner'], 'namespace' => 'Admin'], function () {

    Route::get('permissions', ['uses' => 'PermissionsController@index', 'as' => 'permissions.index']);



    Route::resource('users', 'UsersController');
    Route::resource('permission', 'PermissionController');
    Route::resource('roles', 'RolesController');
});
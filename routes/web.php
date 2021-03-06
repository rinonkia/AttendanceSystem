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
    return view('home');
})->middleware('auth');


Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => ['auth', 'can:admin']], function() {
    Route::get('admin/user/index', 'UserController@index')->name('admin/user/index');
    Route::get('admin/user/show/{id}', 'UserController@show')->name('admin/user/show');
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('/punchin', 'TimestampsController@punchIn')->name('timestamp/punchin');
    Route::post('/punchout', 'TimestampsController@punchOut')->name('timestamp/punchout');
});

// Other 
Route::get('/{any}', function() {
    return view('home');
})->middleware('auth')->where('any','.*');
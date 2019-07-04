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

Auth::routes();

Route::get('/', 'HomeController@index')->name('landingpage');
Route::get('/home', 'HomeController@home')->name('homepage');

Route::resource('user', 'UserController');
Route::resource('package', 'PackageController');
Route::resource('cart', 'CartController');
Route::resource('transaction', 'TransactionController');

Route::get('organizer', 'UserController@organizer')->name('organizerlist');

Route::get('verifieduser', 'UserController@verifieduser')->name('verifieduser');
Route::get('unverifieduser', 'UserController@unverifieduser')->name('unverifieduser');
Route::get('rejecteduser', 'UserController@rejecteduser')->name('rejecteduser');
Route::get('adminpackage', 'PackageController@adminindex')->name('adminpackage');
Route::get('finishedt', 'TransactionController@finishedt')->name('finishedt');
Route::get('pendingt', 'TransactionController@pendingt')->name('pendingt');

//Proses Verifikasi User
Route::post('/verifikasi', 'UserController@verifikasi')->name('verifikasi.user');

//dynamic select form
Route::get('/json-regencies','UserController@regencies');
Route::get('/json-districts', 'UserController@districts');

//edit password
Route::get('/editpassword/{id}/user', 'UserController@editpassword')->name('edit');
Route::put('/editpassword/{id}', 'UserController@editpassword1')->name('password');
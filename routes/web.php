<?php
use Illuminate\View\View;
use App\User;

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
Route::resource('setting', 'SettingController');
Route::resource('message', 'MessageController');

Route::get('/verifieduser', 'UserController@verifieduser')->name('verifieduser');
Route::get('/unverifieduser', 'UserController@unverifieduser')->name('unverifieduser');
Route::get('/rejecteduser', 'UserController@rejecteduser')->name('rejecteduser');

Route::get('/mypackage', 'PackageController@myindex')->name('myindex');
Route::post('/search', 'PackageController@search')->name('search');

Route::get('/confirmindex', 'TransactionController@confirm')->name('confirm');
Route::get('/pdf/{id}', 'TransactionController@pdf');

Route::get('/pesananpending', 'CartController@pending')->name('pesananpending');
Route::get('/pesanandone', 'CartController@done')->name('pesanandone');
Route::get('/upcoming', 'CartController@upcoming')->name('upcoming');

//Proses Verifikasi User
Route::post('/verifikasi', 'UserController@verifikasi')->name('verifikasi.user');

//Proses Konfirmasi Pembayaran
Route::post('/confirm', 'UserController@confirm')->name('confirm.bayar');

//dynamic select form
Route::get('/json-regencies','UserController@regencies');
Route::get('/json-districts', 'UserController@districts');


//edit password
Route::get('/editpassword/{id}/user', 'UserController@editpassword')->name('edit');
Route::put('/editpassword/{id}', 'UserController@editpassword1')->name('password');
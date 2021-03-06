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
Route::get('/petunjuk', function () {
    return view('petunjuk');
});

Route::resource('user', 'UserController');
Route::resource('package', 'PackageController');
Route::resource('cart', 'CartController');
Route::resource('transaction', 'TransactionController');
Route::resource('setting', 'SettingController');
Route::resource('message', 'MessageController');
Route::resource('review', 'ReviewController');

Route::get('/verifieduser', 'UserController@verifieduser')->name('verifieduser');
Route::get('/unverifieduser', 'UserController@unverifieduser')->name('unverifieduser');
Route::get('/rejecteduser', 'UserController@rejecteduser')->name('rejecteduser');

Route::get('/mypackage', 'PackageController@myindex')->name('myindex');
Route::post('/search', 'PackageController@search')->name('search');

Route::get('/confirmindex', 'TransactionController@confirm')->name('confirm');
Route::get('/pdf/{id}', 'TransactionController@pdf');
Route::put('/transaction/{id}/cancelinvoice', 'TransactionController@cancelinvoice')->name('transaction.cancel');
Route::put('/transaction/{id}/bayardp', 'TransactionController@bayardp')->name('bayar.dp');
Route::put('/transaction/{id}/canceldp', 'TransactionController@canceldp')->name('cancel.dp');
Route::put('/transaction/{id}/tolakdp', 'TransactionController@tolakdp')->name('tolak.dp');
Route::put('/transaction/{id}/confirmdp', 'TransactionController@confirmdp')->name('confirm.dp');
Route::put('/transaction/{id}/bayarlunas', 'TransactionController@bayarlunas')->name('bayar.lunas');
Route::put('/transaction/{id}/cancellunas', 'TransactionController@cancellunas')->name('cancel.lunas');
Route::put('/transaction/{id}/tolaklunas', 'TransactionController@tolaklunas')->name('tolak.lunas');
Route::put('/transaction/{id}/confirmlunas', 'TransactionController@confirmlunas')->name('confirm.lunas');

Route::get('/pesananpending', 'CartController@pending')->name('pesananpending');
Route::get('/pesanandone', 'CartController@done')->name('pesanandone');
Route::get('/upcoming', 'CartController@upcoming')->name('upcoming');
Route::put('/cart/{id}/cancel', 'CartController@cancel')->name('cart.cancel');
Route::put('/cart/{id}/deal', 'CartController@deal')->name('cart.deal');
Route::put('/cart/{id}/done', 'CartController@eventdone')->name('cart.done');


Route::put('/review/{id}/response', 'ReviewController@response')->name('review.response');

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

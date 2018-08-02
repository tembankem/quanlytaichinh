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
Route::get('user/activation/{token}','Auth\RegisterController@activateUser')->name('user.activate');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/information','User\UserController@showFormInformation')->name('user.information');
Route::post('/information','User\UserController@changeInformation')->name('user.changeInformation');

Route::get('password','User\UserController@showFormChangePassword')->name('user.password');
Route::post('password','User\UserController@changePassword')->name('user.changePassword');

Route::get('wallet','WalletController@index')->name('wallet.index');

Route::get('wallet/add','WalletController@showFormAdd')->name('wallet.showAdd');
Route::post('wallet/add','WalletController@add')->name('wallet.add');

Route::get('wallet/edit/{id}','WalletController@showFormEdit')->name('wallet.showEdit');
Route::put('wallet/update/{wallet}','WalletController@edit')->name('wallet.edit');
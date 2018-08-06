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

Route::get('wallet/transfer','WalletController@showFormTransfer')->name('wallet.showTransfer');
Route::post('wallet/transfer','WalletController@transfer')->name('wallet.transfer');

Route::get('category/spend','CategoryController@showSpendIndex')->name('category.spendIndex');
Route::get('category/receive','CategoryController@showReceiveIndex')->name('category.receiveIndex');

Route::get('category/spend/add','CategoryController@showAddSpendForm')->name('category.showAddSpend');
Route::post('category/spend/add','CategoryController@addSpend')->name('category.addSpend');

Route::get('category/receive/add','CategoryController@showAddReceiveForm')->name('category.showAddReceive');
Route::post('category/receive/add','CategoryController@addReceive')->name('category.addReceive');

Route::get('category/spend/{id}','CategoryController@showEditSpendForm')->name('category.showEditSpend');
Route::get('category/receive/{id}','CategoryController@showEditReceiveForm')->name('category.showEditReceive');
Route::put('category/update/{category}','CategoryController@edit')->name('category.edit');
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

// User
// Register
Route::get('/', function () {
    return view('home');
})->middleware('auth');
Route::get('user/activation/{token}','Auth\RegisterController@activateUser')->name('user.activate');
Auth::routes();

//Home and logout
Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//change information
Route::get('/information','User\UserController@showFormInformation')->name('user.information');
Route::post('/information','User\UserController@changeInformation')->name('user.changeInformation');
//change password
Route::get('password','User\UserController@showFormChangePassword')->name('user.password');
Route::post('password','User\UserController@changePassword')->name('user.changePassword');

//Wallet
//show wallet
Route::get('wallet','WalletController@index')->name('wallet.index');
//add wallet
Route::get('wallet/add','WalletController@showFormAdd')->name('wallet.showAdd');
Route::post('wallet/add','WalletController@add')->name('wallet.add');
//edit wallet
Route::get('wallet/edit/{id}','WalletController@showFormEdit')->name('wallet.showEdit');
Route::put('wallet/update/{wallet}','WalletController@edit')->name('wallet.edit');
//delete wallet
Route::get('wallet/delete/{id}','WalletController@deleteWallet')->name('wallet.deleteWallet');

//transfer money between wallet
Route::get('wallet/transfer','WalletController@showFormTransfer')->name('wallet.showTransfer');
Route::post('wallet/transfer','WalletController@transfer')->name('wallet.transfer');
//edit transfer
Route::get('wallet/transfer/edit/{id}','WalletController@showEditTransferForm')->name('wallet.showEditTransfer');
Route::post('wallet/transfer/edit/{id}','WalletController@editTransfer')->name('wallet.editTransfer');
//delete transfer
Route::get('wallet/transfer/delete/{id}','WalletController@deleteTransfer')->name('wallet.deleteTransfer');

// Categories
//show categories
Route::get('category/spend','CategoryController@showSpendIndex')->name('category.spendIndex');
Route::get('category/receive','CategoryController@showReceiveIndex')->name('category.receiveIndex');
Route::get('category/spend/add','CategoryController@showAddSpendForm')->name('category.showAddSpend');
Route::post('category/spend/add','CategoryController@addSpend')->name('category.addSpend');
//add categories
Route::get('category/receive/add','CategoryController@showAddReceiveForm')->name('category.showAddReceive');
Route::post('category/receive/add','CategoryController@addReceive')->name('category.addReceive');
//edit categories
Route::get('category/spend/{id}','CategoryController@showEditSpendForm')->name('category.showEditSpend');
Route::get('category/receive/{id}','CategoryController@showEditReceiveForm')->name('category.showEditReceive');
Route::put('category/update/{category}','CategoryController@edit')->name('category.edit');
//delete category
Route::get('category/delete/{id}','CategoryController@delete')->name('category.delete');

// Transactions
//show transactions
Route::get('transaction/index','TransactionController@index')->name('transaction.index');
//add transaction
Route::get('transaction/spend/add','TransactionController@showAddSpendForm')->name('transaction.showAddSpend');
Route::post('transaction/spend/add','TransactionController@addSpend')->name('transaction.addSpend');
Route::get('transaction/receive/add','TransactionController@showAddReceiveForm')->name('transaction.showAddReceive');
Route::post('transaction/receive/add','TransactionController@addReceive')->name('transaction.addReceive');
//edit transaction
Route::get('transaction/spend/edit/{id}','TransactionController@showEditSpendForm')->name('transaction.showEditSpend');
Route::put('transaction/spend/edit/{transaction}','TransactionController@editSpend')->name('transaction.editSpend');
Route::get('transaction/receive/edit/{id}','TransactionController@showEditReceiveForm')->name('transaction.showEditReceive');
Route::put('transaction/receive/edit/{transaction}','TransactionController@editReceive')->name('transaction.editReceive');
//delete transaction
Route::get('transaction/spend/delete/{id}','TransactionController@deleteSpend')->name('transaction.deleteSpend');
Route::get('transaction/receive/delete/{id}','TransactionController@deleteReceive')->name('transaction.deleteReceive');
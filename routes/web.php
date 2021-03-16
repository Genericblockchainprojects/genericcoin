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
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//Startup Registeration
Route::get('signup',['as' => 'admin.signup','uses' => 'AdminLoginController@adminSignup']);
//Route::get('admin', 'AdminLoginController@getAdminLogin');
Route::get('/','AdminLoginController@getAdminLogin')->name('admin-login');
Route::get('/login','AdminLoginController@getAdminLogin')->name('admin-login');
Route::post('admin-auth', ['as'=>'admin.auth','uses'=>'AdminLoginController@adminAuth']);
Route::post('/logout', 'AdminLoginController@getAdminLogout')->name('admin.logout');

Route::get('dashboard', ['as'=>'admin.dashboard','uses'=>'Admin\AdminController@index']);
Route::get('balance', ['as'=>'admin.balance','uses'=>'Admin\AdminController@balance']);
Route::get('send', ['as'=>'admin.send','uses'=>'Admin\AdminController@send']);
Route::get('/check-user-balance','Admin\AdminController@checkBalance')->name('check-user-balance');
Route::post('/send-user-token','Admin\AdminController@sendToken')->name('send-user-token');
Route::get('change-password',['as' => 'change_password','uses' => 'Admin\AdminController@changePassword']);
Route::post('update-password',['as' => 'update_password','uses' => 'Admin\AdminController@updatePassword']);
Route::get('change-email',['as' => 'change_email','uses' => 'Admin\AdminController@changeEmail']);
Route::post('update-email',['as' => 'update_email','uses' => 'Admin\AdminController@updateEmail']);
//Route::get('send', ['as'=>'admin.send','uses'=>'Admin\AdminController@']);

//Route::get('wallet', ['as'=>'admin.wallet','uses'=>'Admin\WalletController@index']);
//Route::get('send', ['as'=>'admin.send','uses'=>'Admin\WalletController@send']);
//Route::get('receive', ['as'=>'admin.receive','uses'=>'Admin\WalletController@receive']);
 // Route::get('profile', ['as'=>'admin.profile','uses'=>'Admin\ProfileController@index']);
//Route::get('block', ['as'=>'admin.block','uses'=>'Admin\BlockController@index']);
//Route::get('blockdetail', ['as'=>'admin.blockdetail','uses'=>'Admin\BlockController@blockDetail']);
//Route::get('mine', ['as'=>'admin.mine','uses'=>'Admin\MineController@index']);


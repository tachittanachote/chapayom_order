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

Route::get('/', 'HomeController@index')->name('page.home');

Route::post('/confirm', 'ConfirmController@post')->name('post.confirm');
Route::get('/confirm', 'ConfirmController@get')->name('get.confirm');

Route::get('/customer', 'CustomerController@get')->name('get.customer');
Route::post('/customer', 'CustomerController@post')->name('post.customer');

Route::get('/customer/save', 'CustomerController@disable')->name('get.save.customer');
Route::post('/customer/save', 'CustomerController@save')->name('post.save.customer');

Route::get('/customer/get', 'CustomerController@get_customer')->name('get.customer');

Route::get('/profile', 'ProfileController@index')->name('page.profile');
Route::get('/profile/login', 'ProfileController@disable')->name('get.login.profile');
Route::get('/profile/edit', 'ProfileController@disable')->name('get.edit.profile');

Route::post('/profile/login', 'ProfileController@login')->name('post.login.profile');
Route::post('/profile/edit', 'ProfileController@edit')->name('posหt.edit.profile');

Route::get('/pay-qr', 'PaymentController@index');
Route::post('/pay-qr/invoice', 'PaymentController@invoice');
Route::get('/pay-qr/invoice', 'PaymentController@index');

Route::get('/redetail', 'ConfirmController@spreadsheetById');

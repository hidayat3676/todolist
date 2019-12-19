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

Route::group(['middleware' => ['auth', 'role:user']], function (){

    Route::get('partial-view', 'TransactionController@loadMorePartialView');
    Route::resource('transactions', 'TransactionController');
});

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function (){


    Route::get('transactions', 'TransactionController@adminIndex');
    Route::get('edit-transaction/{id}','TransactionController@adminEdit');
    Route::put('update-transaction/{id}', 'TransactionController@adminUpdate');
});
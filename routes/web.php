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

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('todolist', [TodoListController::class, 'index']);
Route::get('todolist/create', [TodoListController::class, 'create']);
Route::post('todolist/store', [TodoListController::class, 'store']);
Route::get('todolist/delete/{todoList}', [TodoListController::class, 'destroy']);

<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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



Route::group(['middleware' => 'state'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource("users", UsersController::class);
    Route::get("/users/updateState/{state}/{id}", [UsersController::class, 'updateState']);
});

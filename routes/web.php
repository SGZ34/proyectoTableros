<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TablerosController;

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



Route::group(['middleware' => ['state', 'auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Users
    Route::resource("users", UsersController::class);
    Route::get("/users/editPassword/{id}", [UsersController::class, 'editPassword']);
    Route::post("/users/updatePassword/{id}", [UsersController::class, 'updatePassword']);
    Route::get("/users/updateState/{state}/{id}", [UsersController::class, 'updateState']);

    // Roles
    Route::resource("roles", RolesController::class);
    Route::get("/roles/updateState/{state}/{id}", [RolesController::class, 'updateState']);

    // Tableros
    Route::resource("tableros", TablerosController::class);
    Route::get("/tableros/updateState/{state}/{id}", [TablerosController::class, 'updateState']);
    Route::get("/tableros/download/{id}", [DashboardController::class, 'download']);

    //dashboard
    Route::get("/dashboard", [DashboardController::class, 'index']);
});

<?php

use Illuminate\Support\Facades\Route;

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
})->middleware('auth');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticating']);
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'registerProcess']);
});

Route::group(['middleware' => ['auth', 'onlyActiveUser']], function () {
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->middleware('onlyAdmin');
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->middleware('onlyClient');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home']);
});




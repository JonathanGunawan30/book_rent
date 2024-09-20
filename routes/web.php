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

Route::get('/', [App\Http\Controllers\PublicController::class, 'index'])->name('books.index');
Route::get('/books/search/alskdjfasdoew/ldaskkf', [App\Http\Controllers\PublicController::class, 'search'])->name('books.search');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticating']);
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'registerProcess']);
});

Route::group(['middleware' => ['auth', 'onlyActiveUser']], function () {
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->middleware('onlyClient');

    Route::group(['middleware' => ['onlyAdmin']], function () {
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard']);

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'home']);
        Route::get('/book/add', [App\Http\Controllers\HomeController::class, 'add']);
        Route::post('/book/add', [App\Http\Controllers\HomeController::class, 'addBook']);
        Route::get('/book/edit/{slug}', [App\Http\Controllers\HomeController::class, 'editBook']);
        Route::put('/book/update/{slug}', [App\Http\Controllers\HomeController::class, 'updateBook']);
        Route::get('/book/delete/{slug}', [App\Http\Controllers\HomeController::class, 'deleteBook']);
        Route::get('/book/deleted', [App\Http\Controllers\HomeController::class, 'deletedBook']);
        Route::get('/book/restore/{slug}', [App\Http\Controllers\HomeController::class, 'restoreBook']);


        Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'categories']);
        Route::get('/category/add', [App\Http\Controllers\CategoryController::class, 'add']);
        Route::post('/category/add', [App\Http\Controllers\CategoryController::class, 'addProcess']);
        Route::get('/category/edit/{slug}', [App\Http\Controllers\CategoryController::class, 'edit']);
        Route::put('/category/edit/{slug}', [App\Http\Controllers\CategoryController::class, 'update']);
        Route::get('/category/delete/{slug}', [App\Http\Controllers\CategoryController::class, 'delete']);
        Route::get('/category/deleted', [App\Http\Controllers\CategoryController::class, 'deleted']);
        Route::get('/category/restore/{slug}', [App\Http\Controllers\CategoryController::class, 'restore']);

        Route::get('/users', [App\Http\Controllers\UserController::class, 'users']);
        Route::get('/users/registered', [App\Http\Controllers\UserController::class, 'userRegistered']);
        Route::get('/users/detail/{slug}', [App\Http\Controllers\UserController::class, 'userDetail']);
        Route::get('/users/{slug}/approve', [App\Http\Controllers\UserController::class, 'userApprove']);
        Route::get('/users/{slug}/deactivate', [App\Http\Controllers\UserController::class, 'userDeactivate']);
        Route::get('/users/{slug}/delete', [App\Http\Controllers\UserController::class, 'userDelete']);
        Route::get('/users/deleted', [App\Http\Controllers\UserController::class, 'userDeleted']);
        Route::get('/users/{slug}/restore', [App\Http\Controllers\UserController::class, 'userRestore']);

        Route::get('/rent-logs', [App\Http\Controllers\RentLogController::class, 'rentLogs']);
    });


});




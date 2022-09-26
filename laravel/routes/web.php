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



Auth::routes();

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/tweet/create', [App\Http\Controllers\HomeController::class, 'create'])->name('tweet.create');
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::post('/user/{user}/follow', [App\Http\Controllers\UserController::class, 'follow'])->name('follow');
Route::delete('/user/{user}/unfollow', [App\Http\Controllers\UserController::class, 'unfollow'])->name('unfollow');
Route::get('/user/{user}/edit', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
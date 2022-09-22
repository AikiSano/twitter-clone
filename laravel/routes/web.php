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
Route::get('/tweet/create', [App\Http\Controllers\TweetController::class, 'create'])->name('tweet.create');
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');

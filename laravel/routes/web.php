<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FavoritesController;

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
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::post('/user/{id}/follow', [App\Http\Controllers\UserController::class, 'follow'])->name('follow');
Route::delete('/user/{id}/unfollow', [App\Http\Controllers\UserController::class, 'unfollow'])->name('unfollow');
Route::get('/user/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::PUT('/user/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');


// Route::delete('/favorites/destroy', [App\Http\Controllers\FavoritesController::class, 'destroy'])->name('favorites.destroy');
Route::resource('tweets', TweetController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
Route::resource('favorites', FavoritesController::class)->only(['store', 'destroy']);

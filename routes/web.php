<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// Listings
Route::get('/', [ListingController::class, 'index']);
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
Route::post('/listings/store', [ListingController::class, 'store'])->middleware('auth');
Route::get('/{listing}', [ListingController::class, 'show'])->middleware('auth');

// Users
Route::get('/users/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users/store', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/users/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/auth', [UserController::class, 'auth']);
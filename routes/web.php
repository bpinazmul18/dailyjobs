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
Route::get('/listings/create', [ListingController::class, 'create']);
Route::post('/listings/store', [ListingController::class, 'store']);
Route::get('/{listing}', [ListingController::class, 'show']);

// Users
Route::get('/users/register', [UserController::class, 'create']);
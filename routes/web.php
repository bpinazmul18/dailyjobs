<?php

use App\Models\Listing;
use Illuminate\Http\Request;
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

// all listing
Route::get('/', function () {
    return view('listings', [
        'heading' => 'Latest Listings',
        'listings' => Listing::all()
    ]);
});

// single listing
Route::get('/listing/{listing}', function (Listing $listing) {
    return view('listing', [
        'listing' => $listing
    ]);
});

Route::get('/hello', function () {
    return 'Hello world';
});

Route::get('/posts/{id}', function ($id) {
    ddd($id);
    return response('Posts' . $id);
})->where('id', '[0-9]+');

Route::get('/search', function (Request $request) {
    //dd($request->name . ' ' . $request->city);
    // dd($request);
    return ($request->name . ' ' . $request->city);
 });
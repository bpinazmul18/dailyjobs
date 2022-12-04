<?php

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

Route::get('/', function () {
    return view('welcome');
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
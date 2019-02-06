<?php

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

// Route::get('/', function () {
//     return view('retrieve');
// });


Route::get('/', 'VaultController@index')->name('home');

Route::get('/store', function () {
    return view('store');
});

Route::post('/store', 'VaultController@store');

Route::get('/show/{secret}', 'VaultController@show');

Route::get('/destroy', function () {return view('destroy');});
Route::post('/destroy', 'VaultController@destroy');
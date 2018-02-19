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

Route::get('/', function () {
    return view('parser');
});

Route::post('/save', 'adscontroller@save');

Route::post('/parser', 'adscontroller@parser');
Route::get('/reprice', 'adscontroller@reprice');
Route::resource('ads', 'adscontroller');
Route::get('/reprice2','adscontroller@reprice2');
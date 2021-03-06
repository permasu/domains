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
    return view('layouts/main');
});
Route::get('/page', function () {
    return view('welcome');
});


Route::get('/categories/{category_name}',[

    'uses'=>'CategoriesController@categoryAction'
]


);
Route::get('/goods/{id}',[

    'uses'=>'GoodsController@showAction'
]
);
Route::get('/order/{id}',[
'uses'=>'ordersController@buyAction'

]
);
Route::post('/order_final',
    ['uses'=>'OrdersController@finishAction']);




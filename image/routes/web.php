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
    return view('welcome');
});

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('/product', 'ProductController@index')->name('product_index');
    Route::post('/product/uploadimage', 'ProductController@uploadimage')->name('product_uploadimage');
    Route::get('/product/delete_image/{id}', 'ProductController@delete_image')->name('product_delete_image');
    Route::post('/product/edit_image', 'ProductController@edit_image')->name('product_editimage');
    Route::get('/product/create', 'ProductController@create')->name('product_create');
    Route::post('/product/store', 'ProductController@store')->name('product_store');
    Route::get('/product/edit/{id}', 'ProductController@edit')->name('product_edit');
    Route::put('/product/update/{id}', 'ProductController@update')->name('product_update');
    Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('product_delete');
});

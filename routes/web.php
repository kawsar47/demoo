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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add/product/view', 'ProductController@addproductview');
Route::post('/add/product/insert', 'ProductController@addproductinsert');
Route::get('/edit/product/{product_id}', 'ProductController@editproduct');
Route::post('/edit/product/insert', 'ProductController@editproductinsert');
Route::get('/delete/product/{product_id}', 'ProductController@deleteproduct');
Route::get('/restor/product/{product_id}', 'ProductController@restorproduct');
Route::get('/force/delete/product/{product_id}', 'ProductController@restorproduct');


//frontend

Route::get('/', 'FrontendController@index');
Route::get('about', 'FrontendController@about');
Route::get('/contact', 'FrontendController@contact');
Route::get('/product/details/{product_id}', 'FrontendController@productdetails');



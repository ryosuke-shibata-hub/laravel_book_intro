<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', function () {
//     return view('Books.books');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::get('/', 'Book\BookController@index')->name('home');
    Route::post('/Books', 'Book\BookController@store')->name('book_post');

    Route::get('/Books/edit/{book}','Book\BookController@edit')->name('book_edit');
    Route::post('/Books/update','Book\BookController@update')->name('book_update');

    Route::delete('/Books/{book}','Book\BookController@destroy')->name('book_delete');
});
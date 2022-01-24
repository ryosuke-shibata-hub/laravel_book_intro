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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('Books.books');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/', 'Book\BookController@book')->name('book');
Route::post('/books', 'Book\BookController@post')->name('book_post');

Route::delete('/book/{book}','Book\BookController@delete')->name('book_delete');
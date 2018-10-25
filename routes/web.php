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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/authors', 'HomeController@authors')->name('authors');
Route::post('/authors', 'HomeController@addAuthor');

/**
 * @todo add parameter constraint where('id', '[0-9]+')
 */
Route::get('/authors/delete/{id}', 'HomeController@deleteAuthor');

Route::get('/books', 'HomeController@books')->name('books');
Route::post('/books', 'HomeController@addBook');

/**
 * @todo add parameter constraint where('id', '[0-9]+')
 */
Route::get('/books/delete/{id}', 'HomeController@deleteBook');

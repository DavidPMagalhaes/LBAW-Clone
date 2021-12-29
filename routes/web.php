<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;


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
// Home
Route::get('/', 'Auth\LoginController@home');
Route::get('/home', 'HomeController@show');

// Individual Profile
Route::get('user/{id}', 'UserController@show');
Route::get('user/{id}/edit', 'UserController@edit');
//Route::post('user/{id}/edit', 'UserController@update');


// Books
Route::get('api/books/viewBook/{id}', 'BookProductController@show');

// Cart
Route::put('api/books/viewBook/{id}/CartController.php', 'CartController@store');
Route::get('users/{id}/cart', 'CartController@index');
//Route::post('users/{id}/cart/add', 'CartController@store');
//Route::post('users/{id}/cart/remove', 'CartController@show');
//Route::post('users/{id}/cart/update', 'CartController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Static Pages
Route::get('about', 'AboutUsController@show');
Route::get('contact', 'ContactController@show');
Route::get('faq', 'FAQController@show');
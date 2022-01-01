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

// Search
//aquele id n esta a fazer nada, dps é para tirar
Route::get('search/{id}', 'SearchBarController@show');
Route::get('category/{key}', 'CategoryController@show');



// Individual Profile
Route::get('user/{id}', 'UserController@show');
Route::get('user/{id}/edit', 'UserController@edit');
Route::put('user/{id}/edit/update', 'UserController@update');
//Route::post('user/{id}/edit', 'UserController@update');
Route::get('user/{id}/purchase-history', 'PurchaseHistoryController@index');

// Books
Route::get('api/books/viewBook/{id}', 'BookProductController@show');

// Review
Route::get('api/books/viewBook/{id}/reviews', 'ReviewController@show');

// Cart
Route::put('api/books/viewBook/{id}/CartController.php', 'CartController@store');
Route::delete('users/{id}/cart/{bookid}/delete', 'CartController@destroy');
Route::get('users/{id}/cart', 'CartController@index');
//Route::post('users/{id}/cart/add', 'CartController@store');
//Route::post('users/{id}/cart/remove', 'CartController@show');
//Route::post('users/{id}/cart/update', 'CartController@show');

// Wishlist
Route::put('api/books/viewBook/{id}/WishlistController.php', 'WishlistController@store');
Route::delete('users/{id}/wishlist/{bookid}/delete', 'WishlistController@destroy');
Route::get('users/{id}/wishlist', 'WishlistController@index');

// Checkout
Route::get('/users/{id}/cart/checkout', 'OrderInformationController@checkout');
Route::put('/users/{id}/cart/checkout/confirmed', 'OrderInformationController@confirmedCheckout');

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
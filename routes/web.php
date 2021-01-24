<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;

use Illuminate\Support\Facades\Route;

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

// Route::get('/',HomeController::class,'index')->name('home');
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

//Payment
//Route::post('/payment', ['as' => 'payment', 'uses' => 'PaymentController@payWithpaypal']);
Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/payment', [PaymentController::class, 'payWithpaypal'])->name('payment');
Route::get('/payment/status',[PaymentController::class, 'getPaymentStatus'])->name('status');
Route::get('/payment/pdf', [PaymentController::class, 'createPDF'])->name('genPDF');



// Authentication Routes...
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::get('/product/{id}', [ProductController::class, 'show'])->name('showProduct');
Route::get('/shop/{idCategory?}', [CategoryController::class, 'index'])->name('shop');

Route::get('/cart', [OrderController::class, 'index'])->name('cart');
Route::get('/add-to-cart/{id}', [OrderController::class, 'addToOrder'])->name('addCart');
Route::post('/update-cart', [OrderController::class, 'updateOrder'])->name('updateCart');
Route::get('/remove-cart/{id}', [OrderController::class, 'removeOrder'])->name('removeCart');




// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/testatos', [HomeController::class, 'testatos'])->name('testatos');

Route::get('/profil', [HomeController::class, 'index'])->name('profil');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

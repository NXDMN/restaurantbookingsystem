<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;

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

Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::post('/login/admin', [LoginController::class,'adminLogin']);

Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);
Route::post('/register/admin', [RegisterController::class,'createAdmin']);
Route::post('/register', [RegisterController::class,'createCustomer']);

Route::group(['middleware' => ['auth', 'role:customer']], function () {
    Route::view('/customer', 'customer');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::view('/admin', 'admin');
});

Route::get('logout', [LoginController::class,'logout']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/bookings/create', [BookingController::class, 'create']);
Route::get('/bookings/edit', [BookingController::class, 'edit']);
Route::get('/bookings/delete', [BookingController::class, 'delete']);
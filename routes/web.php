<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingtableController;

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
    Route::get('/bookings/show', [BookingController::class, 'show']);
    Route::view('/bookings/create', 'booking.create');
    Route::get('/bookings/edit/{id}', [BookingController::class, 'showEdit']);
});

Route::post('/bookings/create', [BookingController::class, 'create'])->middleware('can:isCustomer');
Route::post('/bookings/edit', [BookingController::class, 'edit'])->middleware('can:isCustomer');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->middleware('can:isCustomer');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::view('/admin', 'admin');
    Route::get('/bookings/index', [BookingController::class, 'index']);
    Route::get('/bookingtables/index', [BookingtableController::class, 'index']);
    Route::get('/bookingtables/create/{id}', function($id){
        return view('bookingtable.create', ['booking_id' => $id]);
    });
    Route::get('/bookingtables/edit/{id}', [BookingtableController::class, 'showEdit']);

});

Route::put('/bookings/updateStatus/{id}', [BookingController::class, 'updateStatus'])->middleware('can:isAdmin');
Route::post('/bookingtables/create', [BookingtableController::class, 'create'])->middleware('can:isAdmin');
Route::post('/bookingtables/edit', [BookingtableController::class, 'edit'])->middleware('can:isAdmin');
Route::delete('/bookingtables/{bookingtable}', [BookingtableController::class, 'destroy'])->middleware('can:isAdmin');

Route::get('logout', [LoginController::class,'logout']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// login logout routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Auth Customer
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    // field
    Route::get('/field-list', [FieldController::class, 'list'])->name('field.list');

    // booking
    Route::get('/bookings/create/{field}', [BookingController::class, 'createBooking'])->name('user.bookings.create');
    Route::post('/bookings/store/{field}', [BookingController::class, 'storeBooking'])->name('user.booking.store');
    Route::get('/bookings/check/{field}', [BookingController::class, 'check'])->name('user.bookings.check');
    Route::get('/booking-history', [BookingController::class, 'bookingHistory'])->name('user.bookings.history');

    // payment
    Route::get('/payment/{booking}', [PaymentController::class, 'customer_payment'])->name('user.booking.payment');
    Route::post('/payment/{booking}', [PaymentController::class, 'customer_paymentStore'])
        ->name('user.payments.store');
});

// Admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('fields', FieldController::class);
    Route::resource('bookings', BookingController::class);

    // payment confirmation
    Route::get('/payments/confirmation', [PaymentController::class, 'admin_confirmation'])->name('admin.payments.confirmation');
    Route::post('/payments/{payment}/approve', [PaymentController::class, 'approve'])->name('admin.payments.approve');
    Route::post('/payments/{payment}/reject', [PaymentController::class, 'reject'])->name('admin.payments.reject');
});

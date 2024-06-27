<?php

use App\Http\Controllers\GoCardlessWebhookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GoCardlessController;


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

Route::get('/', function () {
    return view('welcome');
});



// Route::get('/payment', 'PaymentController@showPaymentForm')->name('payment.form');
// Route::post('/process-payment', 'PaymentController@processPayment')->name('process.payment');

Route::get('payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');



Route::get('/payment/success', function () {
    return view('payment-success');
})->name('payment.success');

Route::get('/payment/failure', function () {
    return view('payment-failure');
})->name('payment.failure');












Route::get('/customer/create', function () {
    return view('customer.create');
});

Route::post('/gocardless/customer', [GoCardlessController::class, 'createCustomer']);

Route::get('/payment/create', function () {
    return view('payment.create');
});

Route::post('/gocardless/payment', [GoCardlessController::class, 'createPayment']);

Route::post('/gocardless/mandate', [GoCardlessController::class, 'createMandate']);
Route::get('/gocardless/mandate-success', [GoCardlessController::class, 'mandateSuccess']);

Route::post('/gocardless/webhook', [GoCardlessWebhookController::class, 'handle']);


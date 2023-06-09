<?php

use App\Http\Controllers\PaymentLinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Livewire\Payment;
use App\Http\Livewire\PaymentView;
use App\Http\Livewire\ShowPaymentLink;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('/payment')->group(function(){
    Route::get('/create_payment_link', Payment::class);
    Route::get('/payment_view', PaymentView::class)->name('payment.payment_view');
    Route::get('/show_payment_link', ShowPaymentLink::class)->name('payment.show_payment_link');
    Route::post('/store', [PaymentLinkController::class, 'store'])->name('payment.store');
    Route::post('/paynow', [PaymentLinkController::class, 'paynow'])->name('payment.paynow');
    Route::post('/payment_store', [PaymentLinkController::class, 'payment_store'])->name('payment.payment_store');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controller\TicketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'getHomePage']);

Route::get('/home', [HomeController::class, 'getHomePage'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(EventController::class)->group(function () {
    Route::get('/events', 'getAllEventPage')->name('event.get');
    Route::get('/events/{eventType}', 'getEventsByTypePage')->name('event.get.by-type');
    Route::get('/events/{eventType}/{eventSlug}', 'getEventDetailPage')->name('event.detail');
    Route::post('/events/{eventType}/{eventSlug}/checkout', 'getTicketCheckoutPage')->name('ticket.checkout');
    Route::post('/events', 'store');
});

Route::controller(TicketController::class)->group(function () {
    Route::get('/tickets', 'getTicketByEvent')->name('ticket.get');
});

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
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

Route::get('/', [HomeController::class, 'getHomePage'])->name('main-page');

Route::controller(AdminDashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->middleware(['auth', 'verified', 'admin'])->name('admin.home');
    Route::get('/dashboard/events/{eventType}/{eventSlug}', 'getDetailSubmittedEvent')->middleware(['auth', 'verified', 'admin'])->name('admin.event.detail');
    Route::put('/dashboard/events/{eventId}', 'approveAndPublishEvent')->middleware(['auth', 'verified', 'admin'])->name('admin.approve-and-publish-event');
    Route::put('/dashboard/events/cancel/{eventId}', 'rejectSubmittedEvent')->middleware(['auth', 'verified', 'admin'])->name('admin.reject-submitted-event');
});

Route::get('/home', [HomeController::class, 'getHomePage'])->name('home');

Route::controller(UserDashboardController::class)->group(function () {
    Route::get('/dashboard/{userId}', 'getUserDashboard')->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/dashboard/{userSlug}/events/{eventType}/{eventSlug}', 'getDetailSubmittedEvent')->middleware(['auth', 'verified'])->name('user.event.detail');
    Route::get('/dashboard/{userSlug}/events/update/{eventType}/{eventSlug}', 'getUpdatedSubmittedEventPage')->middleware(['auth', 'verified'])->name('user.event.detail.update');
    Route::put('/dashboard/events/{eventId}', 'updateSubmittedEvent')->middleware(['auth', 'verified'])->name('user.event.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(EventController::class)->group(function () {
    Route::get('/events', 'getAllEventPage')->name('event.get');
    Route::post('/events/checkout/{orderId}', 'handleCheckout')->name('ticket.checkout-handle')->middleware(['auth', 'verified']);
    Route::get('/events/checkout/success', 'handleSuccessTransaction')->name('event.ticket.checkout-success');
    Route::get('/events/create/basic', 'getCreateBasicEventPage')->middleware(['auth', 'verified'])->name('event.create.form-basic');
    Route::get('/events/create', 'createEvent')->name('event.create');
    Route::post('/events/create/ticket', 'getCreateTicketPage')->name('event.create.ticket');
    Route::get('/events/{eventType}', 'getEventsByTypePage')->name('event.get.by-type');
    Route::get('/events/{eventType}/{eventSlug}', 'getEventDetailPage')->name('event.detail');
    Route::post('/events/{eventType}/{eventSlug}/checkout', 'getTicketCheckoutPage')->middleware(['auth', 'verified'])->name('ticket.checkout');
});

Route::controller(TicketController::class)->group(function () {
    Route::get('/tickets', 'getTicketByEvent')->name('ticket.get');
    Route::post('/tickets', 'createTicketForEvent')->name('ticket.create');
});

require __DIR__ . '/auth.php';

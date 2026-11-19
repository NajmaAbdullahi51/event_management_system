<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Ticket;
use App\Models\Payment;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'eventsCount' => Event::count(),
            'participantsCount' => Participant::count(),
            'ticketsCount' => Ticket::count(),
            'totalRevenue' => Payment::where('status', 'Paid')->sum('amount'),
            'recentEvents' => Event::latest()->take(5)->get()
        ]);
    })->name('dashboard');

    Route::resource('events', EventController::class);
    Route::resource('participants', ParticipantController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('payments', PaymentController::class);
});

require __DIR__.'/auth.php';
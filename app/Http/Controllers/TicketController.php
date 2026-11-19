<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['event', 'participant'])->latest()->get();
        $events = Event::all();
        $participants = Participant::all();
        return view('tickets.index', compact('tickets', 'events', 'participants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'participant_id' => 'required',
            'ticket_type' => 'required',
            'price' => 'required|numeric',
        ]);

        // Samee ticket code gaar ah haddii uusan model-ka si otomaatig ah u samaynayn
        $ticketCode = 'TCK-' . strtoupper(uniqid());

        Ticket::create([
            'ticket_code' => $ticketCode,
            'event_id' => $request->event_id,
            'participant_id' => $request->participant_id,
            'ticket_type' => $request->ticket_type,
            'price' => $request->price,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Tikidhka si guul leh ayaa loo soo saaray!');
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'event_id' => 'required',
            'participant_id' => 'required',
            'ticket_type' => 'required',
            'price' => 'required|numeric',
        ]);

        $ticket->update([
            'event_id' => $request->event_id,
            'participant_id' => $request->participant_id,
            'ticket_type' => $request->ticket_type,
            'price' => $request->price,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Tikidhka si guul leh ayaa loo beddelay!');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Tikidhka si guul leh ayaa loo tirtiray!');
    }
}
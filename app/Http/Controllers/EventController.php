<?php
namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller {
    public function index() {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }
    public function store(Request $request) {
        $request->validate(['title'=>'required', 'location'=>'required', 'event_date'=>'required', 'capacity'=>'required|integer']);
        Event::create($request->all());
        return redirect()->back()->with('success', 'Event-ga si guul leh ayaa loo daray!');
    }
    public function update(Request $request, Event $event) {
        $event->update($request->all());
        return redirect()->back()->with('success', 'Event-ga waa la cusboonaysiiyay!');
    }
    public function destroy(Event $event) {
        $event->delete();
        return redirect()->back()->with('success', 'Event-ga waa la tirtiray!');
    }
}
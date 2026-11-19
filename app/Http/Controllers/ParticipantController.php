<?php
namespace App\Http\Controllers;
use App\Models\Participant;
use App\Models\Event;
use Illuminate\Http\Request;

class ParticipantController extends Controller {
    public function index() {
        $participants = Participant::with('event')->latest()->get();
        $events = Event::all();
        return view('participants.index', compact('participants', 'events'));
    }
    public function store(Request $request) {
        $request->validate(['event_id'=>'required', 'full_name'=>'required', 'email'=>'required|email|unique:participants', 'phone'=>'required']);
        Participant::create($request->all());
        return redirect()->back()->with('success', 'Ka-qaybgalaha waa la diiwaangeliyay!');
    }
    public function update(Request $request, Participant $participant) {
        $participant->update($request->all());
        return redirect()->back()->with('success', 'Xogta waa la beddelay!');
    }
    public function destroy(Participant $participant) {
        $participant->delete();
        return redirect()->back()->with('success', 'Waa la tirtiray!');
    }
}
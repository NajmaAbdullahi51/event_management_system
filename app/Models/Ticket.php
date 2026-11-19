<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    protected $fillable = ['event_id', 'participant_id', 'ticket_code', 'ticket_type', 'price'];
    public function event() { return $this->belongsTo(Event::class); }
    public function participant() { return $this->belongsTo(Participant::class); }
    public function payment() { return $this->hasOne(Payment::class); }
}
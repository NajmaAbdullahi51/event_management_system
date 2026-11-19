<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $fillable = ['title', 'description', 'location', 'event_date', 'capacity', 'status'];
    public function participants() { return $this->hasMany(Participant::class); }
    public function tickets() { return $this->hasMany(Ticket::class); }
}
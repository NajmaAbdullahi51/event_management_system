<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['event_id', 'full_name', 'email', 'phone'];

    public function event() 
    { 
        return $this->belongsTo(Event::class); 
    }

    public function tickets() 
    { 
        return $this->hasMany(Ticket::class); 
    }
}
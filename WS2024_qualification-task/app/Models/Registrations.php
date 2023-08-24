<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrations extends Model
{
    use HasFactory;

        
    protected $table = 'registrations';
    public $timestamps = false;

    protected $guarded = [
        'attendee_id',
        'ticket_id'
    ];

    protected $casts = [
        'registration_time' => 'date'
    ];
}

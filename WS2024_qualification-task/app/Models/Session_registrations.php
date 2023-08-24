<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session_registrations extends Model
{
    use HasFactory;
        
    protected $table = 'session_registrations';
    public $timestamps = false;
    protected $guarded = [
        'registeration_id',
        'session_id'
    ];
}

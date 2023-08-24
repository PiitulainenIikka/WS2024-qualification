<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_tickets extends Model
{
    use HasFactory;

    protected $table = 'event_tickets';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "cost",
        'event_id',
        'special_validaty'
    ];
}

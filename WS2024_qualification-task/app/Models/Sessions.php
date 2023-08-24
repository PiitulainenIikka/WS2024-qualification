<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

enum SessionType:string {
    case Talk = 'talk';
    case Workshop = 'workshop';
}

class Sessions extends Model
{
    use HasFactory;
        
    protected $table = 'sessions';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'speaker',
        'cost',
        'room_id',
        'type',
        'start',
        'end'
    ];

    protected $guarded = [
        
    ];

    protected $casts = [
        'type' => SessionType::class,
        'start' => 'datetime',
        'end' => 'datetime'
    ];

    public function room(): HasOne
    {
        return $this->hasOne(Rooms::class);
    }
}

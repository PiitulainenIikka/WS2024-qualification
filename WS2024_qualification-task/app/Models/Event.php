<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    
    protected $table = 'events';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "slug"
    ];

    protected $guarded = [
        'organizer_id'
    ];

    protected $casts = [
        'date' => 'date'
    ];
    public function messages(): array
    {
        return [
            'slug.required' => 'Slug must not be empty and only contain a-z, 0-9 and'-'',
        ];
    }

}

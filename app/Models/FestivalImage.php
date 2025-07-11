<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FestivalImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image_url',
    ];
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}

<?php

namespace App\Models;

use App\Models\FestivalImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    //Controllerのfill用
    protected $fillable = [
        'event_title',
        'event_body',
        'start_date',
        'end_date',
        'event_color',
        'event_border_color',
    ];
}

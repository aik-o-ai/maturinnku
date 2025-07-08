<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //ホワイトリスト方式：create()やfill()で代入可能なカラム
    protected $fillable = [
        'title',
        'body',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exhibiton extends Model
{
    protected $fillable = [
        'title',
        'body',
        'year',
        'image',
        'slug',
        'user_id'
    ];
}

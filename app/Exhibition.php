<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    protected $table = 'exhibitons';
    protected $fillable = [
        'title',
        'body',
        'year',
        'image',
        'slug',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($art) {
            $art->user_id = auth()->user()->id;
        });
    }

}

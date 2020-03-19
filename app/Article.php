<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'news_source',
        'publish_date',
        'original_link',
        'news_source',
        'details',
        'user_id',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($art) {
            $art->user_id = auth()->user()->id;
        });
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    protected $fillable = [
        'name',
        'location',
        'image_1',
        'image_2',
        'image_3',
        'user_id',
        'comment',
        'art_id',
        'type',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($art) {
            $art->user_id = auth()->user()->id;
        });
    }

    public function art()
    {
        return $this->belongsTo(Art::class);
    }
}

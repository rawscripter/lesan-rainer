<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($collection) {
            $collection->user_id = auth()->user()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function arts()
    {
        return $this->belongsToMany(Art::class, 'art_collections')->orderBy('created_at', 'desc');
    }
}

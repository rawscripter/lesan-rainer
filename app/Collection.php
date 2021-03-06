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
        return $this->belongsToMany(Art::class, 'art_collections')->whereArchive(0)->orderBy('created_at', 'desc');
    }

    public function archiveArts()
    {
        return $this->belongsToMany(Art::class, 'art_collections')->whereArchive(1)->orderBy('created_at', 'desc');
    }

}

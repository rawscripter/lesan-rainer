<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($art) {
            $art->user_id = auth()->user()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function relatedImages()
    {
        return $this->belongsToMany(Image::class, 'art_images')->withPivot('id')->take(7);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'art_collections');
    }

    public function isItHasFeatureImage()
    {
        if (empty($this->image))
            return false;
        $artImg = public_path('/images/feature/' . $this->image);
        if (file_exists($artImg)) {
            return true;
        }
        return false;
    }


}

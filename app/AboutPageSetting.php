<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutPageSetting extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($req) {
            $req->user_id = auth()->user()->id;
        });
    }
}

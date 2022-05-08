<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function file()
    {
        return $this->hasMany('App\file');
    }
    public function revisions()
    {
        return $this->hasMany('App\ImageRevision');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageRevision extends Model
{
    protected $guarded = [];

    public function imageComments()
    {
        return $this->hasMany('App\ImageComment');
    }
}

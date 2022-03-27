<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageComment extends Model
{
    protected $guarded = [];
    public function imageRevision()
    {
        return $this->belongsTo('App\ImageRevision');
    }
}

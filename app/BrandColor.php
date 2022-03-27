<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandColor extends Model
{
    protected $guarded = [];
    public function brand()
    {
        return $this->belongsTo('App\brand');
    }
}

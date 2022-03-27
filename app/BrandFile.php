<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandFile extends Model
{
    protected $guarded = [];
    public function brand()
    {
        return $this->belongsTo('App\brand');
    }
}

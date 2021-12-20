<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Order()
    {
        return $this->belongsTo('App\Order');
    }
}

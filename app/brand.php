<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    public function colors(){
        return $this->hasMany('App\BrandColor');
    }
    public function files(){
        return $this->hasMany('App\BrandFile');
    }
    public function user(){
        return $this->BelongsTo('App\User');
    }
}

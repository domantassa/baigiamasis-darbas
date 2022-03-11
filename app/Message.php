<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'sender_user_id', 'receiver_user_id'];

    public function user()
    {
    return $this->belongsTo(User::class);
    }

}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    //protected $fillable = [
     //   'name', 'email', 'password',
    //];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    
    public function files()
    {
        return $this->hasMany('App\file','owner_id');
    }
    public function orders()
    {
        return $this->hasMany('App\Order','owner_id');
    }
    public function notifications()
    {
        return $this->hasMany('App\FileNotification');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function isOnline()
    {
        //return Cache::has('user-is-online-' . $this->id);
    }
}

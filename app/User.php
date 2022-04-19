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
    protected $fillable = ['name', 'email', 'password', 'position', 'avatar_image_number', 'remaining', 'plan', 'refresh_date'];
    

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
    public function brands()
    {
        return $this->hasMany('App\brand', 'user_id');
    }
    public function orders()
    {
        return $this->hasMany('App\Order','owner_id');
    }
    public function notifications()
    {
        return $this->hasMany('App\FileNotification', 'user_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message', 'receiver_user_id');
    }

    public function userNameShort($lenght = 27) {
        if(strlen($this->name) > $lenght) {
            $strr = substr($this->name, 0, $lenght-4);
            $strr .= "...";
            return $strr;
        }
        else {
            return $this->name;
        }
    }
}

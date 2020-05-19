<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'avatar', 'email', 'password',
    ];

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

    public function questions(){
        return $this->hasMany('App\questions');
    }
    public function block(){
        return $this->hasMany('App\Block');
    }

    public function fullName(){
        return $this->firstname . ' ' . $this->lastname;
    }
    public function roleNAME(){
        if($this->role == 'superadmin'){
            return 'admin';
        }elseif($this->role == 'admin'){
            return 'admin';
        }else
        {
            return 'user';
        }
    }

    public function isBlocked() {
        if (Auth::check()) {
            $man = Auth::user();
            $count = Block::where('user_id', $man->id)
                ->where('user_blocked_id', $this->id)
                ->count();
            return $count > 0;
        } else {
            return false;
        }
    }

    public function images () {
        return $this->hasMany("App\Gallery");
    }
}

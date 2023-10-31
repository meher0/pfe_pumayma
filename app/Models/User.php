<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];


    protected $fillable = [

        'name',
        'email',
        'password',
        'phone',
        'role',
    ];


    public function reunions()
    {
        return $this->belongsToMany(Reunion::class, 'invites')->withTimestamps();
    }

    public function invites()
    {
        return $this->hasMany(Invite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function procesVerbals()
    {
        return $this->hasManyThrough(ProcesVerbal::class, Invite::class, 'user_id', 'reunion_id');
    }




    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reunion extends Model
{
    use HasFactory;

    protected $guarded =[];


    public function invites(){
        return $this->hasMany(Invite::class);
    }



    public function users()
    {
        return $this->belongsToMany(User::class, 'invites')->withTimestamps();
    }
}

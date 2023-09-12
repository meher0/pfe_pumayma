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
    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'reunion_id')->withTimestamps();
    }

    public function decisions()
    {
        return $this->hasMany(Decision::class);
    }
}

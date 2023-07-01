<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = ['reunion_id', 'comment'];

    public function reunion()
    {
        return $this->belongsTo(Reunion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function procesVerbal()
    {
        return $this->belongsTo(ProcesVerbal::class);
    }
}

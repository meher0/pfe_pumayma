<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invite extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function reunion()
    {
        return $this->belongsTo(Reunion::class);
    }

    public function pv()
    {
        return $this->hasOne(ProcesVerbal::class, 'reunion_id', 'reunion_id');
    }
}

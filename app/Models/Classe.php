<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    public function Stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}

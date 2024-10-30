<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;
    protected $guarded=[];

    // Classrooms
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }



    // Materials 
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    // Stage
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    // Stage
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }


    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}

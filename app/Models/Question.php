<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    // علاقة hasMany مع نموذج Answer
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}

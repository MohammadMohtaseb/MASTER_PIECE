<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','question_id','selected_answer','is_correct'];

     // علاقة BelongsTo مع نموذج Question
     public function question()
     {
         return $this->belongsTo(Question::class, 'question_id');
     }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    use HasFactory;

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function exam_result($id)
    {

        return  ExamResult::where('student_id', $id)
            ->where('exam_id', $this->id)
            ->first();
    }

    // هو دخل الامتحان ولا لا 
    public function enter_student_exam()
    {
        $studentId = Auth::guard('student')->check() ? Auth::guard('student')->user()->id : Auth::guard('parent')->user()->student->pluck('id');
        if( Auth::guard('student')->check() )
        {
            return ExamResult::where('exam_id', $this->id)
            ->where('student_id', $studentId)
            ->exists(); // Check if there is an entry for the student
        }else{
            return ExamResult::where('exam_id', $this->id)
            ->whereIn('student_id', $studentId)
            ->exists(); // Check if there is an entry for the student
        }
     

        return false; // Return false if no student is authenticated
    }
}

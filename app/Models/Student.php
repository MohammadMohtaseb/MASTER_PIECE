<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(ParentStudent::class, 'parent_student_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function exam_results()
    {
        return $this->hasMany(ExamResult::class);
    }

    public function exam_result_single($student_id, $exam_id)
    {
        // Find the exam result for the given student ID and the given exam ID
        $result = ExamResult::where('student_id', $student_id)
            ->where('exam_id', $exam_id) // تمرير exam_id الصحيح هنا
            ->first();
    
        return $result;
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}

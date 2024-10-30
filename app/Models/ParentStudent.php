<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ParentStudent extends Authenticatable
{
    use HasFactory;
    protected $table = 'parent_students';

    public function student()
    {
        return $this->hasMany(Student::class);
    }


    // معرفة اسماء ابنائة فى الامتحان هذا ام لا
    public function get_student_name_for_exam($id,$exam_date)
    {
        return Student::where('classroom_id',$id)
        ->where('parent_student_id',Auth::guard('parent')->user()->id)
        ->where('created_at','<=',$exam_date)
        ->get();
        
    }
}

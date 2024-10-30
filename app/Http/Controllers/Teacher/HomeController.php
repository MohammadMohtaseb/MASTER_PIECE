<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // My Classrooms 
        $id_my_classrooms = Auth::guard('teacher')->user()->classrooms->pluck('id');
        
        // My Students 
        $my_students = Student::whereIn('classroom_id',$id_my_classrooms)->limit(5)->get();
        
        return view("teacher.index",compact('my_students'));
    }
}

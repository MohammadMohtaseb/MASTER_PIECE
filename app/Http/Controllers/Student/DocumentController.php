<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Filemanger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {  

        $my_documents = Filemanger::whereIn('teacher_id',Auth::guard('student')->user()->classroom->teachers->pluck('id'))->get();

        return view("student.documents.index",compact('my_documents'));
    }
}

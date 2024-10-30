<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MyStudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // My Classrooms 
            $id_my_classrooms = Auth::guard('teacher')->user()->classrooms->pluck('id');

            // My Students 
            $my_students = Student::whereIn('classroom_id', $id_my_classrooms);

            if ($request->filter) {
                $my_students->where('classroom_id', '=', $request->filter);
            }
            return DataTables::of($my_students)
                ->addIndexColumn()

                ->editColumn('name', function ($row) {
                    return $row->name;
                })
                ->editColumn('parent', function ($row) {
                    return $row->parent->name;
                })
                ->editColumn('classroom', function ($row) {
                    return $row->classroom->name;
                })

                ->make(true);
        }


        return view("teacher.my-students.index");
    }
}

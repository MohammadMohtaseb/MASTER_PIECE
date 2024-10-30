<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Reports = Report::where('teacher_id', Auth::guard('teacher')->user()->id)->get();
      
        return view("teacher.reports.index", compact('Reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("teacher.reports.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'report' => 'required',
            'classroom' => 'required',
            'student' => 'required'
        ]);

        try {
            Report::create([
                'title' => $request->title,
                'report' => $request->report,
                'student_id' => $request->student,
                'teacher_id' => Auth::guard('teacher')->user()->id,
            ]);

            toastr()->success('Data has been saved successfully!');

            return redirect()->back();

        } catch (PDOException $e) {
           toastr()->error('An error occurred!');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Report = Report::where('id', $id)->first();
        if (!$Report && $Report->teacher_id == Auth::guard('Teacher')->user()->id) {
            return redirect()->back();
        }
        return view("teacher.reports.edit", compact('Report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'report' => 'required',
            'classroom' => 'required',
            'student' => 'required'
        ]);
        try {
            Report::where('id', $id)->update([
                'title' => $request->title,
                'report' => $request->report,
                'student_id' => $request->student,
                'teacher_id' => Auth::guard('teacher')->user()->id,
            ]);
            toastr()->success('The data has been modified successfully');
            return redirect()->back();
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Report = Report::findOrFail($id);
        $Report->delete();

        return response()->json(['success' => 'Material deleted successfully.']);


      
    }


    public function getStudent($id)
    {
        $students = Student::where('classroom_id', $id)->get();
        return response()->json([
            'students' => $students,
        ]);
    }
}

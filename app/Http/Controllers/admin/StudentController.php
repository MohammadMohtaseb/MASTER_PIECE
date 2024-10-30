<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDOException;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Students = Student::all();

        return view("admin.students.index", compact('Students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.students.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:students,name',
            'email' => 'required|email',
            'password' => 'required',
            'stage' => 'required',
            'class' => 'required',
            'classroom' => 'required',
        ]);
        try {
            $Student = new Student();
            $Student->name = $request->name;
            $Student->email = $request->email;
            $Student->password = Hash::make($request->password);
            $Student->gender = $request->gender;
            $Student->classroom_id = $request->classroom;
            $Student->parent_student_id = $request->parent;
            $Student->save();
            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.students.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.students.index');
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
        $Student = Student::where('id', $id)->first();
        return view('admin.students.edit', compact('Student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:students,name,' . $id,
            'email' => 'required|email',
            'stage' => 'required',
            'class' => 'required',
            'classroom' => 'required',
        ]);

        try {

            $changed = [
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'classroom_id' => $request->classroom,
                'parent_student_id' => $request->parent,
            ];
            if ($request->password) {
                $changed['password'] = Hash::make($request->password);
            }
            Student::where('id', $id)->update($changed);
            toastr()->success('The data has been modified successfully');
            return redirect()->route('admin.students.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.students.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Student = Student::findOrFail($id);
        $Student->delete();

        return response()->json(['success' => 'Material deleted successfully.']);
    }
}

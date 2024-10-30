<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDOException;

class TeacherControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
    
       
        return view("admin.teachers.index", compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.teachers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:teachers,name',
            'email' => 'required|email',
            'password' => 'required',
            'stage' => 'required',
            'class' => 'required',
            'classroom' => 'required',
            'date' => 'required',
            'gender' => 'required'
        ]);

        try {
            $Teacher = new Teacher();
            $Teacher->name = $request->name;
            $Teacher->email = $request->email;
            $Teacher->password = Hash::make($request->password);
            $Teacher->birthdate = $request->date;
            $Teacher->gender = $request->gender;
            $Teacher->stage_id = $request->stage;
            $Teacher->classe_id = $request->class;
            $Teacher->material_id = $request->material;
            $Teacher->save();
            $Teacher->classrooms()->attach($request->classroom);
            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.teachers.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.teachers.index');
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
        $teacher = Teacher::where('id', $id)->first();
        return view("admin.teachers.edit", compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:teachers,name,' . $id,
            'email' => 'required|email',
            'stage' => 'required',
            'class' => 'required',
            'classrooms' => 'required',
            'date' => 'required',
            'gender' => 'required'
        ]);
        try {
            $changed = [
                'name' => $request->name,
                'email' => $request->email,
                'birthdate' => $request->date,
                'gender' => $request->gender,
                'stage_id' => $request->stage,
                'classe_id' => $request->class
            ];
            if ($request->password) {
                $changed['password'] = Hash::make($request->password);
            }
            // Update the teacher's main details
            $teacher = Teacher::where('id', $id)->first();
            $teacher->update($changed);

            // Sync the classrooms in the pivot table
            $teacher->classrooms()->sync($request->classrooms);
            toastr()->success('The data has been modified successfully');
            return redirect()->route('admin.teachers.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.teachers.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Stage = Teacher::findOrFail($id);
        $Stage->delete();

        return response()->json(['success' => 'Material deleted successfully.']);

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Classroom;
use Illuminate\Http\Request;
use PDOException;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();

        return view("admin.classrooms.index", compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.classrooms.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'stage' => 'required',
            'class' => 'required'
        ]);
        try {
            $Classroom = new Classroom();
            $Classroom->name = $request->name;
            $Classroom->classe_id = $request->class;
            $Classroom->save();

            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.classrooms.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.classrooms.index');
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
        $classroom = Classroom::where('id', $id)->first();
        return view("admin.classrooms.edit", compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:classrooms,name,' . $id,
            'stage' => 'required',
            'class' => 'required'
        ]);
        try {
            Classroom::where('id', $id)->update(
                [
                    'name' => $request->name,
                    'classe_id' => $request->class
                ]
            );
            toastr()->success('The data has been modified successfully');
            return redirect()->route('admin.classrooms.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.classrooms.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Classroom = Classroom::findOrFail($id);
        $Classroom->delete();

        return response()->json(['success' => 'Material deleted successfully.']);
    }


    public function getClasses($stage_id)
    {
        $classes = Classe::where('stage_id', $stage_id)->get();
        return response()->json([
            'classes' => $classes,
        ]);
    }

    public function getClassroom($class_id)
    {
        $classrooms = Classroom::where('classe_id', $class_id)->get();
        return response()->json($classrooms);
    }
}

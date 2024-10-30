<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use Illuminate\Http\Request;
use PDOException;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Classes = Classe::all();

        return view("admin.classes.index", compact('Classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.classes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:classes,name',
            'stage' => 'required'
        ]);

        try {
            $Material = new Classe();
            $Material->name = $request->name;
            $Material->stage_id = $request->stage;
            $Material->save();
            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.classes.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.classes.index');
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
        $Classe = Classe::where('id', $id)->first();
        if ($Classe) {
            return view("admin.classes.edit", compact('Classe'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:classes,name,' . $id,
            'stage' => 'required'
        ]);
        try {
            Classe::where('id', $id)->update(['name' => $request->name, 'stage_id' => $request->stage]);
            toastr()->success('The data has been modified successfully');
            return redirect()->route('admin.classes.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.classes.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Classe::findOrFail($id);
        $material->delete();

        return response()->json(['success' => 'Material deleted successfully.']);
        
   
    }
}

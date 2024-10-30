<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use PDOException;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Materials = Material::all();
        return view("admin.materials.index", compact('Materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.materials.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:materials,name'
        ]);
        try {
            $Material = new Material();
            $Material->name = $request->name;
            $Material->save();
            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.materials.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.materials.index');
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
        $Material = Material::where('id', $id)->first();
        if ($Material) {
            return view("admin.materials.edit", compact('Material'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:materials,name,' . $id
        ]);
        try {
            Material::where('id', $id)->update(['name' => $request->name]);
            toastr()->success('The data has been modified successfully');
            return redirect()->route('admin.materials.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.materials.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return response()->json(['success' => 'Material deleted successfully.']);
    }
}

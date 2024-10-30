<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\Request;
use PDOException;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Stages = Stage::all();

        return view("admin.stages.index", compact('Stages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.stages.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:stages,name'
        ]);
        try {
            $Stage = new Stage();
            $Stage->name = $request->name;
            $Stage->save();
            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.stages.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.stages.index');
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
        $Stage = Stage::where('id', $id)->first();
        if ($Stage) {
            return view("admin.stages.edit", compact('Stage'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:stages,name,' . $id
        ]);
        try {
            Stage::where('id', $id)->update(['name' => $request->name]);
            toastr()->success('The data has been modified successfully');
            return redirect()->route('admin.stages.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.stages.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Stage = Stage::findOrFail($id);
        $Stage->delete();

        return response()->json(['success' => 'Material deleted successfully.']);
    }
}

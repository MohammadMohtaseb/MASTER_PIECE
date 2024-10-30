<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ParentStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDOException;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Parents = ParentStudent::all();
        return view("admin.parents.index", compact('Parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.parents.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:parent_students,name',
            'email' => 'required|email',
            'cid' => 'required|unique:parent_students,cid',
            'password' => 'required'
        ]);
        try {
            $Parent = new ParentStudent();
            $Parent->name = $request->name;
            $Parent->email = $request->email;
            $Parent->password = Hash::make($request->password);
            $Parent->cid = $request->cid;
            $Parent->save();
            toastr()->success('Data has been saved successfully!');

            return redirect()->route('admin.parents.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.parents.index');
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
        $Parent = ParentStudent::where('id', $id)->first();
        return view("admin.parents.edit", compact('Parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:parent_students,name,' . $id,
            'email' => 'email',
            'cid' => 'required|unique:parent_students,cid,' . $id,
        ]);
        try {
            $changed = [
                'name' => $request->name,
                'email' => $request->email,
                'cid' => $request->cid,
            ];
            if ($request->password) {
                $changed['password'] = Hash::make($request->password);
            }
            ParentStudent::where('id', $id)->update($changed);
            toastr()->success('The data has been modified successfully');
            return redirect()->route('admin.parents.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->route('admin.parents.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ParentStudent = ParentStudent::findOrFail($id);
        $ParentStudent->delete();

        return response()->json(['success' => 'Material deleted successfully.']);

    }
}

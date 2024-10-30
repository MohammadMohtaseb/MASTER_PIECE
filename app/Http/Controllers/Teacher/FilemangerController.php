<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Filemanger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FilemangerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = Filemanger::where('teacher_id', Auth::guard('teacher')->user()->id)->get();
        return view("teacher.filemanger.index", compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("teacher.filemanger.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,docx|max:20480', // Only allow PDF or DOCX, max size 20MB
            'descrption' => 'nullable|string'
        ]);

        // Store the uploaded file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('files', 'public'); // Store in 'storage/app/public/files'
            $fileSize = $request->file('file')->getSize(); // احصل على حجم الملف

        }

        // Create the new record in the database
        Filemanger::create([
            'teacher_id' => auth()->id(), // Assuming the teacher is authenticated
            'title' => $request->title,
            'descrption' => $request->descrption,
            'file' => $filePath, // Store file path in the database
            'file_size' => $fileSize
        ]);

        toastr()->success('The data has been modified successfully');

        return redirect()->route('teacher.filemanger.index');
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
        $Filemanger = Filemanger::where('id', $id)->first();

        return view("teacher.filemanger.edit", compact('Filemanger'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'title' => 'required|string|max:255',
            'descrption' => 'nullable|string',
            'file' => 'nullable|file' // إذا كنت ترغب في تحديث الملف
        ]);

        // العثور على الملف باستخدام الـ ID
        $fileManager = Filemanger::findOrFail($id);

        // تحديث الخصائص
        $fileManager->title = $request->input('title');
        $fileManager->descrption = $request->input('descrption');

        // إذا كان هناك ملف جديد، تحميله وتحديث الحقل
        if ($request->hasFile('file')) {
            $filePath = public_path('storage/' . $fileManager->file); // تأكد من استخدام المسار الصحيح
            if (file_exists($filePath)) { // تحقق مما إذا كان الملف موجودًا
                unlink($filePath); // حذف الملف
            } 


            $file = $request->file('file');
            $filePath = $file->store('files', 'public'); // Store in 'storage/app/public/files'
            $fileSize = $request->file('file')->getSize(); // احصل على حجم الملف

            $fileManager->file = $filePath; // تحديث المسار للملف الجديد
        }
        $fileManager->file_size = $fileSize;

        $fileManager->save();

        toastr()->success('The data has been modified successfully');

        return redirect()->route('teacher.filemanger.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the file record by ID
        $file = Filemanger::findOrFail($id); // Use findOrFail to handle not found cases
        // Delete the file from storage
        $filePath = public_path('storage/' . $file->file); // تأكد من استخدام المسار الصحيح
        if (file_exists($filePath)) { // تحقق مما إذا كان الملف موجودًا
            unlink($filePath); // حذف الملف
        } else {
            // التعامل مع الحالة عندما لا يكون الملف موجودًا
            return response()->json(['message' => 'File not found'], 404);
        }

        // Delete the record from the database
        $file->delete(); // This will remove the record

        // Optionally return a response
        return response()->json(['message' => 'File deleted successfully.'], 200);
    }
}

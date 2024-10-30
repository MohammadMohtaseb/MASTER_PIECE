<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public $students = [];
    public function search(Request $request)
    {
        $request->validate([
            'classroom' => 'required'
        ]);

        $students = Student::where('classroom_id', $request->classroom)->get();

        return view("teacher.attendances.index", compact('students'));
    }
    public function index()
    {
        return view("teacher.attendances.index");
    }


    public function store(Request $request)
    {
        $date = now()->format('Y-m-d'); // نحفظ فقط التاريخ بدون التوقيت

        // الحصول على جميع الطلاب في الفصل
        $students = Student::where('classroom_id', $request->classroom)->get();

        // إذا كان هناك طلاب تم تحديدهم في الحضور
        $attendanceData = $request->attendance ?? [];

        foreach ($students as $student) {
            // تحقق إذا كان الطالب موجودًا في قائمة الحضور المرسلة (الذين تم تحديدهم)
            $isAbsent = isset($attendanceData[$student->id]);

            // استخدام updateOrCreate لمنع تكرار السجل لنفس اليوم والطالب
            Attendance::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'date' => $date,  // تحديد اليوم فقط
                ],
                [
                    'teacher_id' => Auth::guard('teacher')->user()->id,
                    'status' => $isAbsent ? 1 : 0  // 1 إذا كان غائبًا (تم تحديده)، 0 إذا كان حاضرًا (لم يتم تحديده)
                ]
            );
        }

        return redirect()->back()->with('success', 'Attendance saved successfully.');
    }
}

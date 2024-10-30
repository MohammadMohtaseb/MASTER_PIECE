<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    public function index()
    {
        // الحصول على جميع الطلاب المرتبطين بولي الأمر
        $students = Auth::guard('parent')->user()->student;

        // إذا كان هناك طلاب، نحصل على جميع التقارير لهم
        $Reports = collect(); // مصفوفة لتخزين التقارير

        foreach ($students as $student) {
            $studentReports = Report::where('student_id', $student->id)->get();
            $Reports = $Reports->merge($studentReports); // دمج التقارير في المصفوفة
        }

        return view("parent.reports.index", compact('Reports'));
    }
    public function show($id)
    {
        $Report = Report::where('id', $id)
            ->whereIn('student_id', Auth::guard('parent')->user()->student->pluck('id'))
            ->first();
        if (!$Report) {
            return redirect()->back();
        }

        $Report->visible = 1;
        $Report->save(); // حفظ التعديلات في قاعدة البيانات

        return view("parent.reports.show", compact('Report'));
    }
}

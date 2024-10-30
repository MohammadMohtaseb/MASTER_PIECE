<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    protected $classroom_student;

    /**
     * Display a listing of the exams for the student's classroom.
     */
    public function index()
    {
        $this->classroom_student = Auth::guard('parent')->user()->student->pluck('classroom_id');;
        // Get exams related to the student's classroom
        $Exams = Exam::whereIn('classroom_id', $this->classroom_student)->get();

        return view("parent.exams.index", compact('Exams'));
    }

    private function check_exam_relation($student)
    {
        // احصل على المعلمين المرتبطين بفصل الطالب
        $classroom_teachers = $student->classroom->teachers;
        $teacher_ids = $classroom_teachers->pluck('id')->toArray();

        // تحقق إذا كان الامتحان مرتبطًا بمعلمي فصل الطالب
        return Exam::whereIn('teacher_id', $teacher_ids)->get();
    }


    public function showResult($id)
    {
        $now = Carbon::now();

        // احصل على الامتحان
        $exam = Exam::findOrFail($id);

        // احصل على الفصل الدراسي من المعلم المرتبط بالامتحان
        $classroomId = $exam->classroom_id; // افترض أن لديك علاقة لفرز الفصل الدراسي

        // احصل على جميع الطلاب المرتبطين بولي الأمر
        $students = Auth::guard('parent')->user()->student;

        // تأكد من أن ولي الأمر لديه طلاب
        if ($students->isEmpty()) {
            return redirect()->back();
        }

        // تصفية الطلاب حسب الفصل الدراسي
        $filteredStudents = $students->filter(function ($student) use ($classroomId) {
            return $student->classroom_id == $classroomId; // افترض أن لديك حقل classroom_id في نموذج الطالب
        });

        // تحقق إذا كان أي من الطلاب لديهم صلاحية لدخول الامتحان
        $allowed = false;
        foreach ($filteredStudents as $student) {
            if (!$this->check_exam_relation($student)->isEmpty()) {
                $allowed = true;
                break; // إذا وجدنا طالبًا مسموحًا له بدخول الامتحان، نتوقف
            }
        }

        if (!$allowed) {
            return redirect()->back();
        }

        // تحقق من تاريخ عرض النتائج
        if (!Carbon::parse($exam->result_exam)->isSameDay($now) && !Carbon::parse($exam->result_exam)->lessThan($now)) {
            return redirect()->back();
        }

        // جمع إجابات الطلاب المصفين
        $answers = collect();
        foreach ($filteredStudents as $student) {
            $studentAnswers = Answer::where('student_id', $student->id)
                ->whereIn('question_id', $exam->questions->pluck('id'))
                ->get();
            $answers = $answers->merge($studentAnswers);
        }

        $questions = $exam->questions()->paginate(10);

        return view("parent.exams.result.index", compact('exam', 'answers', 'questions'));
    }
}

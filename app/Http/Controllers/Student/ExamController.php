<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    protected $classroom_student;

    /**
     * Display a listing of the exams for the student's classroom.
     */
    public function index()
    {
        $this->classroom_student = Auth::guard('student')->user()->classroom_id;
        // Get exams related to the student's classroom
        $Exams = Exam::where('classroom_id', $this->classroom_student)->get();

        return view("student.exams.index", compact('Exams'));
    }

    /**
     * Check if the exam belongs to the student's teachers.
     */
    private function check_exam_relation()
    {
        $classroom_teachers = Auth::guard('student')->user()->classroom->teachers;
        $teacher_ids = $classroom_teachers->pluck('id')->toArray();

        // Check if the exam relates to the student's classroom teachers
        return Exam::whereIn('teacher_id', $teacher_ids)->get();
    }

    /**
     * Allow student to enter an exam if they are allowed within the allowed time frame.
     */
    public function enter($id)
    {
        // Check if the student is allowed to take the exam
        if ($this->check_exam_relation()->isEmpty()) {
            return redirect()->back()->with('error', 'You do not have permission to enter this exam.');
        }

        // Retrieve the exam record by ID or return 404
        $exam = Exam::findOrFail($id);

        // Combine exam date and time into a single DateTime object
        $examDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $exam->start_exam . ' ' . $exam->start_exam_time);

        // Calculate the end time of the exam by adding its duration
        $examEndTime = $examDateTime->copy()->addMinutes($exam->time);

        // Get current time
        $now = Carbon::now();

        // Check if the current time is between the start and end of the exam
        if ($now->between($examDateTime, $examEndTime)) {
            // Fetch questions for the exam if the student is within the allowed time
            $questions = Question::where('exam_id', $id)->get();
            $lastQuestion = $questions->last(); // الحصول على آخر سؤال

            return view("student.questions.index", compact('questions', 'exam', 'lastQuestion'));
        } else {
            // Redirect back with an error message if the student is outside the allowed time
            return redirect()->back()->with('error', 'You cannot enter the exam. The exam is either not started or has already ended.');
        }
    }


    public function showResult($id)
    {
        $now = Carbon::now();

        // Check if the student is allowed to take the exam
        if ($this->check_exam_relation()->isEmpty()) {
            return redirect()->back()->with('error', 'You do not have permission to enter this exam.');
        }
        $exam = Exam::findOrFail($id);

        if (!Carbon::parse($exam->result_exam)->isSameDay($now) && !Carbon::parse($exam->result_exam)->lessThan($now)) {
            return redirect()->back()->with('error', 'You do not have permission to enter this exam.');
        }

        // Get the student's answers
        $studentId = Auth::guard('student')->user()->id;
        $answers = Answer::where('student_id', $studentId)
            ->whereIn('question_id', $exam->questions->pluck('id'))
            ->get();

            $questions = $exam->questions()->paginate(10);

        return view("student.exams.result.index", compact('exam', 'answers','questions'));
    }
}

<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\ExamResult;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function saveAnswer(Request $request)
    {
        // تحقق من صحة البيانات الواردة
        $request->validate([
            'question_id' => 'required|integer',
            'answer' => 'required|integer',
        ]);

        // البحث عن السؤال
        $question = Question::find($request->question_id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        // البحث عن الإجابة السابقة لهذا الطالب على هذا السؤال
        $existingAnswer = Answer::where('student_id', Auth::guard('student')->user()->id)
            ->where('question_id', $request->question_id)
            ->first();

        // إذا كانت الإجابة موجودة بالفعل، لا تسمح بالتعديل
        if ($existingAnswer) {
            return response()->json([
                'repeat' => true,
                'next' => true,
                'message' => 'You have already answered this question and cannot change your answer.',
                'is_correct' => $existingAnswer->is_correct,
                'selected_answer' => $existingAnswer->selected_answer, // إرجاع الإجابة المختارة
            ]);
        }

        // التحقق من صحة الإجابة
        $isCorrect = $question->answer_true == $request->answer;

        // حفظ الإجابة في جدول الإجابات
        Answer::create([
            'student_id' => Auth::guard('student')->user()->id, // استخدام Auth مع student guard
            'question_id' => $request->question_id,
            'selected_answer' => $request->answer,
            'is_correct' => $isCorrect,
        ]);

        return response()->json([
            'repeat' => false,
            'next' => true,
            'message' => $isCorrect ? 'Correct Answer!' : 'Wrong Answer!',
            'is_correct' => $isCorrect,
        ]);
    }

    public function getQuestionsWithAnswers()
    {
        $studentId = Auth::guard('student')->user()->id;
        $questions = Question::all();

        foreach ($questions as $question) {
            $question->existing_answer = Answer::where('student_id', $studentId)
                ->where('question_id', $question->id)
                ->first();
        }

        return response()->json($questions);
    }


    public function finishExam(Request $request)
{
    // تحقق من صحة البيانات الواردة
    $request->validate([
        'exam_id' => 'required|integer',
        'question_id' => 'required|integer',
        'answer' => 'required|integer',
    ]);

    // البحث عن السؤال الأخير
    $question = Question::find($request->question_id);

    if (!$question) {
        return response()->json(['message' => 'Question not found']);
    }

    // البحث عن الإجابة السابقة لهذا الطالب على هذا السؤال
    $existingAnswer = Answer::where('student_id', Auth::guard('student')->user()->id)
        ->where('question_id', $request->question_id)
        ->first();

    // إذا كانت الإجابة غير موجودة، نقوم بحفظها
    if (!$existingAnswer) {
        $isCorrect = $question->answer_true == $request->answer;
        Answer::create([
            'student_id' => Auth::guard('student')->user()->id,
            'question_id' => $request->question_id,
            'selected_answer' => $request->answer,
            'is_correct' => $isCorrect,
        ]);
    }

    // جلب جميع الأسئلة الخاصة بالامتحان
    $examQuestions = Question::where('exam_id', $request->exam_id)->pluck('id');

    // حساب عدد الإجابات الصحيحة بناءً على الأسئلة الموجودة في الامتحان
    $correctAnswersCount = Answer::where('student_id', Auth::guard('student')->user()->id)
        ->whereIn('question_id', $examQuestions)
        ->where('is_correct', 1)
        ->count();

    // حساب العدد الكلي للأسئلة
    $totalQuestions = $examQuestions->count();
    $score = ($correctAnswersCount / $totalQuestions) * 100;

    // حفظ النتيجة النهائية في جدول ExamResult
    ExamResult::create([
        'student_id' => Auth::guard('student')->user()->id,
        'exam_id' => $request->exam_id,
        'score' => $score,
    ]);

    return response()->json([
        'message' => 'Exam finished! Your score is ' . $score,
    ]);
}

}

<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;

class QuestionController extends Controller
{
    public function index($id)
    {
        $Questions = Question::where('exam_id', $id)->get();
        $Exam = Exam::where('id', $id)->first();

        if ($Questions) {
            return view("teacher.questions.index", compact('Questions', 'Exam'));
        }
        return redirect()->back();
    }

    public function create($id)
    {
        $Exam = Exam::where('id', $id)->first();
        return view("teacher.questions.create", compact('Exam'));
    }

    public function store(Request $request, $id)
    {
        // Validate all the questions
        $request->validate([
            'questions.*.title' => 'required',
            'questions.*.answer1' => 'required',
            'questions.*.answer2' => 'required',
            'questions.*.answer3' => 'required',
            'questions.*.answer4' => 'required',
            'questions.*.answer_true' => 'required',
        ]);

        try {
            // Loop through each question and save it
            foreach ($request->questions as $questionData) {
                $Question = new Question();
                $Question->title = $questionData['title'];
                $Question->answer1 = $questionData['answer1'];
                $Question->answer2 = $questionData['answer2'];
                $Question->answer3 = $questionData['answer3'];
                $Question->answer4 = $questionData['answer4'];
                $Question->answer_true = $questionData['answer_true'];
                $Question->exam_id = $id;
                $Question->save();
            }

            toastr()->success('Data has been saved successfully!');

            return redirect()->back();
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->back();

        }
    }

    public function edit(Request $request, $id)
    {
        $Question = Question::where('id', $id)->first();
        if ($Question && $Question->exam->teacher_id == Auth::guard('teacher')->user()->id) {
            return view("teacher.questions.edit", compact('Question'));
        }
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'answer_true' => 'required'
        ]);
        try {
            Question::where('id', $id)->update([
                'title' => $request->title,
                'answer1' => $request->answer1,
                'answer2' => $request->answer2,
                'answer3' => $request->answer3,
                'answer4' => $request->answer4,
                'answer_true' => $request->answer_true
            ]);
            toastr()->success('Data has been saved successfully!');

            return redirect()->back();
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->back();
        }
    }
    public function destory($id)
    {
        $Question = Question::findOrFail($id);
        $Question->delete();

        return response()->json(['success' => 'Material deleted successfully.']);

    }
}

<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;
use Yajra\DataTables\Facades\DataTables;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $today = Carbon::now();
            $exams = Exam::where('teacher_id', auth()->guard('teacher')->user()->id);

            // Filter exams based on the request
            if ($request->filter == 'active') {
                $exams->where('result_exam', '>=', $today);
            } elseif ($request->filter == 'ended') {
                $exams->where('result_exam', '<', $today);
            }

            return DataTables::of($exams)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('teacher.questions.home', $row->id) . '" class="btn btn-sm btn-primary">Questions</a>
                                <a href="' . route('teacher.exams.edit', $row->id) . '" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="#" data-id="' . $row->id . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                })
                ->editColumn('start_exam', function ($row) {
                    return $row->start_exam;
                })
                ->editColumn('result_exam', function ($row) {
                    return $row->result_exam;
                })
                ->editColumn('days_difference', function ($row) use ($today) {
                    $days = $today->diffInDays($row->result_exam, false);
                    $class = $row->start_exam >= date('Y-m-d') ? 'badge bg-success' : 'badge bg-danger';
                    $result = '';
                    if ($row->start_exam <= date("Y-m-d")) {
                        $result = '<a target="_blank" href="' . route('teacher.result', $row->id) . '" class="badge bg-primary">Result</a>';
                    }
                    return $result . ' <span class="' . $class . ' text-white fw-bold">' . $days . '</span>';
                })
                ->rawColumns(['actions', 'days_difference'])
                ->make(true);
        }

        return view("teacher.exams.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_exam' => 'required|date',
            'result_exam' => 'required|date|after:start_exam',
            'start_exam_time' => 'required',
            'time' => 'required'
        ]);

        try {
            $Exam = new Exam();
            $Exam->title = $request->title;
            $Exam->start_exam = $request->start_exam;
            $Exam->result_exam = $request->result_exam;
            $Exam->start_exam_time = $request->start_exam_time;
            $Exam->teacher_id = auth()->guard('teacher')->user()->id;
            $Exam->classroom_id = $request->classroom_id;
            $Exam->time = $request->time;
            $Exam->save();

            toastr()->success('Data has been saved successfully!');
            return redirect()->route('teacher.exams.index');
        } catch (PDOException $e) {
            toastr()->error('An error occurred!');

            return redirect()->back();
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
        $Exam = Exam::where('id', $id)->first();
        if ($Exam) {
            return view('teacher.exams.edit', compact('Exam'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'start_exam' => 'required|date',
            'result_exam' => 'required|date|after:start_exam',
            'start_exam_time' => 'required',
            'time' => 'required'
        ]);
        Exam::where('id', $id)->update([
            'title' => $request->title,
            'start_exam' => $request->start_exam,
            'result_exam' => $request->result_exam,
            'start_exam_time' => $request->start_exam_time,
            'time' => $request->time
        ]);
        toastr()->success('The data has been modified successfully');
        return redirect()->route('teacher.exams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Exam = Exam::findOrFail($id);
        $Exam->delete();

        return response()->json(['success' => 'Material deleted successfully.']);
    }


    public function result($id)
    {
        $Exam = Exam::where('id', $id)->first();
        if(!$Exam || $Exam->teacher_id != Auth::guard('teacher')->user()->id){
            return redirect()->back();
        }
        return view("teacher.result.index",compact('Exam'));
    }
}

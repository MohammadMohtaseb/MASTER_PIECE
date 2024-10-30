@extends('parent.layouts.app')
@push('css')
    <style>
        hr {
            margin: 0;
        }

        .pagination {
            margin: 20px 0;
        }

        .page-item {
            margin: 0 5px;
        }

        .page-link {
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px 15px;
            transition: background-color 0.3s;
        }

        .page-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        .page-item.active .page-link {
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
    </style>
@endpush


@section('content')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3>Results</h3>
            <a href="{{ route('parent.exams.home') }}" class="btn btn-dark d-none d-sm-inline-block">
                Back to Exams
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @php
                // احصل على الامتحان
                $exam = \App\Models\Exam::findOrFail($exam->id);

                // احصل على جميع الطلاب المرتبطين بولي الأمر
                $students = Auth::guard('parent')
                    ->user()
                    ->student()
                    ->where('classroom_id', $exam->classroom_id) // تأكد من أن لديك علاقة classroom_id
                    ->where('created_at','<=',$exam->created_at)
                    ->get();
            @endphp
            @foreach ($students as $student)
                <div class="card my-4">
                    <div class="card-body">
                        <div class="information text-center">
                            <h4 class="text-uppercase">Result :  {{ $student->name }}</h4>

                            @php
                                // جلب نتيجة الامتحان لهذا الطالب
                                $examResult = $exam->exam_result($student->id);
                            @endphp
                            @if ($examResult)
                                <h1 class="{{ $examResult->score > 50 ? 'text-success' : 'text-danger' }}">
                                    Score: {{ $examResult->score }}
                                </h1>
                                <h5 class="text-uppercase {{ $examResult->score > 50 ? 'text-success' : 'text-danger' }}">
                                    {{ $examResult->score > 50 ? 'You have passed the exam' : 'You failed the exam, good luck' }}
                                </h5>

                                <div class="d-flex justify-content-center" style="gap:10px">
                                    <h2 class="btn btn-dark"><img src="/dashboard/assets/icons/title.png" width="25"
                                            alt=""> {{ $exam->title }}</h2>
                                    <h2 class="btn btn-dark"><img src="/dashboard/assets/icons/teacher.png" width="25"
                                            alt=""> {{ $exam->teacher->name }}</h2>
                                    <h2 class="btn btn-dark"><img src="/dashboard/assets/icons/book.png" width="25"
                                            alt=""> {{ $exam->teacher->material->name }}</h2>
                                </div>
                                <hr style="margin:0 !important;padding:0" />

                                @php
                                    // جمع الإجابات لهذا الطالب
                                    $correctAnswers = $exam->questions
                                        ->filter(function ($question) use ($student) {
                                            return $question
                                                ->answers()
                                                ->where('student_id', $student->id)
                                                ->where('is_correct', true)
                                                ->exists();
                                        })
                                        ->count();

                                    $wrongAnswers = $exam->questions->count() - $correctAnswers;
                                @endphp

                                <div class="d-flex justify-content-center my-2" style="gap:10px">
                                    <h2 class="btn btn-success">Correct: {{ $correctAnswers }}</h2>
                                    <h2 class="btn btn-danger">Wrong: {{ $wrongAnswers }}</h2>
                                </div>

                                <table id="datatable"
                                    class="table-bordered border table table-striped dataTable p-0 text-center">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Your Answer</th>
                                            <th>Correct Answer</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exam->questions as $question)
                                            @php
                                                $userAnswer = $question
                                                    ->answers()
                                                    ->where('student_id', $student->id)
                                                    ->first();
                                                $isCorrect = $userAnswer && $userAnswer->is_correct;

                                                // الحصول على قيمة الإجابة بناءً على رقم العمود المخزن
                                                $selectedAnswerValue = '';
                                                if ($userAnswer) {
                                                    switch ($userAnswer->selected_answer) {
                                                        case 1:
                                                            $selectedAnswerValue = $question->answer1;
                                                            break;
                                                        case 2:
                                                            $selectedAnswerValue = $question->answer2;
                                                            break;
                                                        case 3:
                                                            $selectedAnswerValue = $question->answer3;
                                                            break;
                                                        case 4:
                                                            $selectedAnswerValue = $question->answer4;
                                                            break;
                                                    }
                                                }

                                                // الحصول على القيمة الصحيحة بناءً على رقم العمود المخزن في answer_true
                                                $correctAnswerValue = '';
                                                switch ($question->answer_true) {
                                                    case 1:
                                                        $correctAnswerValue = $question->answer1;
                                                        break;
                                                    case 2:
                                                        $correctAnswerValue = $question->answer2;
                                                        break;
                                                    case 3:
                                                        $correctAnswerValue = $question->answer3;
                                                        break;
                                                    case 4:
                                                        $correctAnswerValue = $question->answer4;
                                                        break;
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $question->title }}</td>
                                                <td>{{ $selectedAnswerValue ?: 'No Answer' }}</td>
                                                <td>{{ $correctAnswerValue }}</td>
                                                <td class="{{ $isCorrect ? 'text-success' : 'text-danger' }}">
                                                    {{ $isCorrect ? 'Correct' : 'Wrong' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- Pagination links --}}
                            @else
                                <div class="card text-center" style="border: 25px solid #4e2439;">
                                    <div class="card-body text-danger">
                                        <h1 class="text-danger text-uppercase"
                                            style="background: #4e2439; padding: 15px; border-radius: 5px;">
                                            Did not attend the exam
                                        </h1>
                                        <img class="d-block m-auto" src="https://www.svgrepo.com/show/530461/loss.svg"
                                            width="450" alt="">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection

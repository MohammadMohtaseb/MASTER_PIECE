@extends('student.layouts.app')
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

@section('title')
    RESULT EXAM
@endsection

@section('content')
    <div class="row">
        <div class="col">
            @if ($exam->enter_student_exam())
                <div class="card">
                    <div class="card-body">
                        <div class="information text-center">
                            <h1>Welcome {{ Auth::guard('student')->user()->name }}</h1>
                            <h1 class="{{ $exam->exam_result(Auth::guard('student')->user()->id)->score > 50 ? 'text-success' : 'text-danger' }}">
                                Score: {{ $exam->exam_result(Auth::guard('student')->user()->id)->score }}
                            </h1>
                            <h3 class="{{ $exam->exam_result(Auth::guard('student')->user()->id)->score > 50 ? 'text-success' : 'text-danger' }}">
                                {{ $exam->exam_result(Auth::guard('student')->user()->id)->score > 50 ? 'You have passed the exam' : 'You failed the exam, good luck' }}
                            </h3>
                            <div class="d-flex justify-content-center my-3" style="gap:10px">
                                <h2 class="btn btn-dark"><img src="/dashboard/assets/icons/title.png" width="25"
                                        alt=""> {{ $exam->title }}</h2>
                                <h2 class="btn btn-dark"><img src="/dashboard/assets/icons/teacher.png" width="25"
                                        alt=""> {{ $exam->teacher->name }}</h2>
                                <h2 class="btn btn-dark"><img src="/dashboard/assets/icons/book.png" width="25"
                                        alt=""> {{ $exam->teacher->material->name }}</h2>
                            </div>
                            <hr style="margin:0 !important;padding:0" />
                            <div class="d-flex justify-content-center my-2" style="gap:10px">
                                @php
                                    $student = Auth::guard('student')->user();
                                    $correctAnswers = $exam->questions
                                        ->filter(function ($question) use ($student) {
                                            $answer = $question
                                                ->answers()
                                                ->where('student_id', $student->id)
                                                ->first();
                                            return $answer && $answer->is_correct;
                                        })
                                        ->count();

                                    $wrongAnswers = $exam->questions->count() - $correctAnswers;
                                @endphp

                                <h2 class="btn btn-success">Correct: {{ $correctAnswers }}</h2>
                                <h2 class="btn btn-danger">Wrong: {{ $wrongAnswers }}</h2>
                            </div>
                            <table id="datatable" class="table-bordered border table table-striped dataTable p-0 text-center">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Your Answer</th>
                                        <th>Correct Answer</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
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
                            {{ $questions->links('vendor.pagination.default') }}
                        </div>
                    </div>
                </div>
            @else
                <div class="card text-center" style="border: 25px solid #4e2439;">
                    <div class="card-body text-danger">
                        <h1 class="text-danger text-uppercase"
                            style="background: #4e2439; padding: 15px; border-radius: 5px;">
                            Did not attend the exam
                        </h1>
                        <img class="d-block m-auto" src="https://www.svgrepo.com/show/530461/loss.svg" width="450"
                            alt="">
                        <a href="{{ route('student.home') }}" class="btn btn-danger">BACK PAGE</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

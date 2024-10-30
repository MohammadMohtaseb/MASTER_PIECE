@extends('student.layouts.app')

@section('content')
    <div class="row text-center min-height">
        <div class="col-12">
            <div class="card">


                <div class="card-body">
                    <h3>Informations</h3>
                    @php
                        use Carbon\Carbon;
                        $startExamDate = Carbon::parse($exam->start_exam);
                        $startExamTime = Carbon::parse($exam->start_exam_time);
                    @endphp
                    <input type="hidden" id="start_exam" value="{{ $startExamDate->format('Y-m-d') }}">
                    <input type="hidden" id="start_exam_time" value="{{ $startExamTime->format('H:i:s') }}">
                    <input type="hidden" id="time" value="{{ $exam->time }}">
                    <div id="countdown-timer" class="btn btn-dark">Loading...</div>
                    <span class="btn btn-dark">
                       
                        {{ $exam->title }}
                    </span>
                    <span class="btn btn-dark">
                     
                        Mr : {{ $exam->teacher->name }}
                    </span>
                    <span class="btn btn-dark">
                        
                        {{ $exam->teacher->material->name }}
                    </span>
                    <div class="questions-information my-2">
                        <span class="btn btn-dark">
                            
                            Questions : {{ $exam->questions->count() }}</span>
                    </div>

                </div>
            </div>
        </div>
        {{-- Answers --}}
        <div class="col-12">
            <div id="question-container">
                @foreach ($questions as $key => $question)
                    <div class="question {{ $key == 0 ? 'active' : '' }}" data-question-id="{{ $question->id }}">
                        <h3 class="title-question ">{{ $question->title }}</h3>
                        <form class="question-form">
                            @php
                                $selectedAnswer = isset($studentAnswers[$question->id])
                                    ? $studentAnswers[$question->id]->answer
                                    : null;
                            @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="custom-radio">
                                        <input type="radio" name="answer_{{ $question->id }}" value="1"
                                            {{ $selectedAnswer == 1 ? 'checked' : '' }}
                                            {{ $selectedAnswer ? 'disabled' : '' }}>
                                        {{ $question->answer1 }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="custom-radio">
                                        <input type="radio" name="answer_{{ $question->id }}" value="2"
                                            {{ $selectedAnswer == 2 ? 'checked' : '' }}
                                            {{ $selectedAnswer ? 'disabled' : '' }}>
                                        {{ $question->answer2 }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-6">

                                    <label class="custom-radio">
                                        <input type="radio" name="answer_{{ $question->id }}" value="3"
                                            {{ $selectedAnswer == 3 ? 'checked' : '' }}
                                            {{ $selectedAnswer ? 'disabled' : '' }}>
                                        {{ $question->answer3 }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <label class="custom-radio">
                                        <input type="radio" name="answer_{{ $question->id }}" value="4"
                                            {{ $selectedAnswer == 4 ? 'checked' : '' }}
                                            {{ $selectedAnswer ? 'disabled' : '' }}>
                                        {{ $question->answer4 }}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>




                            <div class="feedback"></div>
                        </form>
                        <div class="navigation">

                            <button type="button" class="prev-question"
                                {{ $key == 0 ? 'disabled' : '' }}>Previous</button>
                            @if ($key == count($questions) - 1)
                                @if (!$exam->enter_student_exam())
                                    <button type="button" class="finish-exam" data-exam-id="{{ $exam->id }}"
                                        data-last-question-id="{{ $questions->last()->id }}">Finish Exam</button>
                                @else
                                    <a href="{{ route('student.exams.home') }}" class="btn btn-danger">Exit</a>
                                @endif
                            @else
                                <button type="button" class="next-question">Next</button>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endsection
    @push('css')
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 50px auto;
                background-color: #fff;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }

            .question {
                display: none;
            }

            .question h3 {
                background-image: linear-gradient( 135deg, #F05F57 10%, #360940 100%);
                color: #ffff;
                font-weight: bold;
                padding: 20px 0;
                margin: 10px;
                border-radius: 10px;
            }

            .question.active {
                display: block;
            }

            .navigation {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }

            button {
                padding: 10px 20px;
                border: none;
                background-color: #28a745;
                color: white;
                border-radius: 5px;
                cursor: pointer;
            }

            button:disabled {
                background-color: #ccc;
            }

            .finish-exam {
                background-color: #007bff;
            }

            .feedback {
                margin-top: 10px;
                font-size: 16px;
                color: red;
            }

            /* تنسيق input radio بشكل أزرار */
            .custom-radio {
                display: block;
                position: relative;
                padding-left: 40px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 18px;
                user-select: none;
                padding-bottom: 10px;
                padding-top: 10px;
                background: #fff;
                border-radius: 10px;
                transition: .1s ease-in;
            }

            .custom-radio:hover {
                background: #337dd5;
                color: #fff;
            }

            .custom-radio input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            .custom-radio .checkmark {
                position: absolute;
                top: 25%;
                left: 2%;
                height: 25px;
                width: 25px;
                background-color: #eee;
                border-radius: 50%;
            }

            .custom-radio:hover input~.checkmark {
                background-color: #ccc;
            }

            .custom-radio input:checked~.checkmark {
                background-color: #28a745;
            }

            .custom-radio .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            .custom-radio input:checked~.checkmark:after {
                display: block;
            }

            .custom-radio .checkmark:after {
                top: 9px;
                left: 9px;
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: white;
            }
        </style>
    @endpush
    @push('js')
        <script>
            $(document).ready(function() {
                const startExamDateTimeString = $('#start_exam').val() + ' ' + $('#start_exam_time').val();
                const examDurationMinutes = parseInt($('#time').val());

                const startExamDateTime = new Date(startExamDateTimeString).getTime();
                const now = new Date().getTime();

                // Calculate the end time of the exam
                const endExamDateTime = startExamDateTime + (examDurationMinutes * 60000);

                // Update countdown every second
                const countdown = setInterval(function() {
                    const currentTime = new Date().getTime();
                    const timeLeft = endExamDateTime - currentTime;

                    // Calculate hours, minutes, and seconds
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                    let text = '';
                    // Display the time remaining
                    if (hours > 0) {
                        text = hours + "h " + minutes + "m " + seconds + "s "
                    } else {
                        text = minutes + "m " + seconds + "s "
                    }
                    $('#countdown-timer').html(`${text}`);

                    // If time is up, stop the countdown and notify the user
                    if (timeLeft < 0) {

                        clearInterval(countdown);
                        Swal.fire({
                            title: "Finish Exam",
                            text: "The exam has been completed, please click on the Finish Exam button",
                            icon: "success"
                        });

                        $('#countdown-timer').html("EXPIRED");
                        // Disable all radio buttons
                        $('input[type="radio"]').attr('disabled', true);

                        // Clear answers for unanswered questions
                        $('.question').each(function() {
                            const questionId = $(this).data('question-id');
                            if (!$(`input[name="answer_${questionId}"]:checked`).length) {
                                $(`input[name="answer_${questionId}"]`).prop('checked', false);
                            }
                        });

                        // Optionally, submit answers or perform other actions
                    }
                }, 1000);

                let currentQuestionIndex = 0;
                const questions = $('.question');
                const totalQuestions = questions.length;

                // Load previous answers
                $.get('{{ route('student.answer.questions_with_answers') }}', function(data) {
                    data.forEach(question => {
                        const questionElement = $(`.question[data-question-id="${question.id}"]`);
                        if (question.existing_answer) {
                            questionElement.find(
                                `input[value="${question.existing_answer.selected_answer}"]`).prop(
                                'checked', true);
                            questionElement.find('input[type="radio"]').attr('disabled',
                                true); // Disable inputs if answered
                        }
                    });
                });

                // Navigate to the next question
                $('.next-question').on('click', function() {
                    const currentQuestion = questions.eq(currentQuestionIndex);

                    const selectedAnswer = currentQuestion.find('input[type="radio"]:checked').val();
                    const questionId = currentQuestion.data('question-id');

                    if (selectedAnswer || currentQuestionIndex < totalQuestions - 1) {
                        // Save the answer
                        if (selectedAnswer) {
                            $.post('{{ route('student.answer.save') }}', {
                                question_id: questionId,
                                answer: selectedAnswer,
                                _token: '{{ csrf_token() }}'
                            }, function(response) {
                                console.log(response);
                            }, 'json');
                        }

                        // Move to the next question
                        currentQuestion.removeClass('active');
                        currentQuestionIndex++;
                        questions.eq(currentQuestionIndex).addClass('active');
                    } else {
                        alert('Please select an answer before moving to the next question.');
                    }
                });

                // Navigate to the previous question
                $('.prev-question').on('click', function() {
                    if (currentQuestionIndex > 0) {
                        const currentQuestion = questions.eq(currentQuestionIndex);
                        currentQuestion.removeClass('active');
                        currentQuestionIndex--;
                        const prevQuestion = questions.eq(currentQuestionIndex);
                        prevQuestion.addClass('active');
                    }
                });

                // Finish the exam
                $('.finish-exam').on('click', function() {
                    var examId = $(this).data('exam-id');
                    var lastQuestionId = $(this).data('last-question-id');
                    var selectedAnswer = $('input[name="answer_' + lastQuestionId + '"]:checked').val();
                    $.post('{{ route('student.answer.exam.finish') }}', {
                        exam_id: examId,
                        question_id: lastQuestionId,
                        answer: selectedAnswer,
                        _token: '{{ csrf_token() }}'
                    }, function(response) {
                        if (response.message) {
                            Swal.fire({
                                title: 'You finished the exam',
                                text: 'You will now be directed to the home page',
                                icon: 'success',
                                confirmButtonText: 'Click here'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to the home page
                                    window.location.href = "{{ route('student.home') }}";
                                }
                            });
                        }

                    }, 'json');
                });
            });
        </script>
    @endpush

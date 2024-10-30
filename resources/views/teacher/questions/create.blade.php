@extends('teacher.layouts.app')

@section('title')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3>  Add Questions || {{ $Exam->title }}</h3>
            <a href="{{route('teacher.questions.home',$Exam->id)}}" class="btn btn-dark d-none d-sm-inline-block">
                 Questions
            </a>
        </div>
    </div>
@endsection

@section('content')
   <div class="card">
    <div class="card-body">
        <div class="card-title"> Add Questions || {{ $Exam->title }}</div>
        
        <!-- عرض كل الأخطاء بشكل عام -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('teacher.questions.store',$Exam->id)}}" method="POST" id="questionsForm">
            @csrf

            <div id="questionsWrapper">
                @php $oldQuestions = old('questions', []); @endphp
                @foreach ($oldQuestions as $index => $oldQuestion)
                    <div class="question-item">
                        <div class="form-group">
                            <label for="">Question</label>
                            <input type="text" class="form-control" name="questions[{{ $index }}][title]" value="{{ old('questions.' . $index . '.title') }}">
                            <!-- عرض الخطأ الخاص بالحقل -->
                            @error('questions.' . $index . '.title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label for="">Answer 1</label>
                                <input type="text" name="questions[{{ $index }}][answer1]" class="form-control" value="{{ old('questions.' . $index . '.answer1') }}">
                                @error('questions.' . $index . '.answer1')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="">Answer 2</label>
                                <input type="text" name="questions[{{ $index }}][answer2]" class="form-control" value="{{ old('questions.' . $index . '.answer2') }}">
                                @error('questions.' . $index . '.answer2')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="">Answer 3</label>
                                <input type="text" name="questions[{{ $index }}][answer3]" class="form-control" value="{{ old('questions.' . $index . '.answer3') }}">
                                @error('questions.' . $index . '.answer3')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="">Answer 4</label>
                                <input type="text" name="questions[{{ $index }}][answer4]" class="form-control" value="{{ old('questions.' . $index . '.answer4') }}">
                                @error('questions.' . $index . '.answer4')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="">The right answer</label>
                            <input type="text" name="questions[{{ $index }}][answer_true]" required class="form-control bg-teal text-white text-center fw-bold" value="{{ old('questions.' . $index . '.answer_true') }}">
                            @error('questions.' . $index . '.answer_true')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="button" class="btn btn-danger remove-question">Remove</button>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-primary btn-lg my-2" id="addQuestion">Add Question</button>
            <!-- زر Submit سيتم إخفاؤه مبدئيًا -->
            <button type="submit" class="btn btn-success btn-lg my-2" id="submitBtn" style="display: none;">Submit</button>
        </form>
    </div>
   </div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var questionIndex = {{ count(old('questions', [])) }}; // Get the current question index

    // إظهار زر Submit عند إضافة أول سؤال
    function toggleSubmitButton() {
        if ($('.question-item').length > 0) {
            $('#submitBtn').show();
        } else {
            $('#submitBtn').hide();
        }
    }

    // استدعاء الدالة عند تحميل الصفحة للتأكد من أن زر Submit يظهر إذا كان هناك أسئلة قديمة
    toggleSubmitButton();

    $('#addQuestion').click(function() {
        // Create a new question block
        var newQuestion = `
            <div class="question-item my-4">
                <div class="form-group">
                    <label for="">Question</label>
                    <input type="text" class="form-control" name="questions[` + questionIndex + `][title]">
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="">Answer 1</label>
                        <input type="text" name="questions[` + questionIndex + `][answer1]" class="form-control">
                    </div>
                    <div class="col">
                        <label for="">Answer 2</label>
                        <input type="text" name="questions[` + questionIndex + `][answer2]" class="form-control">
                    </div>
                    <div class="col">
                        <label for="">Answer 3</label>
                        <input type="text" name="questions[` + questionIndex + `][answer3]" class="form-control">
                    </div>
                    <div class="col">
                        <label for="">Answer 4</label>
                        <input type="text" name="questions[` + questionIndex + `][answer4]" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">The right answer</label>
                    <input type="number" name="questions[` + questionIndex + `][answer_true]" class="form-control  text-center fw-bold">
                </div>
                <button type="button" class="btn btn-danger remove-question">Remove</button>
            </div>
        `;

        $('#questionsWrapper').append(newQuestion); // Append the new question block to the wrapper
        questionIndex++; // Increment the index for the next question

        // إظهار زر Submit بعد إضافة أول سؤال
        toggleSubmitButton();
    });

    // Remove question block
    $(document).on('click', '.remove-question', function() {
        $(this).closest('.question-item').remove(); // Remove the closest question block
        toggleSubmitButton(); // تحقق إذا كان يجب إخفاء زر Submit بعد إزالة سؤال
    });
});
</script>
@endpush

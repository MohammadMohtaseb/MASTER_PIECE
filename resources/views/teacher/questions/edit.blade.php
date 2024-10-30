@extends('teacher.layouts.app')

@section('title')
<div class="row my-2">
    <div class="col-12 d-flex justify-content-between">
        <h3>  Edit Question </h3>
        <a href="{{route('teacher.questions.home',$Question->exam->id)}}" class="btn btn-dark d-none d-sm-inline-block">
             Questions
        </a>
    </div>
</div>

    {{-- Add Questions || {{ $Question->exam->title }} --}}
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-title">Edit Question ({{$Question->title}}) Exam ({{ $Question->exam->title }})</div>
            <form action="{{route('teacher.questions.update',$Question->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Question</label>
                    <input type="text" value="{{$Question->title}}" class="form-control" name="title">
                    @error('title')
                        <div class="text-dange">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="">Answer 1</label>
                        <input type="text"  value="{{$Question->answer1}}"  name="answer1" class="form-control">
                        @error('answer1')
                            <div class="text-dange">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">Answer 2</label>
                        <input type="text" value="{{$Question->answer2}}"   name="answer2" class="form-control">
                        @error('answer2')
                            <div class="text-dange">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">Answer 3</label>
                        <input type="text"  value="{{$Question->answer3}}"  name="answer3" class="form-control">
                        @error('answer3')
                            <div class="text-dange">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">Answer 4</label>
                        <input type="text" value="{{$Question->answer4}}"  name="answer4" class="form-control">
                        @error('answer4')
                            <div class="text-dange">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
                <div class="form-group">
                    <label for="">The right answer</label>
                    <input type="text" value="{{$Question->answer_true}}"  name="answer_true" class="form-control  text-center fw-bold">
                </div>
        
                <button type="submit" class="btn btn-success btn-lg">Update</button>
            </form>
        </div>
    </div>
@endsection

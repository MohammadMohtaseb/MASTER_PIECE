@extends('teacher.layouts.app')
@section('title')
    <div class="row ">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3> Add New Exam ({{ Auth::guard('teacher')->user()->material->name }})</h3>
            <a href="{{ route('teacher.exams.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Exams
            </a>
        </div>
    </div>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('teacher.exams.store') }}" method="POST">
                @csrf
                <div class="row">
                
                    <div class="col">
                        <input type="text" value="{{old('title')}}" class="form-control" name="title" placeholder="Name Exam">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="">Start Exam Day</label>
                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="start_exam"
                            placeholder="Result appearance date">
                        @error('start_exam')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">Result Exam</label>
                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="result_exam"
                            placeholder="Result appearance date">
                        @error('result_exam')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <label for="">Start Exam Time</label>
                        <input type="time" value="{{old('start_exam_time')}}" class="form-control" name="start_exam_time">
                        @error('start_exam_time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">Classroom</label>
                        <select name="classroom_id" class="form-control">
                            @foreach (App\Models\Classroom::whereIn('id',app('classrooms_for_teacher'))->get() as $Item)
                                <option value="{{$Item->id}}">{{$Item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col">
                        <label for="">Exam time in(minutes)</label>
                        <input type="text" name="time" class="form-control">
                        @error('time')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                


                <input type="submit" class="btn btn-success btn-lg" value="Add">
            </form>
        </div>
    </div>
@endsection

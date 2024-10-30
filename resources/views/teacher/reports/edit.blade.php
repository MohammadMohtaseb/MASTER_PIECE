@extends('teacher.layouts.app')

@section('title')
    <img src="/dashboard/assets/icons/reports.png" width="25" alt=""> Edit || {{$Report->title}}
@endsection
@section('button')
<div class="col-auto ms-auto d-print-none">
  <div class="btn-list">
    <a href="{{route("teacher.reports.index")}}" class="btn btn-primary d-none d-sm-inline-block" >
      Reports
    </a>
  </div>
</div>
@endsection 
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('teacher.reports.update',$Report->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" value="{{$Report->title}}" class="form-control" name="title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="">Report</label>
                            <textarea name="report" class="form-control" cols="30" rows="10">{{$Report->report}}</textarea>
                            @error('report')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Classrooms</label>
                                <select name="classroom" class="form-control">
                                    <option value="" selected disabled>Select Classroom</option>
                                    @foreach (Auth::guard('teacher')->user()->classrooms as $item)
                                        <option value="{{ $item->id }}" @selected($item->id ==$Report->student->classroom->id)>{{ $item->name }}</option>
                                    @endforeach
                                    @error('classroom')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Student</label>
                                <select name="student" class="form-control">
                                    @foreach (\App\Models\Student::where('classroom_id',$Report->student->classroom->id)->get() as $student)
                                        <option value="{{$student->id}}" @selected($student->id == $Report->student->id)>{{$student->name}}</option>
                                    @endforeach
                                </select>
                                @error('student')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <input type="submit" class="btn btn-success my-2" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script>
        $(document).ready(function() {
            $('select[name="classroom"]').on('change', function() {
                var classRoom = $(this).val();
                if (classRoom) {
                    $.ajax({
                        url: '/teacher/reports/get-students/' + classRoom,
                        type: "get",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="student"]').empty();
                            $.each(data.students, function(key, value) {
                                $('select[name="student"]').append('<option value="' +
                                    value.id + '">' + value.name + '</option>');
                            });
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                } else {
                    $('select[name="class"]').empty();
                }
            });
        });
    </script>
@endpush

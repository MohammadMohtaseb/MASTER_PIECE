@extends('teacher.layouts.app')


@section('title')
    <div class="row ">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3> Add New Report</h3>
            <a href="{{ route('teacher.reports.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Reports
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-title">Add New Report</div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('teacher.reports.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="">Report</label>
                            <textarea name="report" class="form-control" cols="30" rows="10"></textarea>
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
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    @error('classroom')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Student</label>
                                <select name="student" class="form-control"></select>
                                @error('student')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <input type="submit" class="btn btn-lg rounded-2 btn-success my-2" value="Add">
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

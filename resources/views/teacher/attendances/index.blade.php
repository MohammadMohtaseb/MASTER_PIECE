@extends('teacher.layouts.app')



@section('content')
<div class="row my-2">
    <div class="col-12 d-flex justify-content-between">
        <h3>Attendances ({{ date('Y-m-d') }})</h3>
      
    </div>
</div>

    <div class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                
                <form action="{{ route('teacher.attendances.search') }}" method="get">
                    <div class="row">
                        <div class="col-10" style="margin: 0; padding: 0;">
                            <select name="classroom" class="form-control">
                                <option value="" selected disabled>Select Classroom</option>
                                @foreach (Auth::guard('teacher')->user()->classrooms as $item)
                                    <option @selected(Request('classroom') == $item->id) value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('classroom')
                                <div class="text-danger text-center fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-2" style="margin: 0; padding: 0;">
                            <button type="submit" class="btn py-3 btn-search-attendances btn-lg btn-danger" style="position: relative;left:13px">
                                <i class="fa fa-search-plus" aria-hidden="true"></i>

                               Search
                            </button>
                        </div>
                    </div>
                </form>

                @if (isset($students))
                @php
                // عدد الطلاب في الفصل
                $totalStudents = $students->count();

                // حساب عدد الغياب اليوم (حيث status = 1)
                $absentCount = $students->filter(function ($student) {
                    return $student->attendances()->whereDate('created_at', now()->toDateString())->where('status', 1)->exists();
                })->count();

                // عدد الحضور اليوم
                $presentCount = $totalStudents - $absentCount;
            @endphp

            <div class="row my-4">
                <div class="col-md-4">
                    <div class="card  text-center ">
                        <div class="card-body">
                            <h6 class="card-title">Number of students in the class</h6>
                            <h2 class="card-text text-primary">{{ $totalStudents }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6 class="card-title">Number of attendees today</h6>
                            <h2 class="card-text text-primary">{{ $presentCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6 class="card-title">Number of absences today</h6>
                            <h2 class="card-text text-primary">{{ $absentCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('teacher.attendances.store') }}" class="my-4">
                @csrf
                <table id="datatable" class="table-bordered border table table-striped dataTable p-0 text-center">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            @php
                                // تحقق مما إذا كان الطالب غائباً اليوم
                                $isAbsent = $student->attendances()->whereDate('created_at', now()->toDateString())->where('status', 1)->exists();
                            @endphp
                            <tr >
                                <td>{{ $student->name }}</td>
                                <td>
                                    <input type="hidden" value="{{ $student->classroom->id }}" name="classroom">
                                    
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="attendance[{{ $student->id }}]" value="1" {{ $isAbsent ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row my-2">
                    <button type="submit" class="btn btn-success">Save Attendance</button>

                </div>
            </form>
                @endif

            </div>
        </div>
    </div>
@endsection

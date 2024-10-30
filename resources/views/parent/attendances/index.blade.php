@extends('parent.layouts.app')



@push('css')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table td {
            vertical-align: middle;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        .filter-button {
            transition: background-color 0.3s;
        }

        .filter-button:hover {
            background-color: #0056b3;
        }
    </style>
@endpush

@section('content')
    <div class="row  my-4">
        <h5 class="mb-4">Attendance Summary</h5>

        <div class="col-md-6">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-start icon-box bg-dark">
                            <span class="text-white">
                                <i class="fa fa-info highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-end text-end">
                            <p class="card-text text-dark"> Present</p>
                            <h4>{{ $presentCount }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-start icon-box bg-dark">
                            <span class="text-white">
                                <i class="fa fa-info highlight-icon" aria-hidden="true"></i>

                            </span>
                        </div>
                        <div class="float-end text-end">
                            <p class="card-text text-dark"> Absent</p>
                            <h4>{{ $absentCount }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>




    </div>

    <div class="card shadow-sm mb-4">

        <div class="card-header  text-white">
            <h4 class="mb-0">Attendance Records</h4>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('parent.attendances.home') }}" class="mb-4">
                <div class="row justify-content-center">
                    <div class="form-group col-md-2">
                        <label for="student_id">Select Student:</label>
                        <select name="student_id" id="student_id" class="form-control">
                            <option value="">Choose Student</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" {{ $studentId == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="month">Select Month:</label>
                        <select name="month" id="month" class="form-control">
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="year">Select Year:</label>
                        <select name="year" id="year" class="form-control">
                            @for ($y = date('Y'); $y >= 2000; $y--)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="week">Select Week:</label>
                        <select name="week" id="week" class="form-control">
                            <option value="0" {{ $week == 0 ? 'selected' : '' }}>Choose Week</option>
                            <option value="1" {{ $week == 1 ? 'selected' : '' }}>Week 1</option>
                            <option value="2" {{ $week == 2 ? 'selected' : '' }}>Week 2</option>
                            <option value="3" {{ $week == 3 ? 'selected' : '' }}>Week 3</option>
                            <option value="4" {{ $week == 4 ? 'selected' : '' }}>Week 4</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="status">Attendance :</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Choose Status</option>
                            <option value="1" {{ $status == '1' ? 'selected' : '' }}>Present</option>
                            <option value="0" {{ $status == '0' ? 'selected' : '' }}>Absent</option>
                        </select>
                    </div>


                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary filter-button mt-4 p-3"
                            style="width: 100%">Filter</button>
                    </div>
                </div>
            </form>


            <hr>

            <div class="table-responsive">
                <table id="datatable" class="table-bordered border table table-striped dataTable p-0 text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $attendance->student->name }}</td>
                                <td>{{ $attendance->date }}</td>
                                <td>{{ date('l', strtotime($attendance->date)) }}</td>
                                <td class=" fw-bold {{ $attendance->status == 1 ? 'text-success' : 'text-danger' }}">
                                    {{ $attendance->status == 1 ? 'Present' : 'Absent' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

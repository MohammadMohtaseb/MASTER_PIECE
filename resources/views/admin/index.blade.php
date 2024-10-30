@extends('admin.layouts.app')
@section('title')
    Dashboard
@endsection
@push('css')
    <style>
        .card-1 {
            background-image: linear-gradient(135deg, #EE9AE5 10%, #5961F9 100%);
            font-weight: bold;
        }

        .card-2 {
            background-image: linear-gradient(135deg, #72EDF2 10%, #5151E5 100%);
        }

        .card-3 {
            background-image: linear-gradient(135deg, #52E5E7 10%, #130CB7 100%);
        }

        .card-3 {
            background-image: linear-gradient(135deg, #FEC163 10%, #DE4313 100%);
        }

        .card-4 {
            background-image: linear-gradient(135deg, #FF9D6C 10%, #BB4E75 100%);
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100 card-1">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-start">
                            <span class="text-white">
                                <i class="fa-solid fa-chalkboard-user highlight-icon"></i>
                                {{-- <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i> --}}
                            </span>
                        </div>
                        <div class="float-end text-end">
                            <p class="card-text text-white">Teachers</p>
                            <h2 class="text-white">{{ App\Models\Teacher::count() }}</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100 card-2">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-start">
                            <span class="text-white">
                                <i class="fa fa-graduation-cap highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-end text-end">
                            <p class="card-text text-white">Students</p>
                            <h2 class="text-white">{{ App\Models\Student::count() }}</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100 card-3">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-start">
                            <span class="text-white">
                                <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-end text-end">
                            <p class="card-text text-white">Parents</p>
                            <h2 class="text-white">{{ App\Models\ParentStudent::count() }}</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-20">
            <div class="card card-statistics h-100 card-4">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-start">
                            <span class="text-white">
                                <i class="fa fa-book highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-end text-end">
                            <p class="card-text text-white">Subjects</p>
                            <h2 class="text-white">{{ App\Models\Material::count() }}</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="row my-4">
        <div class="col-md-6 text-center">
            <h3> <img src="/dashboard/assets/icons/teacher.png" width="40" alt=""> Teachers </h3>
            <table class="table table-hover table-bordered bg-white">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Subjects</th>
                        <th>Stage</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach (\App\Models\Teacher::limit(5)->get() as $Teacher)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $Teacher->name }}</td>
                            <td>{{ $Teacher->material->name }}</td>
                            <td>{{ $Teacher->stage->name }}</td>

                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6"><a href="{{ route('admin.teachers.index') }}" class="text-primary">Show All
                                Teachers</a></td>
                    </tr>
                </tfoot>

            </table>
        </div>
        <div class="col-md-6 text-center">
            <h3><img src="/dashboard/assets/icons/graduated.png" width="40" alt=""> Student</h3>
            <table class="table table-hover table-bordered bg-white">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Stage</th>
                        <th>Class</th>
                        <th>Classroom</th>
                        <th>Parent</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach (\App\Models\Student::limit(5)->get() as $Student)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $Student->name }}</td>
                            <td>{{ $Student->classroom->classe->stage->name }}</td>
                            <td>{{ $Student->classroom->classe->name }}</td>
                            <td>{{ $Student->classroom->name }}</td>
                            <td>{{ $Student->parent->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6"><a href="{{ route('admin.students.index') }}" class="text-primary">Show All
                                Students</a></td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
@endsection

@extends('teacher.layouts.app')


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

        .card-5 {
            background-image: linear-gradient(135deg, #F05F57 10%, #360940 100%);
        }
    </style>
@endpush


@section('title')
    <img src="/dashboard/assets/icons/home.png" width="40" alt=""> Home || Teacher
@endsection



@section('content')
    <div class="row row-deck row-cards">

        <div class="row">


            <div class="col-md-4 ">


                <div class="card card-statistics h-100  card-1">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-start">
                                <span class="text-white">
                                    <i class="fa-solid fa-school highlight-icon"></i>
                                 </span>
                            </div>
                            <div class="float-end text-center">
                                <h5 class="card-text text-white text-uppercase"> Classrooms
                                </h5>
                                <h2 class="text-white">{{ Auth::guard('teacher')->user()->classrooms->count() }}</h2>
                            </div>
                        </div>

                    </div>
                </div>


            </div>

            <div class="col-md-4 ">


                <div class="card card-statistics h-100 bg-danger card-3">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-start ">
                                <span class="text-white">
                                    <i class="fa fa-graduation-cap highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-end text-center ">
                                <h5 class="card-text text-white text-uppercase"> Number of students
                                </h5>
                                <h2 class="text-white">{{ app('students_count_for_teacher') }}</h2>
                            </div>
                        </div>

                    </div>
                </div>


            </div>

            <div class="col-md-4">

                <div class="card card-statistics h-100 bg-dark card-5">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-start">
                                <span class="text-white">
                                    <i class="fa fa-users highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-end text-center">
                                <h5 class="card-text text-white text-uppercase"> Your own classes
                                </h5>
                                <h2 class="text-white">
                                    @foreach (Auth::guard('teacher')->user()->classrooms as $classroom)
                                        <span class="">{{ $classroom->name }}</span>
                                    @endforeach
                                </h2>
                            </div>
                        </div>

                    </div>
                </div>




            </div>

        </div>







    </div>
    <div class="row my-3">
        <div class="col-md-12">
            <h6>All Students</h6>
            <table class="table table-hover table-bordered bg-white text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Classroom</th>
                        <th>Parent</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @forelse ($my_students as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->classroom->name }}</td>
                            <td>{{ $item->parent->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">NOT FOUND ANY DATA</td>
                        </tr>
                    @endforelse
                    @if (!empty($my_students))
                        <tr>
                            <td colspan="4"><a href="#"><i class="fa-solid fa-link text-primary"></i> Show All
                                    Students</a></td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection

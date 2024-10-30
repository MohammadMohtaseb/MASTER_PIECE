@extends('student.layouts.app')

@section('title')
    Home | Student
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="card">
                <div class="card-body">
                    <img class=" rounded-2" src="/dashboard/icons/student.png" alt="">
                    <h4 class=" my-2 text-uppercase my-2">Welcome {{ Auth::guard('student')->user()->name }}</h4>
                    <h5 class=" my-2">
                        <div
                            style="    position: absolute;
    top: 74px;
    left: 10px;
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    gap: 6px;">
                            <span class=" p-2 rounded-2 card-7 text-white"><i class="fa-solid fa-envelope"></i>
                                {{ Auth::guard('student')->user()->email }}</span>
                            <span class=" p-2 rounded-2 card-7 text-white"><i class="fa-solid fa-person"></i>
                                {{ Auth::guard('student')->user()->parent->name }}</span>

                        </div>
                        <div class="my-3">
                            <div class="row">
                                <div class="col-md-4 ">


                                    <div class="card card-statistics h-100  rounded-3 card-2">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                <div class="float-start">
                                                    <span class="text-white">
                                                    </span>
                                                </div>
                                                <div class="float-end text-end">
                                                    <p class="card-text text-white"> Stage
                                                    </p>
                                                    <h4 class="text-white">
                                                        {{ Auth::guard('student')->user()->classroom->classe->stage->name }}
                                                    </h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 ">


                                    <div class="card card-statistics h-100  rounded-3 card-3">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                <div class="float-start">
                                                    <span class="text-white">
                                                    </span>
                                                </div>
                                                <div class="float-end text-end">
                                                    <p class="card-text text-white"> Class
                                                    </p>
                                                    <h4 class="text-white">
                                                        {{ Auth::guard('student')->user()->classroom->classe->name }}</h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 ">


                                    <div class="card card-statistics h-100  rounded-3 card-4">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                <div class="float-start">
                                                    <span class="text-white">

                                                    </span>
                                                </div>
                                                <div class="float-end text-end">
                                                    <p class="card-text text-white"> Classroom
                                                    </p>
                                                    <h4 class="text-white">
                                                        {{ Auth::guard('student')->user()->classroom->name }} </h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>

                            </div>


                        </div>
                    </h5>

                </div>
            </div>
        </div>
    </div>
@endsection

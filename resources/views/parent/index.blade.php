@extends('parent.layouts.app')
@section('title')
    Home Page
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="card">
                <div class="card-body">
                    <img src="/dashboard/icons/family.png" alt="">
                    <h4 class=" my-2">Welcome {{ Auth::guard('parent')->user()->name }}</h4>
                    <h5 class="fw-bold my-2">
                        <div
                            style="    position: absolute;
    top: 74px;
    left: 6px;
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    gap: 6px;">
                            <span class="p-2 rounded-2 card-3 text-white"><i class="fa-solid fa-envelope"></i>
                                {{ Auth::guard('parent')->user()->email }}</span>
                            <span class="p-2 rounded-2 card-3 text-white"><i class="fa-solid fa-heart"></i>
                            @foreach (Auth::guard('parent')->user()->student as $item)
                                ({{$item->name}}) 
                            @endforeach
                            </span>

                        </div>
                        <div class="my-3">
                            <div class="row">
                                <div class="col-md-4 ">


                                    <div class="card card-statistics h-100 card-4 rounded-3">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                <div class="float-start">
                                                    <span class="text-white">
                                                    </span>
                                                </div>
                                                <div class="float-end text-end">
                                                    <p class="card-text text-white"> Stage
                                                    </p>
                                                    <h6 class="text-white">
                                                        @foreach (Auth::guard('parent')->user()->student as $item)
                                                            {{$item->name}} ({{  $item->classroom->classe->stage->name }})
                                                            <br />
                                                            @endforeach

                                                    </h6>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 ">


                                    <div class="card card-statistics h-100 card-2 rounded-3">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                <div class="float-start">
                                                    <span class="text-white">
                                                    </span>
                                                </div>
                                                <div class="float-end text-end">
                                                    <p class="card-text text-white"> Class
                                                    </p>
                                                    <h6 class="text-white">
                                                        @foreach (Auth::guard('parent')->user()->student as $item)
                                                        {{$item->name}} ({{ $item->classroom->classe->name }})
                                                        <br />
                                                        @endforeach
                                                    </h6>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4 ">


                                    <div class="card card-statistics h-100 card-1 rounded-3">
                                        <div class="card-body">
                                            <div class="clearfix">
                                                <div class="float-start">
                                                    <span class="text-white">

                                                    </span>
                                                </div>
                                                <div class="float-end text-end">
                                                    <p class="card-text text-white"> Classroom
                                                    </p>
                                                    <h6 class="text-white">
                                                        @foreach (Auth::guard('parent')->user()->student as $item)
                                                        {{$item->name}} {{ $item->classroom->name }} 
                                                        <br />

                                                        @endforeach
                                                    </h6>
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

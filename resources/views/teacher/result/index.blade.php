@extends('teacher.layouts.app')

@section('content')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3>Result View</h3>
            <a href="{{ route('teacher.exams.index') }}" class="btn btn-dark d-none d-sm-inline-block">
              Exams
            </a>
        </div>
    </div>
    

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-ajax" class="table-bordered border table table-striped dataTable p-0 text-center">
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Degree</th>
                            <th>Type</th>
                        </tr>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($Exam->classroom->students as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->exam_result_single($item->id,$Exam->id) ? $item->exam_result_single($item->id,$Exam->id)->score : '..'}}</td>
                                    <td class="fw-bold {{$item->exam_result_single($item->id,$Exam->id) ? 'text-success' : 'text-danger'}} ">{{$item->exam_result_single($item->id,$Exam->id) ? 'Attend' : 'Absent'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

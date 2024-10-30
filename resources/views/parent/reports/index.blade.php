@extends('parent.layouts.app')




@section('content')
<div class="row my-2">
    <div class="col-12 d-flex justify-content-between">
        <h3>Reports</h3>
    </div>
</div>

    <div class="card">
        <div class="card-body">
            <table id="datatable" class="table-bordered border table table-striped dataTable p-0 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Teacher</th>
                        <th>Material</th>
                        <th>Report</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($Reports as $Item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$Item->student->name}}</td>

                            <td><a href="{{route('parent.messages.home',$Item->id)}}" class="text-primary fw-bold text-uppercase">
                                <i class="fa-brands fa-facebook-messenger"></i>
                                {{ $Item->teacher->name }}</a></td>
                            <td>{{ $Item->teacher->material->name }}</td>
                            <td>{{ $Item->report }}</td>
                            <td>
                                <a class="btn {{$Item->visible == 1 ? 'btn-primary' : 'btn-danger'}}" href="{{route('parent.reports.show',$Item->id)}}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>

                                    Show</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
    </div>
@endsection


@extends('parent.layouts.app')

@section('title')
    Report | {{$Report->title}}
@endsection
 @section('button')
<div class="col-auto ms-auto d-print-none">
  <div class="btn-list">
    <a href="{{route("parent.reports.home")}}" class="btn btn-primary d-none d-sm-inline-block" >
      Reports
    </a>
  </div>
</div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-title fw-bold text-center   "> 
               <h4><i class="fa fa-clock-o" aria-hidden="true"></i> {{$Report->created_at}}</h4>
            </div>
            <hr style="margin: 10px" />
            <div class="row">
                <div class="col">
                    <label for="">Teacher</label>
                    <input type="text" readonly  value="{{$Report->teacher->name}}" class="form-control form-control-lg">        
                </div>
                <div class="col">
                    <label for="">Material</label>
                    <input type="text" readonly   value="{{$Report->teacher->material->name}}" class="form-control form-control-lg">        
                </div>
            </div>
            <div class="form-group my-3">
                <label for="">Title</label>
                <input type="text"  readonly  value="{{$Report->title}}" class="form-control form-control-lg">    
            </div>
            <div class="form-group">
                <label for="">Report</label>
            <textarea  readonly  class="form-control form-control-lg" cols="30" rows="10">{{$Report->report}}</textarea>
            </div>
        </div>
    </div>
@endsection
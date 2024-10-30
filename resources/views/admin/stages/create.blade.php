@extends('admin.layouts.app')

@section('title')
    <div class="row ">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3> Add New Stage</h3>
            <a href="{{ route('admin.stages.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Stages
            </a>
        </div>
    </div>
@endsection
@section('content')
<div class="card">
  <div class="card-title">Add Stage</div>

  <div class="card-body">
    <form action="{{route('admin.stages.store')}}" method="POST">
      @csrf
      <div class="form-group my-2">
          <input type="text" class="form-control" name="name" placeholder="Stage name">
          @error('name')
              <div class="text-danger">{{$message}}</div>
          @enderror
      </div>
      <input type="submit" class="btn btn-success btn-lg" value="Add">
  </form>
  </div>
</div>
@endsection
@extends('admin.layouts.app')


@section('title')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3> Edit ({{ $Stage->name }})</h3>
            <a href="{{ route('admin.stages.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Stages
            </a>
        </div>
    </div>
@endsection
@section('content')
<div class="row my-2">
  <div class="col-12 d-flex justify-content-between">
      <h3>Parents</h3>
      <a href="{{ route('admin.parents.create') }}" class="btn btn-dark d-none d-sm-inline-block">
       + Add New Parent
      </a>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="card-title">Edti Stage</div>

    <div class="card-title">Update Stage</div>
    <form action="{{route('admin.stages.update',$Stage->id)}}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group my-2">
          <input type="text" value="{{$Stage->name}}" class="form-control" name="name" placeholder="Material name">
          @error('name')
              <div class="text-danger">{{$message}}</div>
          @enderror
      </div>
      <input type="submit" class="btn btn-success btn-lg" value="Update">
    </form>
  </div>
</div>
@endsection
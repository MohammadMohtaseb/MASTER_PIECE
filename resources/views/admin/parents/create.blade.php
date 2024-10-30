@extends('admin.layouts.app')

@section('title')
    <div class="row ">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3> Add New Parent</h3>
            <a href="{{ route('admin.parents.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Parents
            </a>
        </div>
    </div>
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <div class="card-title">Add New parent</div>
    <form action="{{route('admin.parents.store')}}" method="POST">
      @csrf
        <div class="row">
            <div class="col">
                <label for="">Name : </label>
                <input type="text" class="form-control" name="name" placeholder="Name">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col">
                <label for=""> Email : </label>
                <input type="email" class="form-control" name="email" placeholder="Email">
                @error('email')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
      
        <div class="row my-2">
            <div class="col">
                <label for="">Password : </label>
                <input type="password" class="form-control" name="password" placeholder="Password">
                @error('password')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col">
                <label for="">Civil number : </label>
                <input type="text" class="form-control" name="cid" placeholder="CID">
                @error('cid')
                    <div class="text-danger">{{$message}}</div>
                @enderror

            </div>
        </div>

      <input type="submit" class="btn btn-success btn-lg" value="Add">
  </form>
  </div>
</div>
@endsection
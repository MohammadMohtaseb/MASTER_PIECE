@extends('admin.layouts.app')

@section('title')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3> Edit ({{ $Parent->name }})</h3>
            <a href="{{ route('admin.materials.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Parents
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{route('admin.parents.update',$Parent->id)}}" method="POST">
      @csrf
      @method('PUT')
        <div class="row">
            <div class="col">
                <label for="">Name : </label>
                <input type="text" value="{{$Parent->name}}"   class="form-control" name="name" placeholder="Name">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col">
                <label for=""> Email : </label>
                <input type="email" value="{{$Parent->email}}"  class="form-control" name="email" placeholder="Email">
                @error('email')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
      
        <div class="row my-2">
            <div class="col">
                <label for="">Password : </label>
                <input type="password"  class="form-control" name="password" placeholder="Password">
                @error('password')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col">
                <label for="">Civil number : </label>
                <input type="text" value="{{$Parent->cid}}" class="form-control" name="cid" placeholder="CID">
                @error('cid')
                    <div class="text-danger">{{$message}}</div>
                @enderror

            </div>
        </div>

      <input type="submit" class="btn btn-success btn-lg" value="Update">
  </form>
  </div>
</div>
@endsection
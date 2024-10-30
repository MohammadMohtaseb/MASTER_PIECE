@extends('admin.layouts.app')

@section('title')
    <div class="row ">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3> Add New Class</h3>
            <a href="{{ route('admin.classes.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Classes
            </a>
        </div>
    </div>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('admin.classes.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="">Stage</label>
                    <select name="stage" class="form-control">
                        <option value="" disabled selected>Stage Name</option>
                        @foreach (\App\Models\Stage::all() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('stage')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="">Class Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Class name">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
           
        
           
           
            <input type="submit" class="btn btn-success btn-lg my-2" value="Add">
        </form>
    </div>
</div>
@endsection
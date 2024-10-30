@extends('admin.layouts.app')

@section('title')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3> Edit ({{ $Classe->name }})</h3>
            <a href="{{ route('admin.classes.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Classes
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('admin.classes.update',$Classe->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Stage</label>
                <select name="stage" class="form-control">
                    <option value="" disabled selected>Stage Name</option>
                    @foreach (\App\Models\Stage::all() as $item)
                        <option value="{{$item->id}}" @selected($item->id == $Classe->Stage->id)>{{$item->name}}</option>
                    @endforeach
                </select>
                @error('stage')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        
            <div class="form-group my-2">
                <label for="">Class Name</label>
                <input type="text" value="{{$Classe->name}}" class="form-control" name="name" placeholder="Class name">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
           
            <input type="submit" class="my-2 btn btn btn-success btn-lg" value="Update">
        </form>
    </div>
</div>
@endsection
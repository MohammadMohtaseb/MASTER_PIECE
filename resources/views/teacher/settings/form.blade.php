@extends('teacher.layouts.app')

@section('title')
<img src="/dashboard/assets/icons/settings.png" width="40" alt="">  Setting 
@endsection


@section('content')
   <div class="card">
    <div class="card-body">
        <h2>Form Update Data</h2>
        <form action="{{route('teacher.settings.form.setting.submit')}}" method="POST">
            @csrf
            <div class="form-group">
                <input name="name" type="text" value="{{Auth::guard('teacher')->user()->name}}" class="form-control" placeholder="Name">     
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group my-2">
                <input name="email" type="text"  value="{{Auth::guard('teacher')->user()->email}}" class="form-control" placeholder="Email">     
                @error('email')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <input name="password" type="text" class="form-control" placeholder="Password">     
            </div>

            <div class="form-group my-2">
                <input type="submit" class="btn btn-success" value="Update">
            </div>
        </form>
    </div>
   </div>
@endsection
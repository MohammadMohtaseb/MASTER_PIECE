@extends('admin.layouts.app')



@section('content')
<div class="row my-2">
    <div class="col-12 d-flex justify-content-between">
        <h3>Settings</h3>
        
    </div>
</div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">Form Update Data</div>
            <form action="{{ route('admin.settings.form.setting.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input name="name" type="text" value="{{ Auth::guard('admin')->user()->name }}" class="form-control"
                        placeholder="Name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-2">
                    <input name="email" type="text" value="{{ Auth::guard('admin')->user()->email }}"
                        class="form-control" placeholder="Email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
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

@extends('admin.layouts.app')

@section('title')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3> Edit ({{ $Material->name }})</h3>
            <a href="{{ route('admin.materials.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                Subjects
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
          <div class="card-title">Update Subject</div>
            <form action="{{ route('admin.materials.update', $Material->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group my-2">
                    <input type="text" value="{{ $Material->name }}" class="form-control form-control-lg" name="name"
                        placeholder="Material name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <input type="submit" class="btn btn-success btn-lg" value="Update">
            </form>
        </div>
    </div>
@endsection

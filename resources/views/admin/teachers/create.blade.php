@extends('admin.layouts.app')
@section('title')
    <div class="row ">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3> Add New Teacher</h3>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Teachers
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-title">Add Teacher</div>

            <form action="{{ route('admin.teachers.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="">Name : </label>
                        <input type="text" value="{{ old('name') }}" placeholder="Name" name="name"
                            class="form-control">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">Email : </label>
                        <input type="email" value="{{ old('email') }}" placeholder="Email" name="email"
                            class="form-control">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col">
                        <label for="">Password : </label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">Birth Date : </label>
                        <input type="date" value="{{ old('date') }}" name="date" class="form-control">
                        @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col">
                        <label for="">Gender : </label>
                        <select name="gender" class="form-control">
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="">Subject : </label>
                        <select name="material" class="form-control">
                            @foreach (\App\Models\Material::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Stage : </label>
                        <select name="stage" id="stage" class="form-control">
                            <option selected disabled>Stage Name</option>
                            @foreach (\App\Models\Stage::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('stage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">Class : </label>
                        <select  name="class" id="class" class="form-control">
                        </select>
                        @error('class')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">Classroom : </label>
                        <select name="classroom[]" name="classroom" id="classroom" class="form-control" multiple>
                        </select>
                        @error('classroom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <input type="submit" class="my-1 btn btn-success btn-lg" value="Add">
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#stage').on('change', function() {
                var stageId = $(this).val();
                if (stageId) {
                    $.ajax({
                        url: '/admin/get-classes/' + stageId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#class').empty();
                            $('#class').append(
                                '<option selected disabled>Select Class</option>');
                            $.each(data.classes, function(key, value) {
                                $('#class').append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#class').empty();
                    $('#classroom').empty();
                }
            });

            $('#class').on('change', function() {
                var classId = $(this).val();
                if (classId) {
                    $.ajax({
                        url: '/admin/get-classroom/' + classId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#classroom').empty();
                            $('#classroom').append(
                                '<option selected disabled>Select Classroom</option>');
                            $.each(data, function(key, value) {
                                $('#classroom').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#classroom').empty();
                }
            });
        });
    </script>
@endpush

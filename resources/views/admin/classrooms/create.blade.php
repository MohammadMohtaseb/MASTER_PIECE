@extends('admin.layouts.app')

@section('title')
    <div class="row ">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3> Add New Classroom</h3>
            <a href="{{ route('admin.classrooms.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Classrooms
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.classrooms.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Classroom name</label>
                    <input type="text" class="form-control" placeholder="Name Class Room" name="name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="">Stage</label>
                        <select name="stage" class="form-control">
                            <option selected disabled>Stage Name</option>
                            @foreach (\App\Models\Stage::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('stage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div name="class" class="col">
                        <label for="">Class</label>
                        <select name="class" class="form-control">
                        </select>
                        @error('class')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <input type="submit" class="btn btn-success btn-lg" value="Add">
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('select[name="stage"]').on('change', function() {
                var stageID = $(this).val();
                if (stageID) {
                    $.ajax({
                        url: '/admin/get-classes/' + stageID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="class"]').empty();
                            $.each(data.classes, function(key, value) {
                                $('select[name="class"]').append('<option value="' +
                                    value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="class"]').empty();
                }
            });
        });
    </script>
@endpush

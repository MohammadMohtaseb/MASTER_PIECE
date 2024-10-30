@extends('teacher.layouts.app')


@section('title')
    <div class="row ">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3> Add New File</h3>
            <a href="{{ route('teacher.filemanger.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                File Manger
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card  p-2">
                <div class="card-title">Add New File</div>
                <div class="card-body">
                    <form action="{{ route('teacher.filemanger.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="">TITLE</label>
                                <input type="text" name="title" class="form-control">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="col">
                                <label for="">FILE</label>
                                <input type="file" name="file" class="form-control">
                                @error('descrption')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Descrption</label>
                                <textarea name="descrption" id="" cols="30" rows="10" class="form-control"></textarea>
                                @error('descrption')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <input type="submit" class="btn btn-success btn-lg my-2" value="Add">
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

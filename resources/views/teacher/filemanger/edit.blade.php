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
                    <form action="{{ route('teacher.filemanger.update',$Filemanger->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label for="">TITLE</label>
                                <input type="text" value="{{$Filemanger->title}}" name="title" class="form-control">

                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="col">
                                <label for="">FILE</label>
                                <input type="file" name="file" class="form-control">
                                <p><i class="fa-solid fa-file"></i> {{ number_format($Filemanger->file_size / 1024, 2) }} KB</p>

                                @error('descrption')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Descrption</label>
                                <textarea name="descrption" id="" cols="30" rows="10" class="form-control">{{$Filemanger->descrption}}</textarea>
                                @error('descrption')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <input type="submit" class="btn btn-success btn-lg my-2" value="Update">
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

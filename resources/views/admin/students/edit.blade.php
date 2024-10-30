@extends('admin.layouts.app')

@section('title')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3> Edit ({{ $Student->name }})</h3>
            <a href="{{ route('admin.students.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Students
            </a>
        </div>
    </div>
@endsection
@section('content')
<div class="card">

  <div class="card-body">
    <form action="{{route('admin.students.update',$Student->id)}}" method="POST">
      @csrf
      @method('PUT')
        <div class="row">
            <div class="col">
                <label for="">Name : </label>
                <input type="text" value="{{$Student->name}}" class="form-control" name="name" placeholder="Name">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col">
                <label for=""> Email : </label>
                <input type="email" value="{{$Student->email}}"   class="form-control" name="email" placeholder="Email">
                @error('email')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
      
        <div class="row my-2">
            <div class="col">
                <label for="">Password : </label>
                <input type="password" class="form-control" name="password" placeholder="Password">
                @error('password')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col">
                <label for="">Parent</label>
                <select name="parent" class="form-control">
                    @foreach (\App\Models\ParentStudent::all() as $item)
                        <option value="{{$item->id}}" @selected($item->id == $Student->parent->id)>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
          
        </div>

        <div class="row">
            <div class="col">
                <label for="">Gender</label>
                <select name="gender" class="form-control">
                    <option value="1" @selected($Student->gender == 1)>Male</option>
                    <option value="0" @selected($Student->gender == 0)>Female</option>
                </select>
            </div>
        </div>
        
        <div class="row my-2">
            <div class="col">
                <label for="">Stage : </label>
                <select name="stage" id="stage" class="form-control">
                    <option selected disabled>Stage Name</option>
                    @foreach (\App\Models\Stage::all() as $item)
                    <option value="{{ $item->id }}" @selected($Student->classroom->classe->stage->id == $item->id)>{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('stage')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="">Class : </label>
                <select name="class" id="class" class="form-control" data-selected="{{$Student->classroom->classe->id}}">
                    @foreach (\App\Models\Classe::where('stage_id',$Student->classroom->classe->stage->id)->get() as $item)
                        <option value="{{$item->id}}" @selected($Student->classroom->classe->id == $item->id)>{{$item->name}}</option>
                    @endforeach
                </select>
                @error('class')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="">Classroom :  </label>
                <select name="classroom" id="classroom" class="form-control" data-selected="{{$Student->classroom->id }}">
                    
                    @foreach (\App\Models\Classroom::where('classe_id',$Student->classroom->classe->id)->get() as $item)
                        <option value="{{$item->id}}" @selected($Student->classroom->id == $item->id)>{{$item->name}}</option>
                    @endforeach
                </select>
                @error('classroom')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

      <input type="submit" class="btn btn-success btn-lg" value="Update">
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
                            var selectedClassId = $('select[name="class"]').data('selected');


                            $('#class').empty();
                            $('#classroom').empty();

                            $('#class').append(
                                '<option selected disabled>Select Class</option>');
                            $.each(data.classes, function(key, value) {
                                var isSelected = (value.id == selectedClassId) ? 'selected' : '';
                                $('select[name="class"]').append('<option value="' + value.id + '" ' + isSelected + '>' + value.name + '</option>');

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
                            var selectedClassId = $("#classroom").data('selected');

                            $('#classroom').empty();
                            $('#classroom').append(
                                '<option selected disabled>Select Classroom</option>');
                            $.each(data, function(key, value) {
                                var isSelected = (value.id == selectedClassId) ? 'selected' : '';

                                $('#classroom').append('<option value="' + value.id + '" ' + isSelected + '>' + value.name + '</option>');
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

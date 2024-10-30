    @extends('admin.layouts.app')
    @section('title')
        <div class="row my-2">
            <div class="col-12 d-flex justify-content-between">
                <h3> Edit ({{ $teacher->name }})</h3>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                    Teachers
                </a>
            </div>
        </div>
    @endsection


    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="card-title">Edti Teacher</div>
                <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="">Name : </label>
                            <input type="text" value="{{ $teacher->name }}" placeholder="Name" name="name"
                                class="form-control">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="">Email : </label>
                            <input type="email" value="{{ $teacher->email }}" placeholder="Email" name="email"
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
                            <input type="date" value="{{ $teacher->birthdate }}" name="date" class="form-control">
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col">
                            <label for="">Gender : </label>
                            <select name="gender" class="form-control">
                                <option value="1" @selected($teacher->gender == 1)>Male</option>
                                <option value="0" @selected($teacher->gender == 0)>Female</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="">Subject : </label>
                            <select name="material" class="form-control">
                                @foreach (\App\Models\Material::all() as $item)
                                    <option @selected($teacher->material->id == $item->id) value="{{ $item->id }}">{{ $item->name }}
                                    </option>
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
                                    <option value="{{ $item->id }}" @selected($teacher->stage->id == $item->id)>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('stage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="">Class : </label>
                            <select name="class" id="class" class="form-control"
                                data-selected="{{ $teacher->classe->id }}">
                                @foreach (\App\Models\Classe::where('stage_id', $teacher->stage->id)->get() as $item)
                                    <option value="{{ $item->id }}" @selected($teacher->classe->id == $item->id)>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="">Classroom : </label>
                            <select name="classrooms[]" id="classroom" class="form-control" multiple>
                                @foreach (\App\Models\Classroom::where('classe_id', $teacher->classrooms->first()->classe->id)->get() as $item)
                                    <option value="{{ $item->id }}" @if ($teacher->classrooms->contains($item->id)) selected @endif>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('classrooms')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success btn-lg" value="Update">

            </div>
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
                                    var isSelected = (value.id == selectedClassId) ?
                                        'selected' : '';
                                    $('select[name="class"]').append('<option value="' +
                                        value.id + '" ' + isSelected + '>' + value
                                        .name + '</option>');

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
                                    var isSelected = (value.id == selectedClassId) ?
                                        'selected' : '';

                                    $('#classroom').append('<option value="' + value.id +
                                        '" ' + isSelected + '>' + value.name +
                                        '</option>');
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

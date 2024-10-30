@extends('admin.layouts.app')

@section('title')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3> Edit ({{ $classroom->name }})</h3>
            <a href="{{ route('admin.classrooms.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                 Classrooms
            </a>
        </div>
    </div>
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.classrooms.update',$classroom->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="text" value="{{ $classroom->name }}" class="form-control" placeholder="Name Class Room"
                        name="name">
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
                                <option value="{{ $item->id }}" @selected($item->id == $classroom->classe->stage->id)>{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('stage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div name="class" class="col">
                        <label for="">Class</label>
                        <select name="class" class="form-control" data-selected="{{ $classroom->classe->id ?? '' }}">
                            @foreach (\App\Models\Classe::where('stage_id', $classroom->classe->stage->id)->get() as $item)
                                <option value="{{ $item->id }}" @selected($item->id == $classroom->classe->id)>{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <input type="submit" class="my-2 btn btn btn-success btn-lg" value="Update">
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
                // Assuming you pass the selected class ID through data-* attribute or another way
                var selectedClassId = $('select[name="class"]').data('selected');
                
                $.ajax({
                    url: '/admin/get-classes/' + stageID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="class"]').empty();
                        $.each(data.classes, function(key, value) {
                        
                            var isSelected = (value.id == selectedClassId) ? 'selected' : '';
                            $('select[name="class"]').append('<option value="' + value.id + '" ' + isSelected + '>' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="class"]').empty();
            }
        });

        // Trigger change event on page load to auto-select class if a stage is already selected
        // $('select[name="stage"]').trigger('change');
    });
    </script>
@endpush

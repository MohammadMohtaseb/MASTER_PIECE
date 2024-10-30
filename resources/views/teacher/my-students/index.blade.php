@extends('teacher.layouts.app')

@section('content')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3>My Students</h3>

        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <h6 class="card-title text-uppercase">my students</h6>
            <div class="col-12 mb-4">
                <select id="filter" class="form-control">
                    <option value="">Select the classroom</option>
                    @foreach (Auth::guard('teacher')->user()->classrooms as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <table id="datatable-ajax" class="table-bordered border table table-striped dataTable p-0 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Classroom</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection


@push('js')
    <script>
        // Initialize DataTables
        var table = $('#datatable-ajax').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('teacher.my-students.index') }}",
                data: function(d) {
                    d.filter = $('#filter').val(); // Send the filter value
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'parent',
                    name: 'parent'
                },
                {
                    data: 'classroom',
                    name: 'classroom'
                },



            ]
        });

        // Redraw the table when the filter changes
        $('#filter').change(function() {
            table.draw();
        });
    </script>
@endpush

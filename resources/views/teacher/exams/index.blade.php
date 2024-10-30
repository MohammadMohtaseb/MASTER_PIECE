@extends('teacher.layouts.app')



@section('content')
<div class="row my-2">
    <div class="col-12 d-flex justify-content-between">
        <h3>Exams</h3>
        <a href="{{ route('teacher.exams.create') }}" class="btn btn-dark d-none d-sm-inline-block">
            + Add New Exam
        </a>
    </div>
</div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">All Exams</h5>

            <form method="GET" id="filter-form">
                <div class="row mb-3">
                    <div class="col-md-12 p-2">
                        <select name="filter" id="filter" class="form-select">
                            <option value="">All Exams</option>
                            <option value="active">Active Exams (Not Ended)</option>
                            <option value="ended">Ended Exams</option>
                        </select>
                    </div>
                </div>
            </form>

            <table id="datatable-ajax" class="table-bordered border table table-striped dataTable p-0 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Date Start Exam</th>
                        <th>Date Result Exam</th>
                        <th>Difference of days</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            $(document).on('click','.btn-delete',function(e) {
                e.preventDefault();

                // Get the material id from a data attribute or similar
                var row = $(this).closest('tr'); // Get the row for future removal
                var materialId = row.find('.btn-delete').data(
                'id'); // Assuming you store the ID in a data attribute

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request to delete the material
                        $.ajax({
                            url: '/teacher/exams/' + materialId, // Adjust the route to your delete route
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}", // Laravel CSRF protection
                            },
                            success: function(response) {
                                // Handle the success response, like removing the row from the table
                                Swal.fire(
                                    'Deleted!',
                                    'The material has been deleted.',
                                    'success'
                                )
                                row.remove(); // Remove the row from the table
                            },
                            error: function(error) {
                                console.log(error);
                                // Handle any error
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the material.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });


            // Initialize DataTables
            var table = $('#datatable-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('teacher.exams.index') }}",
                    data: function(d) {
                        d.filter = $('#filter').val();  // Send the filter value
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'start_exam', name: 'start_exam' },
                    { data: 'result_exam', name: 'result_exam' },
                    { data: 'days_difference', name: 'days_difference', orderable: false, searchable: false },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });

            // Redraw the table when the filter changes
            $('#filter').change(function() {
                table.draw();
            });
        });
    </script>
@endpush

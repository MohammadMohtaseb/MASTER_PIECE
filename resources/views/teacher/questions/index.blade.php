@extends('teacher.layouts.app')



@section('content')
    <div class="row my-2">
        <div class="col-12 d-flex justify-content-between">
            <h3>Exam || {{ $Exam->title }} </h3>
            <div>
                <a href="{{ route('teacher.exams.index') }}" class="btn btn-dark d-none d-sm-inline-block">
                    Exams
                </a>
                @if ($Exam->start_exam <= date('Y-m-d'))
                    <a href="{{ route('teacher.questions.create', $Exam->id) }}"
                        class="btn btn-primary d-none d-sm-inline-block">
                        + Add Question
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="datatable" class="table-bordered border table table-striped dataTable p-0 text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>TITLE</th>
                        <th>A 1</th>
                        <th>A 2</th>
                        <th>A 3</th>
                        <th>A 4</th>
                        <th>The correct answer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                @foreach ($Questions as $item)
                    <tbody>
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->answer1 }}</td>
                            <td>{{ $item->answer2 }}</td>
                            <td>{{ $item->answer3 }}</td>
                            <td>{{ $item->answer4 }}</td>
                            <td><span class="badge bg-success">{{ $item->answer_true }}</span></td>

                            <td>
                                <a href="{{ route('teacher.questions.edit', $item->id) }}"
                                    class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a href="#" data-id="{{ $item->id }}" class="btn btn-danger btn-sm btn-delete"><i
                                        class="fa fa-trash" aria-hidden="true"></i> </a>

                            </td>

                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Handle the delete button click
            $('.btn-delete').click(function(e) {
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
                            url: '/teacher/questions/' +
                                materialId, // Adjust the route to your delete route
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
        });
    </script>
@endpush

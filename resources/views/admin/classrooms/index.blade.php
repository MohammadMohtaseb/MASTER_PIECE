@extends('admin.layouts.app')



@section('content')
<div class="row my-2">
    <div class="col-12 d-flex justify-content-between">
        <h3>Classrooms</h3>
        <a href="{{ route('admin.classrooms.create') }}" class="btn btn-dark d-none d-sm-inline-block">
         + Add New Classroom
        </a>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <h5 class="card-title">All Classrooms</h5>

        <table  id="datatable" class="table-bordered border table table-striped dataTable p-0 text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Stage</th>
                    <th>Classe</th>
                    <th>Action</th>
                </tr>
            </thead>
        
            <tbody>
                @php
                  $i = 1;
                @endphp
                @foreach ($classrooms as $item)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->classe->stage->name}}</td>
                  <td>{{$item->classe->name}}</td>
                  <td>
                    <a href="{{route('admin.classrooms.edit',$item->id)}}" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>                        </a>
                    <a href="#" data-id="{{$item->id}}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash" aria-hidden="true"></i>       </a>
                   
                  </td>
                </tr>
               
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        // Handle the delete button click
        $('.btn-delete').click(function (e) {
            e.preventDefault();
            
            // Get the material id from a data attribute or similar
            var row = $(this).closest('tr'); // Get the row for future removal
            var materialId = row.find('.btn-delete').data('id'); // Assuming you store the ID in a data attribute
            
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
                        url: '/admin/classrooms/' + materialId, // Adjust the route to your delete route
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}", // Laravel CSRF protection
                        },
                        success: function (response) {
                            // Handle the success response, like removing the row from the table
                            Swal.fire(
                                'Deleted!',
                                'The material has been deleted.',
                                'success'
                            )
                            row.remove(); // Remove the row from the table
                        },
                        error: function (error) {
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



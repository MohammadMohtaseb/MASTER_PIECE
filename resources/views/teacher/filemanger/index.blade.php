@extends('teacher.layouts.app')
@section('title')
    <h4 class="text-uppercase"><i class="fa-solid fa-file-pdf"></i> File Manger</h4>
@endsection
@push('css')
    <style>
        a:hover, a:active{
            color:#fff;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="d-block d-sm-flex justify-content-between">
                        <div class="d-block">
                            <h4 class="pt-2 pb-2 text-uppercase">My files</h4>
                        </div>
                        <div class="d-flex">
                            <a class="button icon black" href="{{ route('teacher.filemanger.create') }}"> Upload Files <i
                                    class="fa fa-upload"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($files as $item)
            <div class="col-xl-3 col-lg-6 col-sm-6 mb-20">

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="file-box">
                            @if (pathinfo($item->file, PATHINFO_EXTENSION) == 'pdf')
                            <img class="img-fluid mb-20" src="/dashboard/images/file-icon/PDF.png" alt="">

                                @else
                                <img class="img-fluid mb-20" src="/dashboard/images/file-icon/TXT.png" alt="">
                            @endif
                            <div class="d-block d-md-flex justify-content-between">
                                <div class="d-block">
                                    <h6><b>{{ $item->title }}</b></h6>
                                    <p>{{ number_format($item->file_size / 1024, 2) }} KB</p>
                                 
                                </div>
                                <div class="d-block d-md-flex">
                                    <a href="{{ Storage::url($item->file) }}" download>
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <a href="#" class="badge bg-danger btn-delete"  data-id="{{$item->id}}"><i  class="fa-solid fa-trash"></i></a>
                            <a href="{{route('teacher.filemanger.edit',$item->id)}}" class="badge bg-success "><i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </div>
                </div>
              
            </div>
        @empty
        <div class="alert alert-warning  text-center fw-bold"><i class="fa-solid fa-circle-info"></i> There is no data available at the moment</div>
        @endforelse
    </div>
@endsection

@push('js')
    <script>
        
            // Handle the delete button click
            $(document).on("click",'.btn-delete',function(e) {
                e.preventDefault();

                // Get the material id from a data attribute or similar
                var card = $(this).closest('.col-xl-3'); // Get the parent column containing the card
                var materialId = $(this).data("id"); // Assuming you store the ID in a data attribute
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
                            url: '/teacher/filemanger/' +
                            materialId, // Adjust the route to your delete route
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}", // Laravel CSRF protection
                            },
                            success: function(response) {
                                console.log(response);

                                // Handle the success response, like removing the row from the table
                                Swal.fire(
                                    'Deleted!',
                                    'The material has been deleted.',
                                    'success'
                                )
                                card.remove(); // Remove the row from the table
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
  
    </script>
@endpush


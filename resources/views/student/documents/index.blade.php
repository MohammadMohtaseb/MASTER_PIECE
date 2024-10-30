@extends('student.layouts.app')

@section('content')
<div class="row">
    <div class="col mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="d-block d-sm-flex justify-content-between">
                    <div class="d-block">
                        <h4 class="pt-2 pb-2 text-uppercase"><i class="fa-solid fa-folder-plus"></i> My documents</h4>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @forelse ($my_documents as $item)
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
                                <p> Mr : {{$item->teacher->name}}</p>
                             
                            </div>
                            <div class="d-block d-md-flex">
                                <a href="{{ Storage::url($item->file) }}" download>
                                    <i class="fa fa-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <p>
                        {{$item->descrption}}
                    </p>
                </div>
            </div>
          
        </div>
    @empty
    <div class="alert alert-warning  text-center fw-bold"><i class="fa-solid fa-circle-info"></i> There is no data available at the moment</div>
    @endforelse
</div>
@endsection
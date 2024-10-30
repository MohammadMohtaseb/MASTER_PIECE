  <!-- Left Sidebar start-->
  <div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
           
            
            <li class="nav-item {{ Route::is('parent.home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('parent.home') }}">
                    <i class="ti-comments"></i>

                    <span class="nav-link-title">
                        Home
                    </span>
                </a>
            </li>


            <li class="nav-item {{ Route::is('parent.exams.home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('parent.exams.home') }}">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>

                    <span class="nav-link-title">
                        Result
                    </span>
                </a>
            </li>

      

            <li class="nav-item {{ Route::is('parent.reports.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('parent.reports.home') }}">
                    <i class="fa fa-commenting" aria-hidden="true"></i>
                    <?php 
                    $MyStudents = Auth::guard('parent')->user()->student->pluck('id');
                    $Reports = \App\Models\Report::whereIn('student_id',$MyStudents)
                    ->where('visible',0)
                    ->count();
                    ?>
                    <span class="nav-link-title">
                        Reports 
                        @if ($Reports > 0)
                        <span class="badge bg-success">{{$Reports}}</span>

                        @endif
                   
                    </span>
                </a>
            </li>


            <li class="nav-item {{ Route::is('parent.attendances.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('parent.attendances.home') }}">
                    <i class="fa fa-file" aria-hidden="true"></i>

                    <span class="nav-link-title">
                        Attendances
                    </span>
                </a>
            </li>
            
          





        </ul>
    </div>
</div>
<!-- Left Sidebar End-->

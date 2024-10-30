  <!-- Left Sidebar start-->
  <div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
           
            <li class="nav-item {{ Route::is('student.home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('student.home') }}">
                    <i class="ti-comments"></i>
                    <span class="nav-link-title">
                        Home
                    </span>
                </a>
            </li>
            

            <li class="nav-item {{ Route::is('student.exams.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('student.exams.home') }}">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>

                    <span class="nav-link-title">
                        Exams
                    </span>
                </a>
            </li>

            <li class="nav-item {{ Route::is('student.documents') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('student.documents') }}">
                    <i class="fa-solid fa-folder-plus"></i>

                    <span class="nav-link-title">
                        Documents
                    </span>
                </a>
            </li>


          





        </ul>
    </div>
</div>
<!-- Left Sidebar End-->

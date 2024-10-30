<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar">
        <div class="container-xl">
          <ul class="navbar-nav">
            <li class="nav-item {{Route::is("admin.home") ? 'active' : ''}}">
              <a class="nav-link" href="{{route('admin.home')}}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                  Home
                </span>
              </a>
            </li>

            <li class="nav-item {{Route::is("admin.materials.*") ? 'active' : ''}}">
              <a class="nav-link" href="{{route('admin.materials.index')}}" >
            
                <span class="nav-link-title">
                  Materials
                </span>
              </a>
            </li>


            <li class="nav-item {{Route::is("admin.stages.*") ? 'active' : ''}}">
              <a class="nav-link" href="{{route('admin.stages.index')}}" >
            
                <span class="nav-link-title">
                  Stages
                </span>
              </a>
            </li>

            <li class="nav-item {{Route::is("admin.classes.*") ? 'active' : ''}}">
              <a class="nav-link" href="{{route('admin.classes.index')}}" >
            
                <span class="nav-link-title">
                  Classes
                </span>
              </a>
            </li>

            <li class="nav-item {{Route::is("admin.classrooms.*") ? 'active' : ''}}">
              <a class="nav-link" href="{{route('admin.classrooms.index')}}" >
            
                <span class="nav-link-title">
                  Classrooms
                </span>
              </a>
            </li>
            
            
            <li class="nav-item {{Route::is("admin.teachers.*") ? 'active' : ''}}">
              <a class="nav-link" href="{{route('admin.teachers.index')}}" >
            
                <span class="nav-link-title">
                  Teachers
                </span>
              </a>
            </li>

            <li class="nav-item {{Route::is("admin.parents.*") ? 'active' : ''}}">
              <a class="nav-link" href="{{route('admin.parents.index')}}" >
            
                <span class="nav-link-title">
                  Parents
                </span>
              </a>
            </li>

            <li class="nav-item {{Route::is("admin.students.*") ? 'active' : ''}}">
              <a class="nav-link" href="{{route('admin.students.index')}}" >
            
                <span class="nav-link-title">
                  Students
                </span>
              </a>
            </li>
            
          
          </ul>
          <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
            <form action="./" method="get" autocomplete="off" novalidate>
              <div class="input-icon">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                </span>
                <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>
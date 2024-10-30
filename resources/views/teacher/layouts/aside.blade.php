  <!-- Left Sidebar start-->
  <div class="side-menu-fixed">
      <div class="scrollbar side-menu-bg">
          <ul class="nav navbar-nav side-menu" id="sidebarnav">
              <!-- menu item Dashboard-->
              <li class="nav-item {{ Route::is('teacher.home') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('teacher.home') }}">
                      <i class="ti-comments"></i><span class="right-nav-text">Home
                      </span></a>
              </li>

              <li
                  class="nav-item {{ Route::is('teacher.exams.*') || Route::is('teacher.questions.*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('teacher.exams.index') }}">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>

                      <span>
                          Exams
                      </span>
                  </a>
              </li>




              <li class="nav-item {{ Route::is('teacher.reports.*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('teacher.reports.index') }}">
                      <i class="fa fa-commenting" aria-hidden="true"></i>

                      <span class="nav-link-title">
                          Reports
                      </span>
                  </a>
              </li>

              <li class="nav-item {{ Route::is('teacher.attendances.*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('teacher.attendances.index') }}">
                      <i class="fa fa-address-card-o" aria-hidden="true"></i>

                      <span class="nav-link-title">
                          Attendances
                      </span>
                  </a>
              </li>

              <li class="nav-item {{ Route::is('teacher.filemanger.*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('teacher.filemanger.index') }}">
                      <i class="fa-solid fa-file-pdf"></i>
                      <span class="nav-link-title">
                          File Manger
                      </span>
                  </a>
              </li>

              <li class="nav-item {{ Route::is('teacher.my-students.index') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('teacher.my-students.index') }}">
                      <i class="fa-solid fa-user-graduate"></i>
                       <span class="nav-link-title">
                          My Students
                      </span>
                  </a>
              </li>






          </ul>
      </div>
  </div>
  <!-- Left Sidebar End-->

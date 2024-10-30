  <!-- Left Sidebar start-->
  <div class="side-menu-fixed">
      <div class="scrollbar side-menu-bg">
          <ul class="nav navbar-nav side-menu" id="sidebarnav">
              <!-- menu item Dashboard-->
              <li class="{{ Route::is('admin.home') ? 'active' : '' }}">
                  <a href="{{ route('admin.home') }}"><i class="ti-comments"></i><span class="right-nav-text">Home
                      </span></a>
              </li>

              <li class="{{ Route::is('admin.materials.*') ? 'active' : '' }}">
                  <a href="{{ route('admin.materials.index') }}"><i class="fa fa-book" aria-hidden="true"></i><span
                          class="right-nav-text">Subjects </span></a>
              </li>

              <li class="{{ Route::is('admin.stages.*') ? 'active' : '' }}">
                  <a href="{{ route('admin.stages.index') }}"><i class="fa fa-sitemap" aria-hidden="true"></i> <span
                          class="right-nav-text">Stages </span></a>
              </li>

              <li class=" {{ Route::is('admin.classes.*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('admin.classes.index') }}">
                      <i class="fa fa-users" aria-hidden="true"></i>
                      <span>
                          Classes
                      </span>
                  </a>
              </li>


              <li class="nav-item {{ Route::is('admin.classrooms.*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('admin.classrooms.index') }}">
                      <i class="fa fa-registered" aria-hidden="true"></i>
                      <span>
                          Classrooms
                      </span>
                  </a>
              </li>


              <li class="nav-item {{ Route::is('admin.teachers.*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('admin.teachers.index') }}">
                      <i class="fa fa-user-circle-o" aria-hidden="true"></i>

                      <span>
                          Teachers
                      </span>
                  </a>
              </li>

              <li class="nav-item {{ Route::is('admin.parents.*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('admin.parents.index') }}">
                      <i class="fa fa-address-card" aria-hidden="true"></i>
                      <span>
                          Parents
                      </span>
                  </a>
              </li>

              <li class="nav-item {{ Route::is('admin.students.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.students.index') }}">
                  <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                  <span >
                        Students
                    </span>
                </a>
            </li>


          </ul>
      </div>
  </div>
  <!-- Left Sidebar End-->

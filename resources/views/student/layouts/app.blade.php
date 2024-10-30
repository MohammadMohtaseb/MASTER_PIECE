<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.potenzaglobalsolutions.com/html/webmin-bootstrap-4-angular-12-admin-dashboard-template/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Oct 2024 16:20:03 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 5 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Dashboard || Student</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/dashboard/images/favicon.ico" />

    <!-- Font -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/dashboard/css/style.css" />
    <link href="/dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');

        body {
            font-family: "DM Sans", sans-serif;

        }

        .side-menu-fixed .side-menu li a {
            font-size: 16px;
        }

        .min-height {
            min-height: 690px;
        }

        table {
            font-size: 16px;
            font-family: "DM Sans", sans-serif;
        }
        table tr th{
          text-align: center !important;
          background: #282a39 !important;
          color:#fff;
        }

        input,select:not(.custom-select) {
            font-size: 20px !important;
        }
        
        input[type="checkbox"] {
  appearance: none;
  -webkit-appearance: none;
  display: flex;
  align-content: center;
  justify-content: center;
  font-size: 2rem;
  padding: 0.1rem;
  border: 0.25rem solid green;
  border-radius: 0.5rem;
}
input[type="checkbox"]::before {
  content: "";
  width: 1.4rem;
  height: 1.4rem;
  clip-path: polygon(20% 0%, 0% 20%, 30% 50%, 0% 80%, 20% 100%, 50% 70%, 80% 100%, 100% 80%, 70% 50%, 100% 20%, 80% 0%, 50% 30%);
  transform: scale(0);
  background-color: green;
}
input[type="checkbox"]:checked::before {
  transform: scale(1);
}

.card-1 {
            background-image: linear-gradient(135deg, #EE9AE5 10%, #5961F9 100%);
            font-weight: bold;
        }

        .card-2 {
            background-image: linear-gradient(135deg, #72EDF2 10%, #5151E5 100%);
        }

        .card-3 {
            background-image: linear-gradient(135deg, #52E5E7 10%, #130CB7 100%);
        }

        .card-3 {
            background-image: linear-gradient(135deg, #FEC163 10%, #DE4313 100%);
        }

        .card-4 {
            background-image: linear-gradient(135deg, #FF9D6C 10%, #BB4E75 100%);
        }

        .card-5 {
            background-image: linear-gradient(135deg, #F05F57 10%, #360940 100%);
        }
        .card-6{
            background-image: linear-gradient( 135deg, #ABDCFF 10%, #0396FF 100%);
        }
        .card-7{
            background-image: linear-gradient( 135deg, #CE9FFC 10%, #7367F0 100%);              
          }
    </style>
    @stack('css')

</head>

<body>

    <div class="wrapper">

        <!--=================================
    preloader -->
        {{-- <div id="pre-loader">
      <img src="/dashboard/images/pre-loader/loader-01.svg" alt="">
    </div> --}}
        <!--=================================
    preloader -->

        <!--=================================
    header start-->

        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-start navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="index.html"><img src="/dashboard/images/logo.png"
                        alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img
                        src="/dashboard/images/logo.png" alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav me-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>
                <li class="nav-item">
                    <div class="search">
                        <a class="search-btn not_click" href="javascript:void(0);"></a>
                        <div class="search-box not-click">
                            <input type="text" class="not-click form-control" placeholder="Search" value=""
                                name="search">
                            <button class="search-button btn" type="submit"> <i
                                    class="fa fa-search not-click"></i></button>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ms-auto">
                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="ti-bell"></i>
                        <span class="badge bg-danger notification-status"> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                        <div class="dropdown-header notifications">
                            <strong>Notifications</strong>
                            <span class="badge bg-warning">05</span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">New registered user <small
                                class="float-end text-muted time">Just now</small> </a>
                        <a href="#" class="dropdown-item">New invoice received <small
                                class="float-end text-muted time">22 mins</small> </a>
                        <a href="#" class="dropdown-item">Server error report<small
                                class="float-end text-muted time">7 hrs</small> </a>
                        <a href="#" class="dropdown-item">Database report<small
                                class="float-end text-muted time">1 days</small> </a>
                        <a href="#" class="dropdown-item">Order confirmation<small
                                class="float-end text-muted time">2 days</small> </a>
                    </div>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big">
                        <div class="dropdown-header">
                            <strong>Quick Links</strong>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="nav-grid">
                            <a href="#" class="nav-grid-item"><i class="ti-files text-primary"></i>
                                <h5>New Task</h5>
                            </a>
                            <a href="#" class="nav-grid-item"><i class="ti-check-box text-success"></i>
                                <h5>Assign Task</h5>
                            </a>
                        </div>
                        <div class="nav-grid">
                            <a href="#" class="nav-grid-item"><i class="ti-pencil-alt text-warning"></i>
                                <h5>Add Orders</h5>
                            </a>
                            <a href="#" class="nav-grid-item"><i class="ti-truck text-danger "></i>
                                <h5>New Orders</h5>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="/dashboard/images/profile-avatar.jpg" alt="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <h5 class="mt-0 mb-0">{{Auth::guard('student')->user()->name}}</h5>
                            <span>{{Auth::guard('student')->user()->email}}</span>
                        </div>
                      
                        <a class="dropdown-item" href="{{{route('student.settings.form.setting')}}}"><i class="text-info ti-settings"></i>Settings</a>
                        
                        
                    
                     

                    
                        <a  onclick="document.getElementById('logout').submit()" class="dropdown-item" href="#"><i class="text-danger ti-unlock"></i>Logout</a>
                        <form action="{{ route('student.logout') }}" id="logout" method="POST">
                          @csrf
                      </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!--=================================
    header End-->

        <!--=================================
    Main content -->

        <div class="container-fluid">

            @include('student.layouts.aside')
            <!--=================================
      wrapper -->
            <div class="content-wrapper">
                <div class="page-title">
                    <div class="row">
                        @yield('title')
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pe-0 float-start float-sm-end">
                                {{-- <li class="breadcrumb-item active ps-0">Dashboard</li> --}}
                                @yield('links')
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- widgets -->
                <div class="row">
                    <div class="col-12 min-height">
                        @yield('content')
                    </div>
                    <!--=================================
        footer -->
                    <footer class="bg-white p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center text-md-start">
                                    <p class="mb-0"> &copy; Copyright <span id="copyright">
                                            <script>
                                                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                                            </script>
                                        </span>. <a href="#"> Webmin </a> All Rights Reserved. </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="text-center text-md-end">
                                    <li class="list-inline-item"><a href="#">Terms & Conditions </a> </li>
                                    <li class="list-inline-item"><a href="#">API Use Policy </a> </li>
                                    <li class="list-inline-item"><a href="#">Privacy Policy </a> </li>
                                </ul>
                            </div>
                        </div>
                    </footer>
                    <!--=================================
        footer -->
                </div>
                <!--=================================
      wrapper -->
            </div>
            <!--=================================
    Main content -->
        </div>

        <!--=================================
   jquery -->

        <!-- jquery -->
        <script src="/dashboard/js/jquery-3.6.0.min.js"></script>

        <!-- Required datatable js -->
        <script src="/dashboard/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="/dashboard/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>


        <!-- plugins-jquery -->
        <script src="/dashboard/js/plugins-jquery.js"></script>

        <!-- plugin_path -->
        <script>
            var plugin_path = '/dashboard/js/index.html';
        </script>

        <!-- chart -->
        <script src="/dashboard/js/chart-init.js"></script>

        <!-- calendar -->
        <script src="/dashboard/js/calendar.init.js"></script>

        <!-- charts sparkline -->
        <script src="/dashboard/js/sparkline.init.js"></script>

        <!-- charts morris -->
        <script src="/dashboard/js/morris.init.js"></script>

        <!-- datepicker -->
        <script src="/dashboard/js/datepicker.js"></script>

        <!-- sweetalert2 -->
        <script src="/dashboard/js/sweetalert2.js"></script>

        <!-- toastr -->
        <script src="/dashboard/js/toastr.js"></script>

        <!-- validation -->
        <script src="/dashboard/js/validation.js"></script>

        <!-- lobilist -->
        <script src="/dashboard/js/lobilist.js"></script>

        <!-- custom -->
        <script src="/dashboard/js/custom.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(function() {
                new DataTable('#datatable', {
                
                });
            })
        </script>
        @stack('js')
</body>

<!-- Mirrored from themes.potenzaglobalsolutions.com/html/webmin-bootstrap-4-angular-12-admin-dashboard-template/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Oct 2024 16:20:45 GMT -->

</html>

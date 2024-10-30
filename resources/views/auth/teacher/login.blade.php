<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 5 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Teacher Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/dashboard/css/style.css" />

</head>

<body>

    <div class="wrapper">

        <!--=================================
    preloader -->
        <div id="pre-loader">
            <img src="images/pre-loader/loader-01.svg" alt="">
        </div>
        <!--=================================
    preloader -->

        <!--=================================
    login-->
        <section class="height-100vh d-flex align-items-center page-section-ptb login"
            style="background-image: url(/dashboard/images/bk.jpg);">
            <div class="container">
                <div class="row justify-content-center g-0 vertical-align">
                    <div class="col-lg-4 col-md-6 login-fancy-bg bg"
                        style="background-image: url(/dashboard/images/bk2.jpg);">
                        <div class="login-fancy">
                            <h2 class="text-white mb-20">Hello world!</h2>
                            <p class="mb-20 text-white">Create tailor-cut websites with the exclusive multi-purpose
                                responsive template along with powerful features.</p>
                            <ul class="list-unstyled  pos-bot pb-30">
                                <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a>
                                </li>
                                <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30">Sign In To Teacher</h3>
                            <form action="{{route('teacher.login')}}" method="POST">
                                @csrf
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name">Email* </label>
                                    <input id="name" class="web form-control" type="text" name="email"
                                        placeholder="Email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="Password">Password* </label>
                                    <input id="Password" class="Password form-control" name="password" type="password"
                                        placeholder="Password" name="Password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="section-field">
                                    <div class="remember-checkbox mb-30">
                                        <input type="checkbox" class="form-control" name="two" id="two" />
                                        <label for="two"> Remember me</label>
                                    </div>
                                </div>
                                <button type="submit" class="button">
                                    <span>Log in</span>
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=================================
    login-->
    </div>

    <!--=================================
   jquery -->

    <!-- jquery -->
    <script src="/dashboard/js/jquery-3.6.0.min.js"></script>

    <!-- plugins-jquery -->
    <script src="/dashboard/js/plugins-jquery.js"></script>

    <!-- plugin_path -->
    <script>
        var plugin_path = '/dashboard/js/';
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

</body>

</html>

<!doctype html>
<html lang="en">
<head>
<title>Africab Shop eCommerce Admin</title>
<!-- Basic metas -->
<!-- =================================================================================================== -->
<meta charset="utf-8" />
<meta name="description" content />
<meta name="keywords" content />
<meta name="author" content />
<!-- Mobile metas -->
<!-- =================================================================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="mobile-web-app-capable" content="yes" />
<!-- Favicons -->
<!-- =================================================================================================== -->
<link rel="shortcut icon" href="{{asset('admin/img/favicons/favicon.png')}}" />
<link rel="apple-touch-icon" href="{{asset('admin/img/favicons/apple-touch-icon.png')}}" />
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('admin/img/favicons/apple-touch-icon-72x72.png')}}" />
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('admin/img/favicons/apple-touch-icon-114x114.png')}}" />

<!-- Windows tiles -->
<!-- =================================================================================================== -->
<meta name="application-name" content="Africab Shop eCommerce Admin" />
<meta name="msapplication-TileColor" content="#FFF" />
<meta name="msapplication-square70x70logo" content="{{asset('admin/img/favicons/msapplication-tiny.png')}}" />
<meta name="msapplication-square150x150logo" content="{{asset('admin/img/favicons/msapplication-square.png')}}" />

<!-- Mobile browser coloring -->
<!-- =================================================================================================== -->

<meta name="theme-color" content="#952724" />
<meta name="msapplication-navbutton-color" content="#952724" />
<meta name="apple-mobile-web-app-status-bar-style" content="#952724" />
<!-- CSS -->
<!-- =================================================================================================== -->

    <link rel="stylesheet" href="{{asset('admin/font/iconsmind-s/css/iconsminds.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/font/simple-line-icons/css/simple-line-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/font/line-awesome-1.3.0/css/line-awesome.min.css')}}" />    

    <link rel="stylesheet" href="{{asset('admin/css/vendor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/bootstrap.rtl.only.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/fullcalendar.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/dataTables.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/datatables.responsive.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/glide.core.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/bootstrap-stars.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/nouislider.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/bootstrap-float-label.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/select2-bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/bootstrap-datepicker3.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/bootstrap-clockpicker.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/jquery-clockpicker.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/bootstrap-tagsinput.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/component-custom-switch.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/baguetteBox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/intlTelInput.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/main.css')}}" />
</head>


<body id="app-container" class="menu-default background show-spinner no-footer">
    <div class="fixed-background"></div>
                <div class="color-switch">
                    <label class="switch" for="switchDark">
                      <input type="checkbox" id="switchDark" checked>
                      <span class="slider round" data-toggle="tooltip" data-placement="left" title="Dark Mode"></span>
                    </label>
                 </div>

    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">

                            <p class="text-white h2">Africab Shop eCommerce Admin</p>

                            <p class="white mb-0">
                                Please set a strong password to secure your account.
                            </p>
                        </div>
                        <div class="form-side">
                        
                            <a href="#">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <span class="logo-single"></span>
                            </a>
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ old('email', $email) }}">
                                <label class="form-group has-float-label mb-4">
                                    <input name="password" type="password" class="form-control" />
                                    <span>Type New Password</span>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input name="password_confirmation" type="password" class="form-control" />
                                    <span>Retype New Password</span>
                                </label>
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
 <script src="{{asset('admin/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/chartjs-plugin-datalabels.js')}}"></script>

    <script src="{{asset('admin/js/vendor/moment.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/countdown.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/fullcalendar.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/glide.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/progressbar.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/nouislider.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/select2.full.js')}}"></script>
    <script src="{{asset('admin/js/vendor/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('admin/js/vendor/bootstrap-clockpicker.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/jquery-clockpicker.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/Sortable.js')}}"></script>
    <script src="{{asset('admin/js/vendor/mousetrap.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/baguetteBox.min.js')}}"></script>
    <script src="{{asset('admin/js/vendor/intlTelInput-jquery.min.js')}}"></script>
    <script src="{{asset('admin/js/nzradmin.script.js')}}"></script>
    <script src="{{asset('admin/js/scripts.js')}}"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.message-alert').fadeOut('slow');
        }, 5000); // 5000 milliseconds = 5 seconds
    });
</script>

</body>

</html>    

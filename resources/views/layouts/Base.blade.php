<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Favicon icon -->
      <link rel="icon" href="{{ asset('assets/images/favicon.ico')}}" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
      <!-- waves.css -->
      <link rel="stylesheet" href="{{ asset('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
      <!-- waves.css -->
      <link rel="stylesheet" href="{{ asset('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
      <!-- themify icon -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css')}}">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css')}}">
      <!-- scrollbar.css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.css')}}">
        <!-- am chart export.css -->
      <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css')}}" type="text/css" media="all" />
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
      <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
      <!-- css Datatable-->
      <link href='https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css'rel="stylesheet">
      <link href='https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css'rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
      @yield('css')
</head>
<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>            
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>            
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <!-- MENU SUPERIOR -->
            @include('layouts.menu_superior')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- MENU LATERAL IZQUIERDO -->
                    @include('layouts.menu_lateral_izquierdo')
                  
                    <div class="pcoded-content">
                      <!-- Page-header start -->
                       <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                @yield('banner')                                  
                              </div>
                          </div>
                       </div>
                      <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row"> 
                                            @yield('content')
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui/jquery-ui.min.js')}} "></script>
    <script type="text/javascript" src="{{ asset('assets/js/popper.js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap/js/bootstrap.min.js')}} "></script>
    <script type="text/javascript" src="{{ asset('assets/pages/widget/excanvas.js')}} "></script>
    <!-- waves js -->
    <script src="{{ asset('assets/pages/waves/js/waves.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-slimscroll/jquery.slimscroll.js')}} "></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('assets/js/modernizr/modernizr.js')}} "></script>
    <!-- slimscroll js -->
    <script type="text/javascript" src="{{ asset('assets/js/SmoothScroll.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}} "></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{ asset('assets/js/chart.js/Chart.js')}}"></script>
    <!-- amchart js -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="{{ asset('assets/pages/widget/amchart/gauge.js')}}"></script>
    <script src="{{ asset('assets/pages/widget/amchart/serial.js')}}"></script>
    <script src="{{ asset('assets/pages/widget/amchart/light.js')}}"></script>
    <script src="{{ asset('assets/pages/widget/amchart/pie.min.js')}}"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js')}}"></script>
    <!-- menu js -->
    <script src="{{ asset('assets/js/pcoded.min.js')}}"></script>
    <script src="{{ asset('assets/js/vertical-layout.min.js')}} "></script>
    <!-- custom js -->
    <script type="text/javascript" src="{{ asset('assets/pages/dashboard/custom-dashboard.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js')}} "></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    @yield('js')
</body>

</html>

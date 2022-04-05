<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon icon -->
     <link rel="icon" href="{{ asset('img/Logo.png')}}" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
      <!-- waves.css -->
      <link rel="stylesheet" href="{{ asset('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
      <!-- waves.css -->
      <link rel="stylesheet" href="{{ asset('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
      <!--Datatable-->
      <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> 
      <link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
      <!-- themify icon -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css')}}">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css')}}">
      <!-- scrollbar.css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.css')}}">
        <!-- am chart export.css -->
      <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">

      <!-- Loading -->
      <link href="{{ asset('css/jquery.loadingModal.css')}}" rel="stylesheet" type="text/css" />

      <style type="text/css">
      .modal.loading .modal-content:before {
             content: 'Cargando...';
             text-align: center;
             line-height: 155px;
             font-size: 20px;
             background: rgba(0, 0, 0, .8);
             position: absolute;
             top: 55px;
             bottom: 0;
             left: 0;
             right: 0;
             color: #EEE;
             z-index: 1000;
         }
      .select2 {
              width: 100% !important;
            }
      </style>

      @yield('css')
</head>
<body onloadstart='loading_show();'>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
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
                                @yield('modal')
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.js"></script>
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
    <!-- DATATABLE -->
    <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
   
    <script src="{{ asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('js/responsive.bootstrap.min.js')}}"></script>

    <!-- slimscroll js >
    <script type="text/javascript" src="{{ asset('assets/js/SmoothScroll.js')}}"></script-->
    <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}} "></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{ asset('assets/js/chart.js/Chart.js')}}"></script>
    <!-- amchart js -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js'"></script>
    <script src="{{ asset('assets/pages/widget/amchart/gauge.js')}}"></script>
    <script src="{{ asset('assets/pages/widget/amchart/serial.js')}}"></script>
    <script src="{{ asset('assets/pages/widget/amchart/light.js')}}"></script>
    <script src="{{ asset('assets/pages/widget/amchart/pie.min.js')}}"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js'"></script>
    <!-- menu js -->
    <script src="{{ asset('assets/js/pcoded.min.js')}}"></script>
    <script src="{{ asset('assets/js/vertical-layout.min.js')}} "></script>
    <!-- custom js -->
    <script type="text/javascript" src="{{ asset('assets/pages/dashboard/custom-dashboard.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js')}} "></script>
    <!-- Loading -->
     <script src="{{ asset('js/jquery.loadingModal.js') }}" type="text/javascript"></script>
    <!--sweetalert2-->
    <script src="{{ asset('js/sweetalert.js')}}"></script>
    @include('layouts.validaciones')
    @yield('js')
    <script type="text/javascript">
      loading_hide();
      $(".alert").alert(); 
      window.setTimeout(function() { $(".alert").alert('close'); }, 5000);
    </script>
</body>

</html>
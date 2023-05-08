<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>SPK Pegawai</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/jquery-bar-rating/css-stars.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/demo_2/style.css') }}" />
    <!-- End layout styles -->
    @livewireStyles

    <style>
        .active {
            color: #FF9021 !important;
        }

        .vertical-scrollable>.row {
            bottom: 100px;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <div class="container-scroller">


        <!-- partial:partials/_horizontal-navbar.html -->
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="horizontal-menu-toggle">
                    <span class="mdi mdi-menu"></span>
                </button>
            </nav>
            <nav class="bottom-navbar">

                <h2 class="ms-md-3 text-white col-6">SPK Penilaian Pegawai Kejaksaan</h2>
                <ul class="nav page-navigation justify-content-center">
                    <li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{  url('/') }}">
                            <i class="mdi mdi-home-outline menu-icon"></i>
                            <span class="menu-title">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kriteria') ? 'active' : '' }}"
                            href="{{ route('kriteria') }}">
                            <i class="mdi mdi-compass-outline menu-icon"></i>
                            <span class="menu-title">Kriteria</span>
                        </a>
                    </li>
                    @if (Auth::user()->level == 0 || Auth::user()->level == 1)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pegawai') ? 'active' : '' }}"
                            href="{{ route('pegawai') }}">
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                            <span class="menu-title">Pegawai</span>
                        </a>
                    </li>
                    @if (Auth::user()->level == 0)

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pengguna') ? 'active' : '' }}"
                            href="{{ route('pengguna') }}">
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                            <span class="menu-title">Pengguna</span>
                        </a>
                    </li>
                    @endif
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}"
                            href="{{ route('profil') }}">
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                            <span class="menu-title">Profil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('perhitungan') ? 'active' : '' }}"
                            href="{{ route('perhitungan') }}">
                            <i class="mdi mdi-calculator menu-icon"></i>
                            <span class="menu-title">Perhitungan</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Auth::user()->level == 0 ? 'mb-1' : 'mt-3' }}">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); Confirmlogout()"
                            class="btn btn-light btn-inverse-info  text-white "> Logout </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                @yield('content')

                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer col-12" style="position:sticky;
          bottom:0;">
                    <!-- <div class="container">
                        <div class="d-sm-flex justify-content-end">

                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                                class="btn btn-light btn-inverse-info btn-rounded btn-fw "> Logout </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div> -->
                </footer>

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script>
        function Confirmlogout() {		 		  
		  if (confirm("Apakah anda ingin logout?")) {
			document.getElementById('logout-form').submit();
		  }		  
		}
    </script>
    <script>
        window.addEventListener('modal-store',()=>{                             
                    $('#modelId').modal('hide');
                    $('#toastId').toast('show');
                });
        window.addEventListener('modal-edit',()=>{            
                    $('#modelId').modal('show');                
                });    
        window.addEventListener('tersimpan',()=>{                                                 
                    $('#toastId').toast('show');
                });
        window.addEventListener('modal-deleteConfirm',()=>{   
            $('#deleteId').modal('show');
        });
        
        window.addEventListener('modal-delete',()=>{  
            $('#deleteId').modal('hide');   
            $('#toastDeleteId').toast('show');            
            });              
    </script>
    @stack('scripts')
    @livewireScripts

    <script src="{{ asset('template/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('template/assets/js/settings.js') }}"></script>

</body>

</html>
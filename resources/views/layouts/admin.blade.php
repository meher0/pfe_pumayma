
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>RéunionTN </title>


    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets_admin/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_admin/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_admin/vendor/datatables/dataTables.bootstrap4.min.css') }}">

     <link  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

     <link rel="icon"type="image/png" href="../images\logo1.png">
     <meta name="csrf-token" content="{{ csrf_token() }}" />


     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

     <!-- Toaster -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body id="page-top">

    @php
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $messages = \App\Models\ChMessage::where('from_id','<>',$id)
        ->where('to_id',$id)
        ->where('seen',0)
        ->get();
        $timenow = Carbon\carbon::now();
    @endphp

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3"> Administrateur  <sup></sup></div>
            </a>
            <hr class="sidebar-divider">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('list') }}">
                    <i class="fas fa-users"></i>
                    <span>Compte</span></a>
            </li>
   <!-- Divider -->

   <!-- Nav Item - Charts -->
   <li class="nav-item">
       <a class="nav-link" href="{{ url('historique') }}">
           <i class="fas fa-history"></i>
           <span>Historique</span></a>
   </li>
<!-- Divider -->

        </ul>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown  -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="chatify" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                    @if ($messages->count() <> 0)
                                    <span class="badge badge-danger badge-counter">{{ $messages->count() }}</span>
                                    @endif
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                    @forelse ($messages as $message)
                                    <a class="dropdown-item d-flex align-items-center" href="/chatify/{{ $message->from_id }}">
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">
                                                {{ $message->body }}
                                            </div>
                                            <div class="small text-gray-500">{{  $message->created_at->diffInMinutes($timenow) }} min ago</div>
                                        </div>
                                        @empty
                                        <span> no messages </span>
                                    </a>
                                     @endforelse

                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        @guest
                        <!-- Nav Item - User Information -->
                        @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link contact" href="{{ route('register') }}">{{ __('انشاء حساب ') }}</a>
                                </li>
                            @endif
                        @else

                        <li class="nav-item dropdown" >
                            <a style="color: black !important;" id="nav-link contact" class="nav-link contact" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Français
                                <span class="caret"></span>
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-left shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="">
                                    Arabie
                                </a>

                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown">
                                <a style="color: black !important;" id="nav-link contact" class="nav-link contact" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-left shadow animated--grow-in"
                                    aria-labelledby="userDropdown">

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out "></i>
                                    {{ __('Déconnexion') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <a class="navbar-brand" href="/welcome">
                        <img src="..\images\logo1.png". width="20%" height="20%;" style="border-radius: 50px;" >
                       </a>
                </nav>
                <!-- End of Topbar -->

                      <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <main class="py-4">
            @yield('content')
        </main>


</body>


<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets_admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets_admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('assets_admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets_admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets_admin/js/demo/datatables-demo.js') }}"></script>

</html>

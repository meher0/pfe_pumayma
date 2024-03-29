<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Reunion TN</title>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Toaster -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Fontfaces CSS-->
    <link href="../../../assets/font_client/css/font-face.css" rel="stylesheet" media="all">
    <link href="../../../assets/font_client/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../../../assets/font_client/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- ../../../assets/font_client/vendor CSS-->
    <link href="../../../assets/font_client/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/font_client/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/font_client/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../../../assets/font_client/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/font_client/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../../../assets/font_client/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/font_client/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../../../assets/font_client/css/theme.css" rel="stylesheet" media="all">
    <style>
        .badge{
            font-size: 15px;
            font-weight: normal ;
            line-height: 13px;
            padding: 2px 6px;
            position: absolute;
            right: -10px;
            top: -8px;
            background: rgba(221, 3, 3, 0.966);
        }
    </style>
</head>

<body class="animsition">
    @php
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $messages = \App\Models\ChMessage::where('from_id','<>',$id)
        ->where('to_id',$id)
        ->where('seen',0)
        ->get();
    @endphp

    <!-- HEADER DESKTOP-->
    <header class="header-desktop3 d-none d-lg-block">
        <div class="section__content section__content--p35">
            <div class="header3-wrap">
                <div class="header__logo">
                    <a href="#">
                        <img src="/images/logo1.png" alt="CoolAdmin" style="width: 68px;border-radius:50px" />
                    </a>
                </div>
                <div class="header__navbar">
                    <ul class="list-unstyled">
                        <li class="has-sub  {{ (Request::path()=='ministere/index' ? 'active' : '') }}">
                            <a href="{{ url('ministere/index') }}">
                                <i class="fas fa-home"></i>Accueil
                                <span class="bot-line"></span>
                            </a>
                        </li>
                        <li class="has-sub  {{ (Request::path()=='ministere/reunion/show' ? 'active' : '') }}">
                            <a href="{{ route('showMinistereReunion') }}">
                                <i class="fas fa-list"></i>Voir reunions
                                <span class="bot-line"></span>
                            </a>
                        </li>
                        <li class="has-sub  {{ (Request::path()=='ministere/decision/list' ? 'active' : '') }}">
                            <a href="{{route('showministereDecision')}}">
                                <i class="fas fa-list"></i>Décision
                                <span class="bot-line"></span>
                            </a>
                        </li>
                        <li class="has-sub  {{ (Request::path()=='ministere/pv/show' ? 'active' : '') }}">
                            <a href="{{ route('showMinisterePv') }}">
                                <i class="fas fa-file"></i>Procés verbal
                                <span class="bot-line"></span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="header__tool">

                    <div class="header-button-item js-item-menu">
                        @if ($messages->count() <> 0)
                          <span class="badge bg-red">{{ $messages->count() }}</span>
                        @endif
                        <i class="zmdi zmdi-email"></i>
                        <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                            @forelse ($messages as $message)
                            <a href="http://localhost:8000/chatify/{{ $message->from_id }}" class="notifi__item">
                                <div class="bg-c1 img-cir img-40">
                                    <i class="zmdi zmdi-email-open"></i>
                                </div>
                                <div class="content">
                                    <p>{{ $message->body }} </p>
                                    <span class="date">{{  $message->created_at->diffInMinutes($timenow) }} min ago</span>
                                </div>
                            </a>


                            @empty
                           <span> no messages </span>
                            @endforelse

                            <div class="notifi__footer">
                                <a href="http://localhost:8000/chatify">All Messages</a>
                            </div>
                        </div>
                    </div>

                    <div class="account-wrap">
                        <div class="account-item account-item--style2 clearfix js-item-menu">
                            <div class="image">
                                <img src="../../../assets/font_client/images/icon/avatar-01.jpg" alt="John Doe" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="../../../assets/font_client/images/icon/avatar-01.jpg" alt="John Doe" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{ Auth::user()->name }}</a>
                                        </h5>
                                        <span class="email">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{route('showMinistereEditProfile')}}">
                                            <i class="zmdi zmdi-account"></i>Profil</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="{{route('showMinistereEditPassword')}}">
                                            <i class="zmdi zmdi-account"></i>Changer mot de passe</a>
                                    </div>

                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                </div>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- END HEADER DESKTOP-->

    <!-- HEADER MOBILE-->
    <header class="header-mobile header-mobile-2 d-block d-lg-none">
        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">
                    <a class="logo" href="#">
                        <img src="images/logo1.png" alt="CoolAdmin" />
                    </a>
                    <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <nav class="navbar-mobile">
            <div class="container-fluid">
                <ul class="navbar-mobile__list list-unstyled">
                    <li class="has-sub  {{ (Request::path()=='ministere/index' ? 'active' : '') }}">
                        <a href="{{ url('ministere/index') }}">
                            <i class="fas fa-home"></i>Accueil
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub  {{ (Request::path()=='ministere/reunion/show' ? 'active' : '') }}">
                        <a href="{{ route('showMinistereReunion') }}">
                            <i class="fas fa-list"></i>Voir reunions
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub  {{ (Request::path()=='ministere/decision/list' ? 'active' : '') }}">
                        <a href="{{route('showministereDecision')}}">
                            <i class="fas fa-list"></i>Décision
                            <span class="bot-line"></span>
                        </a>
                    </li>
                    <li class="has-sub  {{ (Request::path()=='ministere/pv/show' ? 'active' : '') }}">
                        <a href="{{ route('showMinisterePv') }}">
                            <i class="fas fa-file"></i>Procés verbal
                            <span class="bot-line"></span>
                        </a>
                    </li>
                </ul>
                </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="sub-header-mobile-2 d-block d-lg-none">
        <div class="header__tool">
            <div class="header-button-item js-item-menu">
                <span class="badge">6</span>
                <i class="zmdi zmdi-email"></i>
                <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                    <div class="notifi__title">
                        <p>You have 3 Notifications</p>
                    </div>
                    <div class="notifi__item">
                        <div class="bg-c1 img-cir img-40">
                            <i class="zmdi zmdi-email-open"></i>
                        </div>
                        <div class="content">
                            <p>You got a email notification</p>
                            <span class="date">April 12, 2018 06:50</span>
                        </div>
                    </div>

                    <div class="notifi__footer">
                        <a href="#">All Messages</a>
                    </div>
                </div>
            </div>
            <div class="header-button-item  js-item-menu">
                <span class="badge">6</span>
                <i class="zmdi zmdi-notifications"></i>
                <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                    <div class="notifi__title">
                        <p>You have 3 Notifications</p>
                    </div>
                    <div class="notifi__item">
                        <div class="bg-c1 img-cir img-40">
                            <i class="zmdi zmdi-email-open"></i>
                        </div>
                        <div class="content">
                            <p>You got a email notification</p>
                            <span class="date">April 12, 2018 06:50</span>
                        </div>
                    </div>
                    <div class="notifi__item">
                        <div class="bg-c2 img-cir img-40">
                            <i class="zmdi zmdi-account-box"></i>
                        </div>
                        <div class="content">
                            <p>Your account has been blocked</p>
                            <span class="date">April 12, 2018 06:50</span>
                        </div>
                    </div>
                    <div class="notifi__item">
                        <div class="bg-c3 img-cir img-40">
                            <i class="zmdi zmdi-file-text"></i>
                        </div>
                        <div class="content">
                            <p>You got a new file</p>
                            <span class="date">April 12, 2018 06:50</span>
                        </div>
                    </div>
                    <div class="notifi__footer">
                        <a href="#">All notifications</a>
                    </div>
                </div>
            </div>


            <div class="account-wrap">
                <div class="account-item account-item--style2 clearfix js-item-menu">
                    <div class="image">
                        <img src="../../../assets/font_client/images/icon/avatar-01.jpg" alt="John Doe" />
                    </div>
                    <div class="content">
                        <a class="js-acc-btn" href="#"></a>
                    </div>
                    <div class="account-dropdown js-dropdown">
                        <div class="info clearfix">
                            <div class="image">
                                <a href="#">
                                    <img src="../../../assets/font_client/images/icon/avatar-01.jpg" alt="John Doe" />
                                </a>
                            </div>
                            <div class="content">
                                <h5 class="name">
                                    <a href="#">{{ Auth::user()->name }}</a>
                                </h5>
                                <span class="email">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-account"></i>Account</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-settings"></i>Setting</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-money-box"></i>Billing</a>
                            </div>
                        </div>
                        <div class="account-dropdown__footer">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="zmdi zmdi-power"></i>Logout</a>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END HEADER MOBILE -->

    @yield('content')

    <!-- COPYRIGHT-->
    <section class="p-t-60 p-b-20" style="margin-top: 500px">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright" style="background: rgb(45,45,45)">
                    <p>Copyright © 2023 Reunion TN. All rights reserved.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- END COPYRIGHT-->



<!-- Jquery JS-->
<script src="../../../assets/font_client/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="../../../assets/font_client/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="../../../assets/font_client/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- ../../../assets/font_client/vendor JS       -->
<script src="../../../assets/font_client/vendor/slick/slick.min.js">
</script>
<script src="../../../assets/font_client/vendor/wow/wow.min.js"></script>
<script src="../../../assets/font_client/vendor/animsition/animsition.min.js"></script>
<script src="../../../assets/font_client/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="../../../assets/font_client/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="../../../assets/font_client/vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="../../../assets/font_client/vendor/circle-progress/circle-progress.min.js"></script>
<script src="../../../assets/font_client/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../../../assets/font_client/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="../../../assets/font_client/vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="../../../assets/font_client/js/main.js"></script>

</body>

</html>
<!-- end document-->

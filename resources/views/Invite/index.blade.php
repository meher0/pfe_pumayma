@extends('layouts.invite')
   @section('content')

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">You are here:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="#">Home</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <form class="au-form-icon--sm" action="" method="post">
                                    <input class="au-input--w300 au-input--style2" type="text" placeholder="Search for datas &amp; reports...">
                                    <button class="au-btn--submit2" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">Welcome 
                                <span>{{ Auth::user()->name }} 😀</span>
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->

            <!-- STATISTIC-->
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number">10,368</h2>
                                <span class="desc">Tache effectue</span>
                                <div class="icon">
                                    <i class="fa-solid fa-check "></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">388,688</h2>
                                <span class="desc">Tache en attente</span>
                                <div class="icon">
                                    <i class="fa-solid fa-hourglass "></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">1,086</h2>
                                <span class="desc">Réclamations</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number">$1,060,386</h2>
                                <span class="desc">Problémes </span>
                                <div class="icon">
                                    <i class="fa-solid fa-circle-xmark fa-beat" ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item bg-dark">
                                    <h2 class="number">10,368</h2>
                                    <span class="desc">Technicien de maintenance</span>
                                    <div class="icon">
                                        <i class="fa-solid fa-users-gear"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item bg-dark">
                                    <h2 class="number">388,688</h2>
                                    <span class="desc">Fournisseur des materiels</span>
                                    <div class="icon">
                                        <i class="fa-sharp fa-solid fa-truck-fast"></i>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item bg-dark">
                                    <h2 class="number">1,086</h2>
                                    <span class="desc">Properietaire des fermes</span>
                                    <div class="icon">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item  bg-dark">
                                    <h2 class="number">$1,060,386</h2>
                                    <span class="desc">Total users </span>
                                    <div class="icon">
                                        <i class="fa-solid fa-users" ></i>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
        </div>

     @endsection

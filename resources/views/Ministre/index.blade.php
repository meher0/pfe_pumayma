@extends('layouts.ministere')

@section('content')
    <div class="container mt-4">
        <div class="row">
             <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--red">
                    <h2 class="number"  style="color: white">
                        @php
                            $countDecisionFinish = \App\Models\Decision::where('status',0)->count();
                        @endphp
                        {{$countDecisionFinish}}
                    </h2>
                    <span class="desc" style="color: white">Aucune réponse</span>
                    <div class="icon">
                        <i class="zmdi zmdi-info"></i>
                    </div>
                </div>
             </div>
             <div class="col-md-6 col-lg-3">
             <div class="statistic__item statistic__item--orange">
                <h2 class="number"  style="color: white">
                    @php
                        $countDecisionEncours = \App\Models\Decision::where('status',1)->count();
                    @endphp
                    {{$countDecisionEncours}}
                </h2>
                <span class="desc"  style="color: white">En cours d'exécution</span>
                 <div class="icon">
                        <i class="zmdi zmdi-info"></i>
                    </div>
                 </div>
             </div>
             <div class="col-md-6 col-lg-3">
                 <div class="statistic__item statistic__item--green">
                    <h2 class="number"  style="color: white">
                        @php
                            $countDecisionActive= \App\Models\Decision::where('status',2)->count();
                        @endphp
                        {{$countDecisionActive}}
                    </h2>
                    <span class="desc"  style="color: white">Activé</span>
                    <div class="icon">
                        <i class="zmdi zmdi-check"></i>
                    </div>
                 </div>
            </div>
             <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--green">
                    <h2 class="number"  style="color: white">
                        @php
                            $countDecisionSuccess = \App\Models\Decision::where('status',3)->count();
                        @endphp
                        {{$countDecisionSuccess}}
                    </h2>
                    <span class="desc"  style="color: white">la mise en oeuvre</span>
                    <div class="icon">
                        <i class="zmdi zmdi-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Réunions par Jour de la Semaine</h3>
                    <canvas id="dayOfWeekChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Réunions par Mois</h3>
                    <canvas id="meetingsByMonthChart"></canvas>
                </div>
            </div>
        </div>
    </div>




    <!-- Reste de votre contenu HTML -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script>
        var xValues = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
        var yValues = @json($meetingsByDay);
        var barColors = "lightblue";

        new Chart("dayOfWeekChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: { display: false },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var monthLabels =  ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',];
        var monthData = @json($meetingsByMonth);
        var monthBarColors = "lightgreen";

        new Chart("meetingsByMonthChart", {
            type: "bar",
            data: {
                labels: monthLabels,
                datasets: [{
                    backgroundColor: monthBarColors,
                    data: monthData
                }]
            },
            options: {
                legend: { display: false },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection

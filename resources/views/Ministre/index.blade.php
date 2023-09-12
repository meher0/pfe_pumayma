@extends('layouts.ministere')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Single Bar Chart</h3>
                    <canvas id="singelBarChart"></canvas>
                </div>
            </div>
        </div>

    <div class="col-lg-6" >
        <div class="au-card m-b-30" style="height: 550px !important;">
            <div class="au-card-inner">
                <h3 class="title-2 m-b-40">Pie Chart</h3>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            try {
                var ctx = document.getElementById("singelBarChart");
                if (ctx) {
                    ctx.height = 150;

                    var labels = {!! json_encode($meetingsByMonth->pluck('month')) !!}; // Les noms des mois
                    var data = {!! json_encode($meetingsByMonth->pluck('count')) !!}; // Le nombre de réunions par mois

                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: "Statistiques des réunions par mois",
                                    data: data,
                                    borderColor: "rgba(0, 123, 255, 0.9)",
                                    borderWidth: "0",
                                    backgroundColor: "rgba(0, 123, 255, 0.5)"
                                }
                            ]
                        },
                        options: {
                            legend: {
                                position: 'top',
                                labels: {
                                    fontFamily: 'Poppins'
                                }
                            },
                            scales: {
                                xAxes: [{
                                    ticks: {
                                        fontFamily: "Poppins"
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        fontFamily: "Poppins"
                                    }
                                }]
                            }
                        }
                    });
                }
            } catch (error) {
                console.log(error);
            }



            try {

                //pie chart
                var ctx = document.getElementById("pieChart");
                if (ctx) {
                    ctx.height = 200;
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: [45, 25, 20, 10],
                                backgroundColor: [
                                    "rgba(0, 123, 255,0.9)",
                                    "rgba(0, 123, 255,0.7)",
                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(0,0,0,0.07)"
                                ],
                                hoverBackgroundColor: [
                                    "rgba(0, 123, 255,0.9)",
                                    "rgba(0, 123, 255,0.7)",
                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(0,0,0,0.07)"
                                ]

                            }],
                            labels: [
                                "Green",
                                "Green",
                                "Green"
                            ]
                        },
                        options: {
                            legend: {
                                position: 'top',
                                labels: {
                                    fontFamily: 'Poppins'
                                }

                            },
                            responsive: true
                        }
                    });
                }


            } catch (error) {
                console.log(error);
            }
        });



      </script>


@endsection

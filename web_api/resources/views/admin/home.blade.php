@extends('layouts.admin')
@section('title', 'HOME')
@section('content')

    <div class="container-fluid p-5">
        <h1><b> Rain GaugeStation<b></h1>
        <div class="row" id="chart-list">
        </div>
    </div>

@endsection

@section('js')
    <script>
        var places = @json($returnData);
        var el = $('#chart-list');
        places.forEach(place => {
            var labels = [];
            var dataMin = [];
            var dataMax = [];
            var minValue = 0.0;
            var maxValue = 0.0;
            place["status"].forEach(row => {
                labels.push(row["date"]);
                dataMax.push(row["max"]);
                dataMin.push(row["min"]);

                if (maxValue < parseFloat(row["max"])) {
                    maxValue = parseFloat(row["max"]);
                }
                if (minValue < parseFloat(row["min"])) {
                    minValue = parseFloat(row["min"]);
                }
            });
            el.append(`
                <div class="col-6">
                    <div class="card card-default" data-scroll-height="675">
                        <div class="card-header">
                            <h2>${place["place"]["name"]}</h2>
                        </div>
                        <div class="card-body">
                            <canvas id="monitorPlace-${place["place"]["id"]}" class="chartjs"></canvas>
                        </div>
                        <div class="card-footer d-flex flex-wrap bg-white p-0">
                            <div class="col-6 px-0">
                                <div class="text-center p-4">
                                    <h4>${minValue}</h4>
                                    <p class="mt-2">Min Value</p>
                                </div>
                            </div>
                            <div class="col-6 px-0">
                                <div class="text-center p-4 border-left">
                                    <h4>${maxValue}</h4>
                                    <p class="mt-2">Max Value</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            var ctx = document.getElementById("monitorPlace-" + place["place"]["id"]);
            if (ctx !== null) {
                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: "line",

                    // The data for our dataset
                    data: {
                        labels: labels,
                        datasets: [{
                                label: "Min",
                                pointRadius: 4,
                                pointBackgroundColor: "rgba(255,255,255,1)",
                                pointBorderWidth: 2,
                                fill: true,
                                lineTension: 0,
                                backgroundColor: "rgba(66,208,163,0.2)",
                                borderWidth: 2.5,
                                borderColor: "#42d0a3",
                                data: dataMin,
                            },
                            {
                                label: "Min",
                                pointRadius: 4,
                                pointBackgroundColor: "rgba(255,255,255,1)",
                                pointBorderWidth: 2,
                                fill: true,
                                lineTension: 0,
                                backgroundColor: "rgba(76,132,255,0.2)",
                                borderWidth: 2.5,
                                borderColor: "#4c84ff",
                                data: dataMax,
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    drawBorder: true,
                                    display: false
                                },
                                ticks: {
                                    display: true, // hide main x-axis line
                                    beginAtZero: true,
                                    fontFamily: "Roboto, sans-serif",
                                    fontColor: "#8a909d"
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    drawBorder: true, // hide main y-axis line
                                    display: true
                                },
                                ticks: {
                                    callback: function(value) {
                                        var ranges = [{
                                                divider: 1e6,
                                                suffix: "M"
                                            },
                                            {
                                                divider: 1e3,
                                                suffix: "k"
                                            }
                                        ];

                                        function formatNumber(n) {
                                            for (var i = 0; i < ranges.length; i++) {
                                                if (n >= ranges[i].divider) {
                                                    return (
                                                        (n / ranges[i].divider).toString() +
                                                        ranges[i].suffix
                                                    );
                                                }
                                            }
                                            return n;
                                        }
                                        return formatNumber(value);
                                    },
                                    stepSize: 100,
                                    fontColor: "#8a909d",
                                    fontFamily: "Roboto, sans-serif",
                                    beginAtZero: true
                                }
                            }]
                        },
                        tooltips: {
                            enabled: true
                        }
                    }
                });

            }
        });
    </script>
@endsection

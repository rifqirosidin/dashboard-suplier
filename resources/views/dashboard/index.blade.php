@extends('dashboard.layouts.app')
@section('header', 'Dashboard')
@section('content')

<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Peringkat </h4>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="peringkat" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="3%">Ranking</th>
                            <th>Nama</th>
                            <th width="10%">Nilai</th>

                        </tr>
                        </thead>
                        <tbody>

                            @foreach($datas as  $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->nilai }}</td>
                                </tr>
                            @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Grafik Peringkat Suplier</h3>

                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <!-- /.row (main row) -->
</div>
@push('js')
    <script>
        $(function () {
            $("#peringkat").DataTable();

        });

        $(function () {

        })

        $(document).ready(function () {
            var url = "{{ url('/data') }}"
            var labels = [];
            var nilai = [];

            $.get(url, function (response) {

                response.forEach(function (data) {
                    labels.push(data.nama)
                    nilai.push(data.nilai)
                })
                console.log(nilai)
                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets : [{
                            label: 'Nilai',
                            data: nilai,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: "Nilai",
                                    fontFamily: "Roboto"
                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Suplier',
                                    fontFamily: "Roboto"
                                }
                            }],
                        },
                    }
                })


            })


        })



    </script>
@endpush
@endsection

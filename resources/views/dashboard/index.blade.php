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

                            <th width="30%">Nama</th>
                            <th width="30%">Alamat</th>
                            <th width="10%">Telepone</th>
                            <th width="10%">Fax</th>
                            <th width="10%">UP</th>
                            <th width="10%">Jenis Produk</th>
                            <th width="10%">Nilai</th>
                            <th width="2%">Ranking</th>



                        </tr>
                        </thead>
                        <tbody>

                        @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->telepon }}</td>
                                <td>{{ $data->fax }}</td>
                                <td>{{ $data->up }}</td>
                                <td>{{ $data->jenis_produk }}</td>
                                <td>{{ $data->total_nilai }}</td>
                                <td>{{ $loop->iteration }}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
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
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script>
        $(function () {
            $("#peringkat").DataTable({
                order: [[6, "desc"]],
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'print'
                ]
            });

        });

        $(function () {

        })

        $(document).ready(function () {
            var url = "{{ url('/data') }}"
            var labels = [];
            var nilai = [];

            $.get(url, function (response) {

                response.forEach(function (data) {
                    // console.log(data)
                    labels.push(data.nama)
                    nilai.push(data.total_nilai)
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

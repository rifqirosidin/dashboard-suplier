@extends('dashboard.layouts.app')
@section('header', 'Data Evaluasi')
@section('content')
    <style>
        th {
            vertical-align: text-top;
            text-align: center;
        }

    </style>
    <div class="container-fluid">
        <div class="col-md-4">
            @include('dashboard.partials.alert_error')
        </div>
        <div class="card">
            <div class="card-header">
                @include('dashboard.partials.alert')

                <h4 class="text-right">{{ $suplier->nama }}</h4>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <p class="text-right">Jenis Produk: {{ $suplier->jenis_produk }}</p>
                <form action="{{ route('evaluasi.store', request()->route('id')) }}" method="POST" id="form-submit">
                    {{ csrf_field() }}

                    <table id="evaluasi" class="table table-responsive table-bordered table-striped ">
                        <thead>
                        <tr>
                            <th align="center" rowspan="2" style="vertical-align: middle;">No</th>
                            <th align="center" colspan="2">Orderan Pembelian</th>
                            <th align="center" width="20%" colspan="4">Kriteria Untuk Dinilai</th>
                        </tr>

                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal Pembelian</th>
                            <th>SP</th>
                            <th>KB</th>
                            <th>WP</th>
                            <th>HB</th>
                        </tr>
                        <tbody>
                        @foreach($pembelians as $pembelian)
                            <input name="suplier_id[]" type="hidden" value="{{ $pembelian->suplier_id }}"/>

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pembelian->no_sop }}</td>
                                <td>{{ $pembelian->tgl_pembelian }}</td>

                                <td width="5%"><input class="qty1" type="text"  max="5" name="metode_pembayaran[]"
                                                      style="width: 50px" required></td>

                                <td width="5%"><input  class="qty2" type="text"  max="5" name="kualitas[]" style="width: 50px" required>
                                </td>
                                <td width="5%"><input  class="qty3" type="text"  max="5" name="waktu_pengiriman[]"
                                                      style="width: 50px" required></td>
                                <td width="5%"><input  class="qty4" type="text"  max="5" name="harga_barang[]"
                                                      style="width: 50px" required></td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">Rata - Rata:</td>
                            <td class="avg1"></td>
                            <td class="avg2"></td>
                            <td class="avg3"></td>
                            <td class="avg4"></td>

                        </tr>
                        <tr id="total_akhir_nilai">
                            <td class="text-right" colspan="3">Nilai:</td>
                            <td>
                                <input id="kp" class="nilai" type="text" style="width: 50px; border: none" readonly>
                            </td>
                            <td>
                                <input id="kb" class="nilai" type="text" style="width: 50px; border: none" readonly>
                            </td>
                            <td>
                                <input id="wp" class="nilai" type="text" style="width: 50px; border: none" readonly>
                            </td>
                            <td>
                                <input id="hb" class="nilai" type="text" style="width: 50px; border: none" readonly>
                            </td>
                        </tr>

                        </tfoot>
                    </table>
                    Total: <input id="total_nilai_akhir" name="total_nilai" type="text" style="width: 50px; border: none" readonly>
                    <button type="button" id="jumlah" class="btn btn-primary float-right">Submit</button>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
    </div>


    @push('js')
        <script>
            ///////////////////////////////////////////////
            /*
            kriteria
            kp = metode pembayaran
            kb = kualitas
            wp = waktu pengiriman
            hb = harga barang

             */
            $(document).ready(function () {
                var total = 0;
                $(document).on("keyup", ".qty1", function () {
                    var sum = 0;
                    var avg = 0;
                    var count = 0;
                    var nilai_kp = 0;
                    $(".qty1").each(function () {
                        sum += +$(this).val();
                        count++;
                    });

                    avg = sum / count
                    nilai_kp = avg * 0.15
                    total += nilai_kp

                    $("#kp").val(nilai_kp.toFixed(2));
                    $(".avg1").html(avg.toFixed(2));
                    $("#total_nilai").val(parseFloat(total).toFixed(2))
                });

                $(document).on("keyup", ".qty2", function () {
                    var sum_kb = 0;
                    var count_kb = 0;
                    var avg_kb = 0;
                    var nilai_kb = 0;
                    $(".qty2").each(function () {
                        sum_kb += +$(this).val();
                        count_kb++;
                    });

                    avg_kb = sum_kb / count_kb
                    nilai_kb = avg_kb * 0.35
                    total += nilai_kb
                    $("#kb").val(nilai_kb.toFixed(2));
                    $(".avg2").html(avg_kb.toFixed(2));
                    $("#total_nilai").val(parseFloat(total).toFixed(2))
                });

                //nilai waktu pengiriman
                $(document).on("keyup", ".qty3", function () {
                    var sum_wp = 0;
                    var count_wp = 0;
                    var avg_wp = 0
                    var nilai_wp = 0
                    $(".qty3").each(function () {
                        sum_wp += +$(this).val();
                        count_wp++;
                    });


                    avg_wp = sum_wp / count_wp
                    nilai_wp = avg_wp * 0.3
                    total += nilai_wp
                    $("#total_nilai").val(parseFloat(total).toFixed(2))
                    $("#wp").val(nilai_wp.toFixed(2));
                    $(".avg3").html(avg_wp.toFixed(2));
                })

                //nilai harga barang = hb
                $(document).on("keyup", ".qty4", function () {
                    var sum_hb = 0;
                    var count_hb = 0;
                    var avg_hb = 0;
                    var nilai_hb = 0;
                    $(".qty4").each(function () {
                        sum_hb += +$(this).val();
                        count_hb++;
                    });

                    avg_hb = sum_hb / count_hb
                    nilai_hb = avg_hb * 0.2
                    total += nilai_hb;
                    $("#total_nilai").val(parseFloat(total).toFixed(2))
                    $("#hb").val(nilai_hb.toFixed(2));
                    $(".avg4").html(avg_hb.toFixed(2));
                })


            })
            $("#jumlah").click(function () {
                var kp = +$("#kp").val()
                var kb = +$("#kb").val()
                var wp = +$("#wp").val()
                var hb = +$("#hb").val()
                var nilai_akhir = kp + kb + wp + hb
                $("#total_nilai_akhir").val(parseFloat(nilai_akhir).toFixed(2))

                event.preventDefault()
                $("#form-submit").submit()



            })


            /////////////////////////////////////////////////////////////////////////

        </script>
    @endpush
@endsection



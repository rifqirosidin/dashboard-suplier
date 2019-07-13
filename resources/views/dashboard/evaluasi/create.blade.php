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
        <div class="card">
            <div class="card-header">
                <h4 class="text-right">{{ $suplier->nama }}</h4>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <p class="text-right">Jenis Produk: {{ $suplier->jenis_produk }}</p>
                <form action="{{ route('evaluasi.store', request()->route('id')) }}" method="POST">
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
                        <th >SP</th>
                        <th >KB</th>
                        <th >WP</th>
                        <th >HB</th>
                    </tr>
                    <tbody>
                    @foreach($pembelians as $pembelian)
                        <input name="suplier_id[]" type="hidden" value="{{ $pembelian->suplier_id }}" />

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pembelian->no_sop }}</td>
                            <td>{{ $pembelian->tgl_pembelian }}</td>

                            <td width="5%"><input class="qty1"  type="text" name="metode_pembayaran[]" style="width: 50px"></td>
                            <td width="5%"><input class="qty2" type="text" name="kualitas[]" style="width: 50px"></td>
                            <td width="5%"><input class="qty3" type="text" name="waktu_pengiriman[]" style="width: 50px"></td>
                            <td width="5%"><input class="qty4" type="text" name="harga_barang[]" style="width: 50px"></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-right" colspan="3">Nilai: </td>
                            <td >
                                <input id="total" class="total" type="text" style="width: 50px; border: none" readonly>
                            </td>
                            <td >
                                <input id="total2" class="total" type="text" style="width: 50px; border: none" readonly>
                            </td>
                            <td >
                                <input id="total3" class="total" type="text" style="width: 50px; border: none" readonly>
                            </td>
                            <td >
                                <input id="total4" class="total" type="text" style="width: 50px; border: none" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Rata - Rata: </td>
                            <td  class="avg1"></td>
                            <td  class="avg2"></td>
                            <td  class="avg3"></td>
                            <td  class="avg4"></td>

                        </tr>
                    </tfoot>
                </table>
                    <h5  class="total5">Total : <span id="total_nilai"></span></h5>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
    </div>


    @push('js')
        <script>
            ///////////////////////////////////////////////

            $(document).ready(function () {

                var total = 0;
                $(document).on("keyup", ".qty1", function() {
                    var sum = 0;
                    var avg = 0;
                    var count = 0;
                    $(".qty1").each(function(){
                        sum += +$(this).val();
                        count++;
                    });

                    total = total + sum;
                    console.log(total)
                    $("#total").val(sum);
                    $(".avg1").html(sum/count);
                    $("#total_nilai").html(total)
                });

                $(document).on("keyup", ".qty2", function() {
                    var sum = 0;
                    var count_kb = 0;
                    $(".qty2").each(function(){
                        sum += +$(this).val();
                        count_kb++;
                    });
                    total = total + sum;
                    console.log(total)
                    $("#total2").val(sum);
                    $(".avg2").html(sum/count_kb);
                    $("#total_nilai").html(total)
                });

                $(document).on("keyup", ".qty3", function() {
                    var sum = 0;
                    var count_wp = 0;
                    $(".qty3").each(function(){
                        sum += +$(this).val();
                        count_wp++;
                    });
                    total = total + sum;
                    $("#total_nilai").html(total)
                    $("#total3").val(sum);
                    $(".avg3").html(sum/count_wp);
                })

                $(document).on("keyup", ".qty4", function() {
                    var sum = 0;
                    var count_hb = 0;
                    $(".qty4").each(function(){
                        sum += +$(this).val();
                        count_hb++;
                    });

                    total = total + sum;
                    $("#total_nilai").html(total)
                    $("#total4").val(sum);
                    $(".avg4").html(sum/count_hb);
                })

            })


        /////////////////////////////////////////////////////////////////////////

        </script>
    @endpush
@endsection



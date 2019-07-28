@extends('dashboard.layouts.app')
@section('header', 'Buat Pembelian')
@section('content')

    <div class="container-fluid">
        <div class="col-md-4">
            @include('dashboard.partials.alert')
            @include('dashboard.partials.error')
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Barang</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <form action="{{ route('pembeli.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl">Tanggal</label>
                                <input type="date" name="tgl_pembelian" class="form-control" id="tgl">
                            </div>
                            <div class="form-group">
                                <label for="no_sop">No SOP</label>
                                <input type="text" name="no_sop" class="form-control " id="no_sop" placeholder="No SOP">
                            </div>
                            <div class="form-group">
                                <label>Suplier</label>
                                <select class="form-control" name="suplier_id" style="width: 100%; ">
                                    @foreach($supliers as $suplier)
                                        <option selected="selected"
                                                value="{{ $suplier->id }}">{{ $suplier->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <!-- /.card-body -->


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_barang">Nama</label>
                                <input type="text" name="nama_barang[]" class="form-control" id="nama_barang"
                                       placeholder="Nama Barang">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" min="1" name="jumlah[]" class="form-control" id="jumlah"
                                       placeholder="Jumlah Barang">
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan[]" class="form-control" id="satuan"
                                       placeholder="ex: kg">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" name="harga[]" class="form-control" id="harga"
                                       placeholder="Harga Barang">
                            </div>
                            <div class="form-barang" style="margin-top: 72px; margin-bottom: 72px">
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn-sm btn-primary float-right">Buat Pembelian</button>
                        <button type="button" id="addform" class="btn-sm btn-success float-right mr-3">
                            Tambah Barang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('js')
        <script>

            $(document).ready(function () {

                var i = 1;
                var max = 5;
                var jml_form = 0;
                $("#addform").click(function (e) {
                    if (jml_form < max) {
                        e.preventDefault();
                        $(".form-barang").append("<div><strong>Form Barang ke - ", ++i, "</strong>" +
                            "<button type=\"button\"  id=\"removeForm\" class=\"btn-sm btn-danger float-right mr-3\">Hapus</button>")
                        $(".form-barang").append(`<hr />`)
                        $(".form-barang").append(`<div class="form-group">
                                <label for="nama_barang">Nama</label>
                                <input type="text" name="nama_barang[]" class="form-control" id="nama_barang"
                                       placeholder="Nama Barang">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" min="1" name="jumlah[]" class="form-control" id="jumlah"
                                       placeholder="Jumlah Barang">
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan[]" class="form-control" id="satuan" placeholder="ex: kg">
                            </div>
                               <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" name="harga[]" class="form-control" id="harga"
                                       placeholder="Harga Barang">
                            </div></div>
                            `)
                    }
                    jml_form++
                })

                $(".form-barang").on("click", ".btn-danger", function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove()
                    jml_form--
                })
            })


        </script>
    @endpush


@endsection

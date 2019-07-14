@extends('dashboard.layouts.app')
@section('header', 'Buat Suplier')
@section('content')

    <div class="container-fluid">
        <div class="col-md-4">
            @include('dashboard.partials.alert')
        </div>

        <div class="card card-primary">
            @include('dashboard.partials.error')
            <!-- /.card-header -->
            <!-- form start -->

            <form action="{{ route('suplier.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Suplier">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control " id="alamat" placeholder="Alamat">
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon" class="form-control" id="telepon" placeholder="Telepone">
                            </div>
                        </div>
                        <!-- /.card-body -->


                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="text" min="1" name="fax" class="form-control" id="fax" placeholder="No Fax">
                            </div>
                            <div class="form-group">
                                <label for="up">UP</label>
                                <input type="text" name="up" class="form-control" id="up" placeholder="up">
                            </div>
                            <div class="form-group">
                                <label for="jenis_produksi">Jenis Produksi</label>
                                <input type="text" name="jenis_produk" class="form-control" id="jenis_produk" placeholder="Jenis Produksi">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn-sm btn-primary float-right">Buat</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

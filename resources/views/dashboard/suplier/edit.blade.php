@extends('dashboard.layouts.app')
@section('header', "Edit Suplier: $suplier->nama ")
@section('content')

    <div class="container-fluid">
        <div class="col-md-4">
            @include('dashboard.partials.alert')
        </div>

        <div class="card card-primary">

        @include('dashboard.partials.error')
        <!-- /.card-header -->
            <!-- form start -->

            <form action="{{ route('suplier.update', $suplier->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" value="{{ $suplier->nama }}" class="form-control"
                                       id="nama" placeholder="Nama Suplier">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" value="{{ $suplier->alamat }}" name="alamat" class="form-control "
                                       id="alamat" placeholder="Alamat">
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" value="{{ $suplier->telepon }}" name="telepon" class="form-control"
                                       id="telepon" placeholder="Telepone">
                            </div>
                        </div>
                        <!-- /.card-body -->


                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="text" value="{{ $suplier->fax }}" min="1" name="fax" class="form-control"
                                       id="fax" placeholder="No Fax">
                            </div>
                            <div class="form-group">
                                <label for="up">UP</label>
                                <input type="text" value="{{ $suplier->up }}" name="up" class="form-control" id="up"
                                       placeholder="up">
                            </div>
                            <div class="form-group">
                                <label for="jenis_produk">Jenis Produk</label>
                                <input type="text" value="{{ $suplier->jenis_produk }}" name="jenis_produk"
                                       class="form-control" id="jenis_produk" placeholder="Jenis Produksi">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn-sm btn-primary float-right">Simpan</button>
                        <button id="hapus" type="button"
                           onclick="hapus();"
                         class="btn-sm btn-danger float-right mr-2">Hapus</button>
                    </div>
                </div>
            </form>

            <form id="delete" action="{{ route('suplier.destroy', $suplier->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    @push('js')
    <script>
        function hapus() {
            if (!confirm('Apakah anda yakin?')) {

                return false;
            } else {
                event.preventDefault();
                document.getElementById('form-delete').submit()
            }
            return true;
        }
    </script>
    @endpush

@endsection

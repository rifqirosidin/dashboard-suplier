@extends('dashboard.layouts.app')
@section('header', 'Data Pembelian')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                @include('dashboard.partials.alert')
                <a href="{{ route('suplier.create') }}" class="btn-sm btn-primary float-right">Tambah Suplier</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th width="15%">Nama</th>
                        <th>ALamat</th>
                        <th>Telepon</th>
                        <th>Fax</th>
                        <th >up</th>
                        <th>Jenis Produk</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($supliers as $suplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $suplier->nama }}</td>
                            <td>{{ $suplier->alamat }}</td>
                            <td>{{ $suplier->telepon }}</td>
                            <td>{{ $suplier->fax }}</td>
                            <td>{{ $suplier->up }}</td>
                            <td>{{ $suplier->jenis_produk }}</td>
                            <td>
                                <a href="{{ route('suplier.edit', $suplier->id) }}" class="btn-sm btn-primary">Ubah</a>
                            </td>


                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>


    @push('js')
        <script>
            $(function () {
                $("#example1").DataTable();

            });
        </script>
    @endpush
@endsection



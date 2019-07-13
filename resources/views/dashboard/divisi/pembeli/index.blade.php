@extends('dashboard.layouts.app')
@section('header', 'Data Pembelian')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('pembeli.create') }}" class="btn btn-primary float-right">Tambah Pembelian</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th width="15%">Tanggal</th>
                        <th>Suplier</th>
                        <th>Nama Barang</th>
                        <th width="5&">jumlah</th>
                        <th width="5%">Satuan</th>
                        <th width="10%">Harga</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pembelis as $pembeli)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pembeli->tgl_pembelian }}</td>
                        <td>{{ $pembeli->suplier->nama }}</td>
                        <td> {{ $pembeli->nama_barang }}</td>
                        <td>{{ $pembeli->jumlah }}</td>
                        <td>{{ $pembeli->satuan }}</td>
                        <td>{{ $pembeli->harga }}</td>
                        <td>
                            <a href="{{ route('pembeli.edit', $pembeli->id) }}" class="btn-sm btn-primary">Edit</a>
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



@extends('dashboard.layouts.app')
@section('header', 'Data Suplier Berterima')
@section('content')

    <div class="container-fluid">
        <div class="col-md-4">
            @include('dashboard.partials.alert')
        </div>
        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th>Nama</th>
                        <th width="15%">Alamat</th>
                        <th width="6%">Telepone</th>
                        <th width="6%">Fax</th>
                        <th width="10%">Kontak</th>
                        <th width="10%">Jenis Produk</th>
                        <th width="5%">Nilai</th>
                        <th>Aksi</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($evaluasis as $evaluasi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $evaluasi->nama }} </td>
                        <td>{{ $evaluasi->alamat }}</td>
                        <td>{{ $evaluasi->telepon }}</td>
                        <td>{{ $evaluasi->fax }}</td>
                        <td>{{ $evaluasi->up }}</td>
                        <td>{{ $evaluasi->jenis_produk }}</td>
                        <td>{{ $evaluasi->nilai }}</td>

                        <td>
                            <a href="{{ route('evaluasi.create', $evaluasi->id) }}" class="btn-sm btn-primary">Beri Nilai</a>
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



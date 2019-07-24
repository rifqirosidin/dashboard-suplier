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
                            <td>{{ $evaluasi->suplier->nama }} </td>
                            <td>{{ $evaluasi->suplier->alamat }}</td>
                            <td>{{ $evaluasi->suplier->telepon }}</td>
                            <td>{{ $evaluasi->suplier->fax }}</td>
                            <td>{{ $evaluasi->suplier->up }}</td>
                            <td>{{ $evaluasi->suplier->jenis_produk }}</td>
                            @php $nilai = 0;
                            foreach($evaluasi->suplier->kriteria as $item){
                                     $nilai = $item->total_nilai;
                            }
                            @endphp
                            <td>{{ $nilai }}</td>

                            <td>
                                <a href="{{ route('evaluasi.create', $evaluasi->suplier->id) }}"
                                   class="btn-sm btn-primary">Beri Nilai</a>
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



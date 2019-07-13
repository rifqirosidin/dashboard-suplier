@extends('dashboard.layouts.app')
@section('header', 'Data Pembelian')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="col-md-4">
                 @include('dashboard.partials.alert')
                </div>
                <a href="{{ route('user.create') }}" class="btn btn-primary float-right">Tambah User</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th width="15%">Nama</th>
                        <th>Email</th>
                        <th>Akses</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->role }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                <button type="button" class="btn btn-danger"
                                onclick="event.preventDefault();document.getElementById('form-delete').submit();">
                                    Delete
                                </button>
                            </td>


                        </tr>
                    @endforeach
                </table>
                <form id="form-delete" action="{{ route('user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
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



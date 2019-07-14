@extends('dashboard.layouts.app')
@section('header', 'Buat User')
@section('content')

    <div class="container-fluid">
        <div class="col-md-4">
            @include('dashboard.partials.alert')
            @include('dashboard.partials.error')
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="name" class="form-control" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control " id="email">
                            </div>
                            <div class="form-group">
                                <label>Akses</label>
                                <select class="form-control" name="role_id" style="width: 100%; ">
                                    @foreach($roles as $role)
                                        <option  value="{{ $role->id }}" selected="selected">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn-sm btn-primary float-right">Buat</button>
                            </div>

                        </div>
                        <!-- /.card-body -->

                    </div>

                </div>
            </form>
        </div>
    </div>

    @push('js')
        <script>
            // $(function () {
            //     //Initialize Select2 Elements
            //     $('.select2').select2()
            // })
        </script>
    @endpush


@endsection

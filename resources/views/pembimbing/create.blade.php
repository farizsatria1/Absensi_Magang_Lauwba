@extends('layouts.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="m-0 text-center">Tambah Pembimbing</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary"> 
                        <!-- /.card-header -->
                        <div class="card-body p-3">
                            <form action="{{ route('pembimbing.store') }}" method="post">
                            @csrf
                                <!-- Nama Input -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" value="{{ old('nama') }}">
                                    @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- NIP Input -->
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" class="form-control" id="nip" placeholder="Masukkan NIP" value="{{ old('nip') }}">
                                    @error('nip')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password Input -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password" value="{{ old('password') }}">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@extends('layouts.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="m-0 text-center">Tambah Peserta</h1>
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
                            <form action="{{ route('peserta.store') }}" method="post">
                                @csrf
                                <!-- Nama Input -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" value="{{ old('nama') }}">
                                    @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama Panggilan</label>
                                    <input type="text" name="nama_pgl" class="form-control" id="nama_pgl" placeholder="Masukkan Nama Panggilan" value="{{ old('nama_pgl') }}">
                                    @error('nama_pgl')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Asal Input -->
                                <div class="form-group">
                                    <label for="asal">Asal</label>
                                    <input type="text" name="asal" class="form-control" id="nip" placeholder="Masukkan Asal" value="{{ old('asal') }}">
                                    @error('asal')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Asal Sekolah Input -->
                                <div class="form-group">
                                    <label for="asal_sekolah">Asal Sekolah</label>
                                    <input type="text" name="asal_sekolah" class="form-control" id="nip" placeholder="Masukkan Asal Sekolah" value="{{ old('asal_sekolah') }}">
                                    @error('asal_sekolah')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nama Pembimbing -->
                                <div class="mb-3">
                                    <label class="form-label">Pembimbing</label><br>
                                    <select class="form-select" name="id_pembimbing">
                                        <option value="">--Pilih Pembimbing--</option>
                                        @foreach ($pembimbingList as $id => $nama)
                                        <option value="{{ $id }}">{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pembimbing')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Mulai -->
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="tgl_mulai" class="form-control" placeholder="Masukan Tanggal" value="{{ old('tgl_mulai') }}">
                                    @error('tgl_mulai')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Username Input -->
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="nip" placeholder="Masukkan Username" value="{{ old('username') }}">
                                    @error('username')
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
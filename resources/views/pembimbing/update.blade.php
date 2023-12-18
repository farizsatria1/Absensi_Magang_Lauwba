@extends('layouts.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="m-0 text-center">Update Pembimbing</h1>
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
                            <form action="{{ route('pembimbing.update', ['id' => $pembimbing->id]) }}" method="post" , enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Use the PUT method for updates -->

                                <!-- Nama Input -->
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" value="{{ old('nama', $pembimbing->nama) }}">
                                    @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- NIP Input -->
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" class="form-control" id="nip" placeholder="Masukkan NIP" value="{{ old('nip', $pembimbing->nip) }}">
                                    @error('nip')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password Input -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="ttd">TTD</label>
                                    <input type="file" class="form-control-file" id="ttd" name="ttd" onchange="previewImage(event, 'preview')">
                                    <br>
                                    @if ($pembimbing->ttd)
                                    <img id="preview" src="{{ Storage::url('public/images/' . $pembimbing->ttd) }}" alt="{{ $pembimbing->ttd }}" class="img-thumbnail" width="200" style="margin-bottom: 0.5rem;">
                                    @else
                                    <p class="text-muted">Gambar tidak tersedia.</p>
                                    @endif
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
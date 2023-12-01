@extends('layouts.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="m-0 text-center">Tambah Jadwal Piket</h1>
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
                            <form action="{{ route('piket.update' ,$piket->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <!-- Nama Pembimbing -->
                                <div class="mb-3">
                                    <label class="form-label">Pembimbing</label><br>
                                    <select class="form-select" name="id_pembimbing">
                                        <option value="">--Pilih Pembimbing--</option>
                                        @foreach ($pembimbingList as $id => $nama)
                                        <option value="{{ $id }}" {{ old('id_pembimbing', $piket->id_pembimbing) == $id ? 'selected' : '' }}>
                                            {{ $nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_pembimbing')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nama Peserta -->
                                <div class="mb-3">
                                    <label class="form-label">Peserta</label><br>
                                    <select class="form-select" name="id_peserta">
                                        <option value="">--Pilih Peserta--</option>
                                        @foreach ($pesertaList as $id => $nama)
                                        <option value="{{ $id }}" {{ old('id_peserta', $piket->id_peserta) == $id ? 'selected' : '' }}>
                                            {{ $nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_peserta')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Hari Piket -->
                                <div class="mb-3">
                                    <label class="form-label">Hari Piket</label><br>
                                    <select class="form-select" name="hari">
                                        <option value="">--Pilih Hari Piket--</option>
                                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                                        <option value="{{ $hari }}" {{ old('hari', $piket->hari) == $hari ? 'selected' : '' }}>
                                            {{ $hari }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('hari')
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
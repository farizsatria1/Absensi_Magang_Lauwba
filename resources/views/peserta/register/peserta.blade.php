@extends('layouts.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Peserta</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-4">
                            <div class="col">
                                <a href="{{ route('peserta.create') }}" class="btn btn-primary">Tambah Peserta</a>
                            </div>
                            <div class="col-sm-3 text-right"> <!-- Ubah ukuran kolom agar sesuai dengan tampilan -->
                                <form action="{{ route('peserta.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">  
                                        <button type="submit" class="btn btn-warning ml-2">
                                            <i class="fas fa-search" style="color: #ffffff;"></i> <!-- Menggunakan ikon cari dari Font Awesome -->
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Panggilan</th>
                                        <th>Asal</th>
                                        <th>Pembimbing</th>
                                        <th>Asal Sekolah</th>
                                        <th>Status</th>
                                        <th>TTD</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peserta as $index => $item)
                                    <tr>
                                        <td class="align-middle">{{ $index + 1 }}</td>
                                        <td class="align-middle">{{ $item->nama }}</td>
                                        <td class="align-middle">{{ $item->nama_pgl }}</td>
                                        <td class="align-middle">{{ $item->asal }}</td>
                                        <td class="align-middle">{{ optional($item->pembimbing)->nama }}</td>
                                        <td class="align-middle">{{ $item->asal_sekolah }}</td>
                                        <td class="align-middle">{{ $item->status }}</td>
                                        <td style="text-align: center;">
                                            @if ($item->ttd)
                                            <img src="{{ Storage::url('public/images/' . $item->ttd) }}" alt="Gambar tidak tersedia" width="100" style="display: block; margin: 0 auto;">

                                            @else
                                            Gambar tidak tersedia
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('peserta.edit', $item->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i> <!-- Edit icon -->
                                            </a>
                                            <button type="submit" class="btn btn-danger" onclick="confirmDeletePeserta('{{ $item->id }}')">
                                                <i class="fas fa-trash"></i> <!-- Delete icon -->
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center mt-5">
                                {{ $peserta->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>
<br>
@endsection
@extends('layouts.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pembimbing</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col">
                                <a href="{{ route('pembimbing.create') }}" class="btn btn-primary">Tambah Pembimbing</a>
                            </div>
                            <div class="col-sm-3 text-right"> <!-- Ubah ukuran kolom agar sesuai dengan tampilan -->
                                <form action="{{ route('pembimbing.index') }}" method="GET">
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
                                        <th>Nip</th>
                                        <th>TTD</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pembimbing as $index => $item)
                                    <tr>
                                        <td class="align-middle">{{ $index + 1 }}</td>
                                        <td class="align-middle">{{ $item->nama }}</td>
                                        <td class="align-middle">{{ $item->nip }}</td>
                                        <td style="text-align: center;">
                                            @if ($item->ttd)
                                            <img src="{{ Storage::url('public/images/' . $item->ttd) }}" alt="Gambar tidak tersedia" width="100" style="display: block; margin: 0 auto;">
                                            @else
                                            Gambar tidak tersedia
                                            @endif
                                        </td>
                                        <td class="align-middle" style="text-align: center;">
                                            <a href="{{ route('pembimbing.edit', $item->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i> <!-- Edit icon -->
                                            </a>
                                            <button type="submit" class="btn btn-danger" onclick="confirmDelete('{{ $item->id }}')">
                                                <i class="fas fa-trash"></i> <!-- Delete icon -->
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center mt-5">
                                {{ $pembimbing->links('pagination::bootstrap-5') }}
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
@endsection
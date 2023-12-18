@extends('layouts.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal Piket</h1>
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
                                <a href="{{ route('piket.create') }}" class="btn btn-primary">Tambah Jadwal Piket</a>
                            </div>

                            <div class="col-sm-3 text-right"> <!-- Ubah ukuran kolom agar sesuai dengan tampilan -->
                                <form action="{{ route('piket.index') }}" method="GET">
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
                            <!-- Filter Form -->
                            <div class="row mb-4">
                                <div class="col">
                                    <form action="{{ route('piket.index') }}" method="get">
                                        <div class="form-group">
                                            <label for="filter">Tampilkan:</label>
                                            <select id="filter" class="form-control" name="filter" onchange="this.form.submit()">
                                                <option value="">Semua</option>
                                                <option value="pembimbing" {{ request('filter') == 'pembimbing' ? 'selected' : '' }}>Pembimbing</option>
                                                <option value="peserta" {{ request('filter') == 'peserta' ? 'selected' : '' }}>Peserta</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Hari Piket</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($piket as $index => $item)
                                    <tr>
                                        <td class="align-middle">{{ $index + 1 }}</td>
                                        <td class="align-middle">
                                            @if($item->peserta)
                                            {{ $item->peserta->nama }}
                                            @elseif($item->pembimbing)
                                            {{ $item->pembimbing->nama }}
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $item->hari }}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('piket.edit', $item->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i> <!-- Edit icon -->
                                            </a>
                                            <button type="submit" class="btn btn-danger" onclick="confirmDeletePiket('{{ $item->id }}')">
                                                <i class="fas fa-trash"></i> <!-- Delete icon -->
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center mt-5">
                                {{ $piket->links('pagination::bootstrap-5') }}
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
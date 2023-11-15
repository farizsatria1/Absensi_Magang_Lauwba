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
                <div class="col-sm-6 text-right">
                    <a href="{{ route('peserta.create') }}" class="btn btn-primary">Tambah Peserta</a>
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Asal</th>
                                        <th>Pembimbing</th>
                                        <th>Asal Sekolah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peserta as $index => $item)
                                    <tr>
                                        <td class="align-middle">{{ $index + 1 }}</td>
                                        <td class="align-middle">{{ $item->nama }}</td>
                                        <td class="align-middle">{{ $item->asal }}</td>
                                        <td class="align-middle">{{ optional($item->pembimbing)->nama }}</td>
                                        <td class="align-middle">{{ $item->asal_sekolah }}</td>
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

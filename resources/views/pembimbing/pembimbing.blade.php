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
                <div class="col-sm-6 text-right">
                    <a href="{{ route('pembimbing.create') }}" class="btn btn-primary">Tambah Pembimbing</a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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
                                        <th>Nip</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pembimbing as $index => $item)
                                    <tr>
                                        <td class="align-middle">{{ $index + 1 }}</td>
                                        <td class="align-middle">{{ $item->nama }}</td>
                                        <td class="align-middle">{{ $item->nip }}</td>
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
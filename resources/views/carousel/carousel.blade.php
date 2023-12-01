@extends('layouts.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Carousel Image</h1>
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
                                <a href="{{ route('carousel.create') }}" class="btn btn-primary">Tambah Gambar</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carousel as $index => $item)
                                    <tr>
                                        <td class="align-middle">{{ $index + 1 }}</td>
                                        <td style="text-align: center;">
                                            @if ($item->image)
                                            <img src="{{ Storage::url('public/images/' . $item->image) }}" alt="Gambar tidak tersedia" width="100" style="display: block; margin: 0 auto;">

                                            @else
                                            Gambar tidak tersedia
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('carousel.edit', $item->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i> <!-- Edit icon -->
                                            </a>
                                            <button type="submit" class="btn btn-danger" onclick="confirmDeleteCarousel('{{ $item->id }}')">
                                                <i class="fas fa-trash"></i> <!-- Delete icon -->
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center mt-5">
                                {{ $carousel->links('pagination::bootstrap-5') }}
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

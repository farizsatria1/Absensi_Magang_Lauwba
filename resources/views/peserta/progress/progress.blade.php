@extends('layouts.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Progress Peserta</h1>
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
                            <form method="get" action="{{ route('progress.filter') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="participant">Nama Peserta:</label>
                                    <select class="form-control" id="participant" name="participant">
                                        <option value="">--Pilih Peserta--</option>
                                        @php
                                        $selectedPeserta = request('participant');
                                        @endphp
                                        @foreach($pesertaList as $pesertaId => $pesertaName)
                                        <option value="{{ $pesertaId }}" {{ $pesertaId == $selectedPeserta ? 'selected' : '' }}>
                                            {{ $pesertaName }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mb-3">Filter</button>
                            </form>
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Judul</th>
                                        <th>Catatan</th>
                                        <th>Foto Dokumentasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($progress as $index => $item)
                                    <tr>
                                        <td class="align-middle">{{ $index + 1 }}</td>
                                        <td class="align-middle">{{ $item->pekerjaan->peserta->nama }}</td>
                                        <td class="align-middle">{{ $item->pekerjaan->judul }}</td>
                                        <td class="align-middle">{{ $item->catatan }}</td>
                                        <td style="text-align: center;">
                                            @if ($item->foto_dokumentasi)
                                            <img src="{{ asset($item->foto_dokumentasi) }}" alt="$item->pekerjaan->judul" width="100" style="display: block; margin: 0 auto;">
                                            @else
                                            Gambar tidak tersedia
                                            @endif
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
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
                            <form id="filterForm" method="get" action="{{ route('progress.filter') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="participant">Nama Peserta:</label>
                                    <select class="form-control" id="participant" name="participant" onchange="submitForm()">
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
                            </form>

                            <!-- Display the "Cetak" button only if a participant is selected -->
                            @if ($selectedPeserta)
                            <a href="/cetak-progress/{{$selectedPeserta}}" class="btn btn-primary mb-3 br-10">
                                <i class="fas fa-print mr-1"></i> Cetak
                            </a>

                            @endif

                            <table class="table table-b ordered table-striped text-center">
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
                                            <img src="{{ Storage::url('public/images/' . $item->foto_dokumentasi) }}" alt="Gambar tidak tersedia" width="100" style="display: block; margin: 0 auto;">
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

<script>
    function submitForm() {
        document.getElementById("filterForm").submit();
    }
</script>

@endsection
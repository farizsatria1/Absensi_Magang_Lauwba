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
                            <form action="{{ route('piket.store') }}" method="post">
                                @csrf
                                <!-- Pilih Kategori (Peserta/Pembimbing) -->
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label><br>
                                    <select class="form-select" id="kategori" name="kategori">
                                        <option value="">--Pilih Peserta Piket--</option>
                                        <option value="Peserta">Peserta</option>
                                        <option value="Pembimbing">Pembimbing</option>
                                    </select>
                                </div>

                                <!-- Nama Peserta (tampilkan jika kategori = Peserta) -->
                                <div class="mb-3" id="pesertaInput">
                                    <label class="form-label">Peserta</label><br>
                                    <select class="form-select" name="id_peserta">
                                        <option value="">--Pilih Peserta--</option>
                                        @foreach ($pesertaList as $id => $nama)
                                        <option value="{{ $id }}">{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_peserta')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nama Pembimbing (tampilkan jika kategori = Pembimbing) -->
                                <div class="mb-3" id="pembimbingInput">
                                    <label class="form-label">Pembimbing</label><br>
                                    <select class="form-select" name="id_pembimbing">
                                        <option value="">--Pilih Pembimbing--</option>
                                        @foreach ($pembimbingList as $id => $nama)
                                        <option value="{{ $id }}">{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pembimbing')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Hari Piket -->
                                <div class="mb-3">
                                    <label class="form-label">Hari Piket</label><br>
                                    <select class="form-select" name="hari">
                                        <option value="">--Pilih Hari Piket--</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                    </select>
                                    @error('piket')
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

<script>
    // Mendapatkan elemen dropdown kategori
    var kategoriDropdown = document.getElementById('kategori');

    // Mendapatkan elemen input untuk peserta dan pembimbing
    var pesertaInput = document.getElementById('pesertaInput');
    var pembimbingInput = document.getElementById('pembimbingInput');

    // Menyembunyikan kedua input saat halaman dimuat
    pesertaInput.style.display = 'none';
    pembimbingInput.style.display = 'none';

    // Menampilkan atau menyembunyikan input berdasarkan pilihan kategori
    kategoriDropdown.addEventListener('change', function() {
        var selectedKategori = kategoriDropdown.value;

        // Menyembunyikan kedua input terlebih dahulu
        pesertaInput.style.display = 'none';
        pembimbingInput.style.display = 'none';

        // Menampilkan input yang sesuai dengan kategori yang dipilih
        if (selectedKategori === 'Peserta') {
            pesertaInput.style.display = 'block';
        } else if (selectedKategori === 'Pembimbing') {
            pembimbingInput.style.display = 'block';
        }
    });
</script>

@endsection
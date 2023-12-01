@extends('layouts.default')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="m-0 text-center text-primary">Update Gambar</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-outline card-primary">
                        <!-- /.card-header -->
                        <div class="card-body p-3">
                            <form action="{{ route('carousel.update', $carousel->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Gambar</label>
                                    @if ($carousel->image)
                                    <img id="preview" src="{{ Storage::url('public/images/' . $carousel->image) }}" alt="{{ $carousel->image }}" class="img-thumbnail" width="200" style="margin-bottom: 0.5rem;">
                                    @else
                                    <p class="text-muted">Gambar tidak tersedia.</p>
                                    @endif
                                    <br>
                                    <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event, 'preview')">
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

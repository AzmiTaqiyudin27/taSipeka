@extends('unitkerja.unitkerja_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ubah Pengajuan Audit Sistem Informasi Insidental</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/dashboard-unitkerja">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="pelaporanInsidental.html">Pelaporan Audit Sistem Informasi
                                    Insidental</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                  <form action="{{ route('pengajuan-insidental.update', $laporan->id) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf

    <div class="form-group">
        <label for="tanggal_lapor" class="form-label">Tanggal Lapor</label>
        <input type="date" name="tanggal_lapor" id="tanggal_lapor" class="form-control" placeholder="Tanggal Lapor"
               value="{{ $laporan->tanggal_lapor }}" required>
    </div>

    <div class="form-group">
        <label for="nama_sistem" class="form-label">Nama Sistem</label>
        <input type="text" name="nama_sistem" id="nama_sistem" class="form-control" placeholder="Nama Sistem"
               value="{{ $laporan->nama_sistem }}" required>
    </div>

    <div class="form-group">
        <label for="kendala" class="form-label">Kendala</label>
        <input type="text" name="kendala" id="kendala" class="form-control" placeholder="Kendala"
               value="{{ $laporan->kendala }}" required>
    </div>

    <div class="form-group">
        <label for="keterangan" class="form-label">Keterangan</label>
        <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan"
               value="{{ $laporan->keterangan }}" required>
    </div>

    <!-- Display existing photos -->
    <div class="form-group">
        <label for="existing_foto" class="form-label">Foto yang Sudah Diupload</label>
        <div>
            @php
                // Jika foto disimpan sebagai JSON atau string yang dipisahkan koma
                $fotos = json_decode($laporan->foto, true) ?? explode(',', $laporan->foto);
            @endphp
            @foreach ($fotos as $index => $foto)
                <div class="mb-3">
                    <label for="existing_foto_{{ $index }}">Foto {{ $index + 1 }}</label>
                    <div>
                        <a href="{{ url('foto/' . trim($foto)) }}" target="_blank">{{ trim($foto) }}</a>
                    </div>
                    <input type="file" name="foto_update[{{ $index }}]" class="form-control mt-2">
                    <input type="hidden" name="existing_foto[{{ $index }}]" value="{{ $foto }}">
                </div>
            @endforeach
        </div>
    </div>

    <!-- Input for adding new photos -->
    <div class="form-group">
        <label for="foto" class="form-label">Unggah Foto Baru (Tambahan)</label>
        <input type="file" name="foto[]" id="foto" class="form-control" multiple>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Ubah</button>
    </div>
</form>
                </div>
            </div>
        </div>
    @endsection

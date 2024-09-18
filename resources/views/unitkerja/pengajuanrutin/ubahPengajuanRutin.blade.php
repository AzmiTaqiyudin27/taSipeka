@extends('unitkerja.unitkerja_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ubah Pelaporan Audit Sistem Informasi Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pengajuan-rutin.index') }}">Pelaporan Audit
                                    Sistem Informasi Rutin</a></li>
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
                   <form action="{{ route('pengajuan-rutin.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
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
        <label for="versi" class="form-label">Versi</label>
        <input type="text" name="versi" id="versi" class="form-control" placeholder="Versi"
               value="{{ $laporan->versi }}" required>
    </div>

    <div class="form-group">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi"
               value="{{ $laporan->deskripsi }}" required>
    </div>

    <!-- Display existing documents -->
    <div class="form-group">
        <label for="existing_dokumen" class="form-label">Dokumen yang Sudah Diupload</label>
        <div>
            @php
                // Jika dokumen disimpan sebagai JSON atau string yang dipisahkan koma
                $dokumens = json_decode($laporan->dokumen, true) ?? explode(',', $laporan->dokumen);
            @endphp
            @foreach ($dokumens as $index => $dokumen)
                <div class="mb-3">
                    <label for="existing_dokumen_{{ $index }}">Dokumen {{ $index + 1 }}</label>
                    <div>
                        <a href="{{ url('dokumen/' . trim($dokumen)) }}" target="_blank">{{ trim($dokumen) }}</a>
                    </div>
                    <input type="file" name="dokumen_update[{{ $index }}]" class="form-control mt-2">
                    <input type="hidden" name="existing_dokumen[{{ $index }}]" value="{{ $dokumen }}">
                </div>
            @endforeach
        </div>
    </div>

    <!-- Input for adding new documents -->
    <div class="form-group">
        <label for="dokumen" class="form-label">Unggah Dokumen Baru (Tambahan)</label>
        <input type="file" name="dokumen[]" id="dokumen" class="form-control" multiple>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Ubah</button>
    </div>
</form>

                </div>
            </div>
        </div>
    @endsection

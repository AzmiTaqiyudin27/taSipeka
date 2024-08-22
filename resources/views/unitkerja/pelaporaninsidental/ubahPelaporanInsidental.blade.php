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
                    <form action="{{ route('pelaporan-insidental.update', $laporan->id) }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="tanggal_lapor" class="form-label">Tanggal Lapor</label>
                            <input type="date" name="tanggal_lapor" id="tanggal_lapor" class="form-control"
                                placeholder="Tanggal Lapor" value="{{ $laporan->tanggal_lapor }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_sistem" class="form-label">Nama Sistem</label>
                            <input type="text" name="nama_sistem" id="nama_sistem" class="form-control"
                                placeholder="Nama Sistem" value="{{ $laporan->nama_sistem }}" required>
                        </div>
                        <div class="form-group">
                            <label for="kendala" class="form-label">Kendala</label>
                            <input type="text" name="kendala" id="kendala" class="form-control" placeholder="kendala"
                                value="{{ $laporan->kendala }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="longText" name="keterangan" id="keterangan" class="form-control"
                                placeholder="keterangan" value="{{ $laporan->keterangan }}" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="foto" class="form-label">foto</label>
                            <input type="string" name="foto[]" id="foto" class="form-control" placeholder="foto"
                                value="{{ $laporan->foto }}" required multiple>
                        </div> --}}
                        <div class="form-group">
                            <label for="existing_dokumen" class="form-label">Dokumen yang Sudah Diupload</label>
                            <div>
                                @php
                                    $dokumens = explode(',', $laporan->foto);
                                @endphp
                                @foreach ($dokumens as $dokumen)
                                    <div>
                                        <a href="{{ url('dokumen/' . trim($dokumen)) }}"
                                            target="_blank">{{ trim($dokumen) }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dokumen" class="form-label">Unggah Dokumen Baru</label>
                            <input type="file" name="foto[]" id="dokumen" class="form-control" multiple>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

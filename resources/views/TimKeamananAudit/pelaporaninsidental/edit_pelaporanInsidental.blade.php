@extends('TimKeamananAudit.keamananaudit_layout')

@section('content')


    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ubah  Pelaporan Audit Insidental</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/auth/dashboard-audit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/auth/pelaporan-rutin">Pelaporan Audit Sistem Informasi Insidental</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if (session('suksessimpan'))
        <div class="alert alert-success col-md-8">
            {{ session('suksessimpan') }}
        </div>
    @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif




        <section class="section">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form class="formTambahAudit" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value={{ auth()->user()->id }}>
                            <input type="hidden" id="id" value={{ $auditInsidental->id }}>

                            <div class="form-group">
                                <label for="" class="form-label">Nama Sistem</label>
                                <select name="kode_audit" class="form-select">
                                    <option class="form-option" value="{{ $kodeAudit[0]->kode_audit}}" selected="">{{ $kodeAudit[0]->nama_sistem }}</option>
                      
                                            </select>
                            </div>
                            {{-- <div class="loading d-none">
                                <p>Loading...</p>
                            </div> --}}
                            <div class="formubahan">
                          <input type="hidden" name="_method" value="PUT">                        
                          
                                <div class="form-group">
                                    <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                                    <input type="date" value="{{ $auditInsidental->tanggal_audit }}" name="tanggal_audit" id="tanggal_audit" class="form-control" required="" placeholder="Tanggal Akhir">
                                </div>
                                    <div class="form-group">
                                    <label for="" class="form-label">Unitkerja</label>
                                     <select name="unitkerja_id" class="form-select">
              <option class="form-option" value="{{ $auditInsidental->unitkerja_id }}" selected="">{{ $unitKerja[0]->username}}</option>
s
                      </select>
                                </div>


                                 <div class="form-group">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" value="{{ $auditInsidental->judul }}" name="judul" id="judul" class="form-control" placeholder="Judul">
                </div>
                             <div class="form-group">
                                    <label for="versi" class="form-label">Versi</label>
                                    <input type="text" name="versi" id="versi" class="form-control" placeholder="Versi" value="{{ $auditInsidental->versi }}">
                                </div>

                                <div class="form-group">
                    <label for="pendahuluan" class="form-label">Pendahuluan</label>
                    <textarea name="pendahuluan" id="pendahuluan" class="form-control ckeditor" placeholder="Pendahuluan">
                    {{$auditInsidental->pendahuluan}} 
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="cakupan_audit" class="form-label">Cakupan Audit</label>
                    <textarea name="cakupan_audit" id="cakupan_audit"  class="form-control ckeditor" placeholder="Cakupan Audit">
                    {{$auditInsidental->cakupan_audit}} 
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="tujuan_audit" class="form-label">Tujuan Audit</label>
                    <textarea name="tujuan_audit" id="tujuan_audit" class="form-control ckeditor" placeholder="Tujuan Audit">
                    {{$auditInsidental->tujuan_audit}} 
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="metodologi_audit" class="form-label">Metodologi Audit</label>
                    <textarea name="metodologi_audit" id="metodologi_audit" class="form-control ckeditor" placeholder="Metodologi Audit">
                    {{$auditInsidental->metodologi_audit}} 
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="hasil_audit" class="form-label">Hasil Audit</label>
                    <textarea name="hasil_audit" id="hasil_audit" class="form-control ckeditor" placeholder="Hasil Audit">
                    {{$auditInsidental->hasil_audit}} </textarea>
                </div>

                <div class="form-group">
                    <label for="rekomendasi" class="form-label">Rekomendasi</label>
                    <textarea name="rekomendasi" id="rekomendasi" class="form-control ckeditor" placeholder="Rekomendasi">
                    {{$auditInsidental->rekomendasi}} </textarea>
                </div>
                <div class="form-group">
                    <label for="kesimpulan" class="form-label">Kesimpulan Audit</label>
                    <textarea name="kesimpulan_audit" id="kesimpulan" class="form-control ckeditor" placeholder="Kesimpulan Audit">
                    {{$auditInsidental->kesimpulan_audit}} </textarea>
                </div>


                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status" id="status" aria-label="Contoh Select" disabled>
                        <option>Status</option>
                        <option value="draft" 
                            {{ $auditInsidental->status === 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>
                        <option value="proses" 
                            {{ $auditInsidental->status === 'proses' ? 'selected' : '' }}>
                            Proses
                        </option>
                    </select>
                </div>

  

                                <div class="form-group">
                                    <label for="tanggal_proses" class="form-label">Tanggal Proses</label>
                                    <input type="date" disabled value="{{ $auditInsidental->tanggal_proses }}" name="tanggal_proses" id="tanggal_proses" class="form-control" placeholder="Tanggal Proses">
                        </div>
                        <!-- Display existing photos -->
   <div class="form-group">
    <label for="existing_foto" class="form-label">Lampiran yang Sudah Diupload</label>
    <div>
        @php
            // Jika foto disimpan sebagai JSON atau string yang dipisahkan koma
            $lampirans = json_decode($auditInsidental->lampiran, true) ?? explode(',', $auditInsidental->lampiran);
        @endphp
        @foreach ($lampirans as $index => $lamp)
            <div class="mb-3">
                <label for="existing_foto_{{ $index }}">Lampiran {{ $index + 1 }}</label>
                <div>
                    <a href="{{ url('lampiran/' . trim($lamp)) }}" target="_blank">{{ trim($lamp) }}</a>
                </div>
                <input type="file" name="lampiran_update[{{ $index }}]" class="form-control mt-2">
                <input type="hidden" name="existing_lampiran[{{ $index }}]" value="{{ $lamp }}">
            </div>
        @endforeach
    </div>
</div>

<!-- Input for adding new photos -->
<div class="form-group">
    <label for="foto" class="form-label">Unggah Lampiran Baru (Tambahan)</label>
    <input type="file" name="lampiran[]" id="lampiran" class="form-control" multiple>
</div>

                        <div class="form-group">
                        <button type="button" class="btn btn-primary" id="updateButton">Update</button>
                        <button type="button" class="btn btn-success" id="processButton">Proses</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>


    <!-- Modal -->
    <!-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Edit Modal -->
    <!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Edit Audit</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="editForm" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                            <input type="date" name="tanggal_audit" id="tglaudit" class="form-control"
                                placeholder="Tanggal Audit" required>
                        </div>

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="form-group">
                            <label for="versi" class="form-label">Versi</label>
                            <input type="text" name="versi" id="versiaudit" class="form-control"
                                placeholder="Versi">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" aria-label="Contoh Select">
                                <option value="draft" selected>Draft</option>
                                <option selected value="proses">Proses</option>

                            </select>
                        </div>  
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div> -->

<script>
       document.querySelectorAll('.ckeditor').forEach(function(
                            editorElement) {
                            ClassicEditor
                                .create(editorElement, {
                                    ckfinder: {
                                        uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
                                    },

                                })
                                .then(editor => {
                                    console.log('Editor was initialized',
                                        editor);
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        });

                        var form = $(".formTambahAudit");
                        const id = $("#id").val();

                        // Event untuk tombol "Update"
    $("#updateButton").on("click", function() {
        form.attr("action", "{{ route('pelaporan-insidental.update', '') }}/" + id);
        form.submit(); // Submit form

    });

    // Event untuk tombol "Proses"
    $("#processButton").on("click", function() {
        console.log("Cek proses 1")

        form.attr("action", "{{ route('pelaporan-insidental.proses', '') }}/" + id); // Ganti dengan route proses
        
        form.submit(); // Submit form
    });
                        </script>


@endsection


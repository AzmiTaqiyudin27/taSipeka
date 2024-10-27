@extends('TimKeamananAudit.keamananaudit_layout')

@section('content')


    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ubah Pelaporan Audit Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/auth/dashboard-audit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/auth/pelaporan-rutin">Pelaporan Audit Sistem Informasi Rutin</a></li>
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
                        <form class="formTambahAudit" method="post" enctype="multipart/form-data" action="{{ route('pelaporan-rutin.update', $auditRutin->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value={{ auth()->user()->id }}>
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
                                    <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                                    <input type="date" value="{{ $auditRutin->tanggal_awal }}" name="tanggal_awal" id="tanggal_awal" class="form-control" required="" placeholder="Tanggal Awal">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                                    <input type="date" value="{{ $auditRutin->tanggal_akhir }}" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required="" placeholder="Tanggal Akhir">
                                </div>
                                    <div class="form-group">
                                    <label for="" class="form-label">Unitkerja</label>
                                     <select name="unitkerja_id" class="form-select">
              <option class="form-option" value="{{ $auditRutin->unitkerja_id }}" selected="">{{ $unitKerja[0]->username}}</option>
s
                      </select>
                                </div>


                                 <div class="form-group">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" value="{{ $auditRutin->judul }}" name="judul" id="judul" class="form-control" placeholder="Judul">
                </div>
                             <div class="form-group">
                                    <label for="versi" class="form-label">Versi</label>
                                    <input type="text" name="versi" id="versi" class="form-control" placeholder="Versi" value="{{ $auditRutin->versi }}">
                                </div>

                                <div class="form-group">
                    <label for="pendahuluan" class="form-label">Pendahuluan</label>
                    <textarea name="pendahuluan" id="pendahuluan" class="form-control ckeditor" placeholder="Pendahuluan">
                    {{$auditRutin->pendahuluan}} 
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="cakupan_audit" class="form-label">Cakupan Audit</label>
                    <textarea name="cakupan_audit" id="cakupan_audit"  class="form-control ckeditor" placeholder="Cakupan Audit">
                    {{$auditRutin->cakupan_audit}} 
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="tujuan_audit" class="form-label">Tujuan Audit</label>
                    <textarea name="tujuan_audit" id="tujuan_audit" class="form-control ckeditor" placeholder="Tujuan Audit">
                    {{$auditRutin->tujuan_audit}} 
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="metodologi_audit" class="form-label">Metodologi Audit</label>
                    <textarea name="metodologi_audit" id="metodologi_audit" class="form-control ckeditor" placeholder="Metodologi Audit">
                    {{$auditRutin->metodologi_audit}} 
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="hasil_audit" class="form-label">Hasil Audit</label>
                    <textarea name="hasil_audit" id="hasil_audit" class="form-control ckeditor" placeholder="Hasil Audit">
                    {{$auditRutin->hasil_audit}} </textarea>
                </div>

                <div class="form-group">
                    <label for="rekomendasi" class="form-label">Rekomendasi</label>
                    <textarea name="rekomendasi" id="rekomendasi" class="form-control ckeditor" placeholder="Rekomendasi">
                    {{$auditRutin->rekomendasi}} </textarea>
                </div>
                <div class="form-group">
                    <label for="kesimpulan" class="form-label">Kesimpulan Audit</label>
                    <textarea name="kesimpulan_audit" id="kesimpulan" class="form-control ckeditor" placeholder="Kesimpulan Audit">
                    {{$auditRutin->kesimpulan_audit}} </textarea>
                </div>


                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status"
                                        aria-label="Contoh Select">
                                        <option>Status</option>
                                        <option value="draft">Draft</option>
                                        <option value="proses">Proses</option>

                                    </select>
                                </div>

  <div class="formtambahan">
                                <div id="fileInputsContainer" class="form-group">
    <label for="lampiran" class="form-label">Lampiran</label>
    
   
    <br>
        {{$auditRutin->lampiran ? "Sudah adalah lampiran yaitu". $auditRutin->lampiran." " : "Belum ada lampiran"}}

    <input 
        type="file" 
        name="lampiran[]" 
        id="lampiran" 
        class="form-control mb-3" 
        placeholder="Lampiran"
    >
</div>

                            
                                <!-- Elemen untuk Menampilkan Nama File yang Dipilih -->
                                <div class="form-group">
                                    <label>File yang Dipilih:</label>
                                    <ul id="fileList"></ul> <!-- Ini adalah tempat nama file yang akan ditampilkan -->
                                </div>
                            
                                <!-- Tombol untuk menambahkan input file lagi -->
                                <div class="form-group">
                                    <button type="button" id="addFileInputBtn" class="btn btn-primary" onclick="addFormTambahan()">Tambah File Lain</button>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_proses" class="form-label">Tanggal Proses</label>
                                    <input type="date" value="{{ $auditRutin->tanggal_proses }}" name="tanggal_proses" id="tanggal_proses" class="form-control" placeholder="Tanggal Proses">
                        </div>

                        <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="updateButton">Update</button>
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

                        // Event untuk tombol "Update"
    $("#updateButton").on("click", function() {
        form.attr("action", "{{ route('pelaporan-rutin.update', '') }}/" + id);
        form.submit(); // Submit form

    });

    // Event untuk tombol "Proses"
    $("#processButton").on("click", function() {
        console.log("Cek proses 1")

        form.attr("action", "{{ route('pelaporan-rutin.prosess', '') }}/" + id); // Ganti dengan route proses
        form.submit(); // Submit form
    });
                        </script>


@endsection


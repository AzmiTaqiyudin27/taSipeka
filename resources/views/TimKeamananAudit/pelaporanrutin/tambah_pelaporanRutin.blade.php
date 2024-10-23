@extends('TimKeamananAudit.keamananaudit_layout')

@section('content')


    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Pelaporan Audit Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/auth/dashboard-audit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/auth/pelaporan-rutin">Pelaporan Audit Sistem Informasi
                                    Rutin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
                        <form class="formTambahAudit" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="form-group">
                                <label for="" class="form-label">Pilih Sistem</label>
                                <select name="kode_audit" class="pilihsistem form-select">
                                    <option class="form-option" value="">-Nama Sistem-</option>
                                    @foreach ($kodeaudit as $item)
                                        <option class="form-option" value="{{ $item->kode_audit }}">
                                            {{ $item->nama_sistem }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="loading d-none">
                                <p>Loading...</p>
                            </div>
                            <div class="formtambahan">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
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
    </div>




@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    $(document).ready(function() {
        // Select/Deselect all checkboxes
        $('#selectAll').click(function() {
            $('.rowCheckbox').prop('checked', this.checked);
        });

        // If any checkbox is unchecked, deselect the "Select All" checkbox
        $('.rowCheckbox').change(function() {
            if (!$(this).prop('checked')) {
                $('#selectAll').prop('checked', false);
            }

            // If all checkboxes are checked, select the "Select All" checkbox
            if ($('.rowCheckbox:checked').length == $('.rowCheckbox').length) {
                $('#selectAll').prop('checked', true);
            }
        });

        $(".pilihsistem").change(function() {
            console.log($(this).val());
            var id = $(this).val();
            var url = "{{ route('getAudit', '') }}/" + id;
            $(".formtambahan").empty();
            $(".loading").toggleClass("d-none");
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $(".loading").toggleClass("d-none");
                    console.log(response);
                    if (response.auditRutin.length > 0) {
                        var form = $(".formTambahAudit");
                        var id = response.auditRutin[0].id;
                        var action = "{{ route('pelaporan-rutin.update', '') }}/" + id;
                        form.attr("action", action)
                        var selectedUnitKerjaId = response.auditRutin[0].unitkerja_id;
                        var data = `
                          @method('PUT')
                        <div class="form-group">
                                    <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                                    <input type="date" value="${response.auditRutin[0].tanggal_audit}" name="tanggal_audit"
                                        id="tanggal_audit" class="form-control" required placeholder="Tanggal Audit">
                                </div>
                                    <div class="form-group">
                                    <label for="" class="form-label">Unitkerja</label>
                                     <select name="unitkerja_id" class="form-select">
                <option class="form-option" value="">-Unit Kerja-</option>
                     ${$.map(response.unitKerja, function(item) {
                    // Cek jika item.id sama dengan selectedUnitKerjaId
                    console.log(item.id);
                       var isSelected = item.id === selectedUnitKerjaId ? 'selected' : '';
                     return `<option class="form-option" value="${item.id}" ${isSelected}>${item.username}</option>`;
                        }).join('')}
                      </select>
                                </div>


                                 <div class="form-group">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" value="${response.auditRutin[0].judul}" name="judul" id="judul" class="form-control" placeholder="Judul" >
                </div>
                             <div class="form-group">
                                    <label for="versi" class="form-label">Versi</label>
                                    <input type="text" name="versi" id="versi" class="form-control"
                                        placeholder="Versi" value="${response.auditRutin[0].versi}">
                                </div>

                               <div class="form-group">
                    <label for="pendahuluan" class="form-label">Pendahuluan</label>
                    <textarea name="pendahuluan" id="pendahuluan" class="form-control ckeditor" placeholder="Pendahuluan">
                    ${response.auditRutin[0].pendahuluan}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="cakupan_audit" class="form-label">Cakupan Audit</label>
                    <textarea name="cakupan_audit" id="cakupan_audit"  class="form-control ckeditor" placeholder="Cakupan Audit">
                    ${response.auditRutin[0].cakupan_audit}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="tujuan_audit" class="form-label">Tujuan Audit</label>
                    <textarea name="tujuan_audit" id="tujuan_audit" class="form-control ckeditor" placeholder="Tujuan Audit">
                    ${response.auditRutin[0].tujuan_audit}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="metodologi_audit" class="form-label">Metodologi Audit</label>
                    <textarea name="metodologi_audit" id="metodologi_audit" class="form-control ckeditor" placeholder="Metodologi Audit">
                    ${response.auditRutin[0].metodologi_audit}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="hasil_audit" class="form-label">Hasil Audit</label>
                    <textarea name="hasil_audit" id="hasil_audit" class="form-control ckeditor" placeholder="Hasil Audit">
                     ${response.auditRutin[0].hasil_audit}</textarea>
                </div>

                <div class="form-group">
                    <label for="rekomendasi" class="form-label">Rekomendasi</label>
                    <textarea name="rekomendasi" id="rekomendasi" class="form-control ckeditor" placeholder="Rekomendasi">
                     ${response.auditRutin[0].rekomendasi}</textarea>
                </div>
                <div class="form-group">
                    <label for="kesimpulan" class="form-label">Kesimpulan Audit</label>
                    <textarea name="kesimpulan_audit" id="kesimpulan" class="form-control ckeditor" placeholder="Kesimpulan Audit">
                     ${response.auditRutin[0].kesimpulan_audit}</textarea>
                </div>


                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status"
                                        aria-label="Contoh Select">
                                        <option>Status</option>
                                        <option selected value="draft">Draft</option>
                                        <option value="proses">Proses</option>

                                    </select>
                                </div>

                                    



                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>`;


                        $(".formtambahan").append(data);
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

                        function validateForm() {
                            let valid = true;
                            document.querySelectorAll('.ckeditor').forEach(function(
                                editorElement) {
                                if (editorElement.style.display !== 'none') {
                                    let editorData = editorElement.closest(
                                        '.ck-editor').querySelector(
                                        '.ck-content').innerHTML;
                                    if (editorData.trim() === '') {
                                        alert(
                                            'Please fill out all required fields.'
                                        );
                                        valid = false;
                                    }
                                }
                            });
                            return valid;
                        }

                    } else if(response.auditProses)
                    {  var form = $(".formTambahAudit");
                        var id = response.auditProses.id;
                        var action = "{{ route('tambahAuditRutin') }}";
                        form.attr("action", action)
                        var selectedUnitKerjaId = response.auditProses.unitkerja_id;
                        var data = `

                        <div class="form-group">
                                    <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                                    <input type="date" value="${response.auditProses.tanggal_audit}" name="tanggal_audit"
                                        id="tanggal_audit" class="form-control" placeholder="Tanggal Audit required">
                                </div>
                                    <div class="form-group">
                                    <label for="" class="form-label">Unitkerja</label>
                                     <select name="unitkerja_id" class="form-select">
                <option class="form-option" value="">-Unit Kerja-</option>
                     ${$.map(response.unitKerja, function(item) {
                    // Cek jika item.id sama dengan selectedUnitKerjaId
                    console.log(item.id);
                       var isSelected = item.id === selectedUnitKerjaId ? 'selected' : '';
                     return `<option class="form-option" value="${item.id}" ${isSelected}>${item.username}</option>`;
                        }).join('')}
                      </select>
                                </div>


                                 <div class="form-group">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" value="${response.auditProses.judul}" name="judul" id="judul" class="form-control" placeholder="Judul" >
                </div>
                             <div class="form-group">
                                    <label for="versi" class="form-label">Versi</label>
                                    <input type="text" name="versi" id="versi" class="form-control"
                                        placeholder="Versi" value="${response.auditProses.versi}">
                                </div>

                               <div class="form-group">
                    <label for="pendahuluan" class="form-label">Pendahuluan</label>
                    <textarea name="pendahuluan" id="pendahuluan" class="form-control ckeditor" placeholder="Pendahuluan">
                    ${response.auditProses.pendahuluan}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="cakupan_audit" class="form-label">Cakupan Audit</label>
                    <textarea name="cakupan_audit" id="cakupan_audit"  class="form-control ckeditor" placeholder="Cakupan Audit">
                    ${response.auditProses.cakupan_audit}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="tujuan_audit" class="form-label">Tujuan Audit</label>
                    <textarea name="tujuan_audit" id="tujuan_audit" class="form-control ckeditor" placeholder="Tujuan Audit">
                    ${response.auditProses.tujuan_audit}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="metodologi_audit" class="form-label">Metodologi Audit</label>
                    <textarea name="metodologi_audit" id="metodologi_audit" class="form-control ckeditor" placeholder="Metodologi Audit">
                    ${response.auditProses.metodologi_audit}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="hasil_audit" class="form-label">Hasil Audit</label>
                    <textarea name="hasil_audit" id="hasil_audit" class="form-control ckeditor" placeholder="Hasil Audit">
                     ${response.auditProses.hasil_audit}</textarea>
                </div>

                <div class="form-group">
                    <label for="rekomendasi" class="form-label">Rekomendasi</label>
                    <textarea name="rekomendasi" id="rekomendasi" class="form-control ckeditor" placeholder="Rekomendasi">
                     ${response.auditProses.rekomendasi}</textarea>
                </div>
                <div class="form-group">
                    <label for="kesimpulan" class="form-label">Kesimpulan Audit</label>
                    <textarea name="kesimpulan_audit" id="kesimpulan" class="form-control ckeditor" placeholder="Kesimpulan Audit">
                     ${response.auditProses.kesimpulan_audit}</textarea>
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
        ${response.auditProses.lampiran ? `Sudah adalah lampiran yaitu ${response.auditProses.lampiran}` : "Belum ada lampiran"}

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
                            </div>
    
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>`;

                                
                        $(".formtambahan").append(data);
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

                        

                               // Menambah input file baru saat tombol 'Tambah File Lain' diklik


                        function validateForm() {
                            let valid = true;
                            document.querySelectorAll('.ckeditor').forEach(function(
                                editorElement) {
                                if (editorElement.style.display !== 'none') {
                                    let editorData = editorElement.closest(
                                        '.ck-editor').querySelector(
                                        '.ck-content').innerHTML;
                                    if (editorData.trim() === '') {
                                        alert(
                                            'Please fill out all  fields.'
                                        );
                                        valid = false;
                                    }
                                }
                            });
                            return valid;
                        }

                    }
                    else {
                        console.log("anjay");


                        var form = $(".formTambahAudit");

                        var action = "{{ route('tambahAuditRutin') }}";
                        form.attr("action", action)
                        var data = `

                        <div class="form-group">
                                    <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                                    <input type="date"  name="tanggal_audit"
                                        id="tanggal_audit" class="form-control" value="" required placeholder="Tanggal Audit">
                                </div>
                                    <div class="form-group">
                                    <label for="" class="form-label">Unitkerja</label>
                                   <select name="unitkerja_id" class="form-select">
                <option class="form-option" value="">-Unit Kerja-</option>
                     ${$.map(response.unitKerja, function(item) {
                    // Cek jika item.id sama dengan selectedUnitKerjaId
                    console.log(item.id);

                     return `<option class="form-option" value="${item.id}" >${item.username}</option>`;
                        }).join('')}
                      </select>
                                </div>


                                 <div class="form-group">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text"  name="judul" id="judul" class="form-control"  placeholder="Judul" >
                </div>
                             <div class="form-group">
                                    <label for="versi" class="form-label">Versi</label>
                                    <input type="text" name="versi" id="versi"  class="form-control"
                                        placeholder="Versi">
                                </div>

                               <div class="form-group">
                    <label for="pendahuluan" class="form-label">Pendahuluan</label>
                    <textarea name="pendahuluan" id="pendahuluan" class="form-control ckeditor"  placeholder="Pendahuluan">

                    </textarea>
                </div>

                <div class="form-group">
                    <label for="cakupan_audit" class="form-label">Cakupan Audit</label>
                    <textarea name="cakupan_audit" id="cakupan_audit"  class="form-control ckeditor" placeholder="Cakupan Audit">

                    </textarea>
                </div>

                <div class="form-group">
                    <label for="tujuan_audit" class="form-label">Tujuan Audit</label>
                    <textarea name="tujuan_audit" id="tujuan_audit" class="form-control ckeditor" placeholder="Tujuan Audit">

                    </textarea>
                </div>

                <div class="form-group">
                    <label for="metodologi_audit" class="form-label">Metodologi Audit</label>
                    <textarea name="metodologi_audit" id="metodologi_audit" class="form-control ckeditor" placeholder="Metodologi Audit">

                    </textarea>
                </div>

                <div class="form-group">
                    <label for="hasil_audit" class="form-label">Hasil Audit</label>
                    <textarea name="hasil_audit" id="hasil_audit" class="form-control ckeditor" placeholder="Hasil Audit">

                     </textarea>
                </div>

                <div class="form-group">
                    <label for="rekomendasi" class="form-label">Rekomendasi</label>
                    <textarea name="rekomendasi" id="rekomendasi" class="form-control ckeditor" placeholder="Rekomendasi">

                    </textarea>
                </div>
                <div class="form-group">
                    <label for="kesimpulan" class="form-label">Kesimpulan Audit</label>
                    <textarea name="kesimpulan_audit" id="kesimpulan" class="form-control ckeditor" placeholder="Kesimpulan Audit">


                    </textarea>
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


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>`;

                                      // Menambah input file baru saat tombol 'Tambah File Lain' diklik
     

                        $(".formtambahan").append(data);
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

                        function validateForm() {
                            let valid = true;
                            document.querySelectorAll('.ckeditor').forEach(function(
                                editorElement) {
                                if (editorElement.style.display !== 'none') {
                                    let editorData = editorElement.closest(
                                        '.ck-editor').querySelector(
                                        '.ck-content').innerHTML;
                                    if (editorData.trim() === '') {
                                        alert(
                                            'Please fill out all required fields.'
                                        );
                                        valid = false;
                                    }
                                }
                            });
                            return valid;
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })




        })
    });


  

</script>


<script>
    let fileInputIndex = 1; // Mulai dari 1 karena input pertama sudah ada

    function addFormTambahan() {
        // Buat div wrapper untuk input file
        var wrapperDiv = document.createElement('div');
        wrapperDiv.className = 'input-group mb-3';
        wrapperDiv.id = 'input-group-' + fileInputIndex;

        // Buat input file baru
        var newFileInput = document.createElement('input');
        newFileInput.type = 'file';
        newFileInput.name = 'lampiran[]';
        newFileInput.className = 'form-control';
        newFileInput.id = 'lampiran' + fileInputIndex;

        // Event listener untuk menangani perubahan file
        newFileInput.addEventListener('change', function() {
            handleFileChange(this);
        });

        // Tambahkan input file baru ke wrapper div
        wrapperDiv.appendChild(newFileInput);

        // Tambahkan wrapper div ke container
        document.getElementById('fileInputsContainer').appendChild(wrapperDiv);

        fileInputIndex++; // Tingkatkan indeks untuk input berikutnya
    }

    function handleFileChange(input) {
        var fileList = document.getElementById('fileList');
        
        // Loop melalui file yang dipilih dan tambahkan ke list
        for (var i = 0; i < input.files.length; i++) {
            var li = document.createElement('li');
            li.textContent = input.files[i].name + " ";

            // Buat tombol hapus untuk setiap file
            var removeButton = document.createElement('button');
            removeButton.type = "button";
            removeButton.textContent = "Hapus";
            removeButton.className = "btn btn-danger btn-sm ml-2";

            // Fungsi untuk menghapus file dari daftar dan mengosongkan input file
            removeButton.onclick = function() {
                // Hapus nama file dari list
                li.remove(); 

                // Hapus input file jika tidak ada file lain
                var inputs = document.querySelectorAll('input[type="file"]');
                if (inputs.length === 1) {
                    inputs[0].parentElement.remove(); // Hapus elemen input file jika hanya satu yang tersisa
                } else {
                    input.parentElement.remove(); // Hapus input file yang sesuai
                }
            };

            li.appendChild(removeButton);
            fileList.appendChild(li);
        }
    }
</script>

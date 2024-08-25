@extends('TimKeamananAudit.keamananaudit_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pelaporan Audit Sistem Informasi Insidental</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/auth/dashboard-audit">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/auth/penindakan-insidental">Pelaporan  Audit Sistem
                                    Informasi
                                    Insidental</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (session()->has('suksessimpan'))
            <div class="alert alert-success" role="alert">
                {{ session('suksessimpan') }}
            </div>
        @endif

        @if ($errors->any())
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
                            <form class="formTambahAudit" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="form-group">
                                    <label for="" class="form-label">Pilih Sistem</label>
                                    <select name="kode_audit"  class="pilihsistem form-select">
                                        <option class="form-option" value="">-Nama Sistem-</option>
                                        @foreach ($kodeaudit as $item)
                                                <option  class="form-option" value="{{ $item->kode_audit_rutin }}">
                                                    {{$item->nama_sistem}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="loading d-none"><p>Loading...</p></div>
                                <div class="formtambahan">

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
    </section>


    @endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

        // hapus
        $(".tombolhapus").click(function() {
            console.log("kocak");
            var id = $(this).data("id");
            console.log(id);
            var form = $('#deleteForm');
            var action = "{{ route('penindakan-rutin.destroy', '') }}/" + id;
            form.attr('action', action);
        });
        // detail
        $(".tomboldetail").click(function() {
            console.log("lah");
            var id = $(this).data("id");
            console.log(id);
            var url = "{{ route('penindakan-rutin.getData', '') }}/" + id;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Assuming response is JSON, you can parse and display it as needed
                    console.log(response);
                    $(".tglAudit").html(response.tanggal_audit);
                    $(".versiAudit").html(response.versi);
                    $(".bahasaAudit").html(response.bahasa_pemrograman);
                    $(".frameworkAudit").html(response.framework);
                    $(".keamanansistemAudit").html(response.keamanan_sistem);
                    $(".maksimumpenggunaAudit").html(response.maksimum_pengguna);
                    $(".maksimumpenyimpananAudit").html(response.maksimum_penyimpanan);
                    $(".penggunasistemAudit").html(response.pengguna_sistem);
                    if (response.status = "proses") {
                        $(".statusAudit").html("Diproses");
                    }

                },
                error: function(xhr) {
                    // Handle error
                    alert('Error fetching data');
                }
            });
        })
        // tombol edit
        $(".tomboledit").click(function() {
            var id = $(this).data("id");
            var form = $('#editForm');
            var action = "{{ route('penindakan-rutin.update', '') }}/" + id;
            form.attr('action', action);
            var url = "{{ route('penindakan-rutin.getData', '') }}/" + id;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Assuming response is JSON, you can parse and display it as needed
                    console.log(response);
                    $("#tglaudit").val(response.tanggal_audit);
                    $("#versiaudit").val(response.versi);
                    $("#bahasa_pemrogramanaudit").val(response.bahasa_pemrograman);
                    $("#keamanan_sistemaudit").val(response.keamanan_sistem);
                    $("#frameworkaudit").val(response.framework);
                    $("#maksimum_penggunaaudit").val(response.maksimum_pengguna);
                    $("#maksimum_penyimpananaudit").val(response.maksimum_penyimpanan);
                    $("#pengguna_sistemaudit").val(response.pengguna_sistem);


                },
                error: function(xhr) {
                    // Handle error
                    alert('Error fetching data');
                }
            });

        });
    });
</script>

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
        // Print selected data
        $('#printSelected').click(function() {
            var selectedData = [];
            $('.rowCheckbox:checked').each(function() {
                var row = $(this).closest('tr');
                var rowData = {
                    tanggal_audit: row.find('td').eq(1).text(),
                    versi: row.find('td').eq(2).text(),
                    keamanan_sistem: row.find('td').eq(3).text(),
                    bahasa_pemrograman: row.find('td').eq(4).text(),
                    framework: row.find('td').eq(5).text(),
                    maksimum_pengguna: row.find('td').eq(6).text(),
                    maksimum_penyimpanan: row.find('td').eq(7).text(),
                    pengguna_sistem: row.find('td').eq(8).text(),
                    status: row.find('td').eq(9).text()
                };
                selectedData.push(rowData);
            });

            if (selectedData.length > 0) {
                // Create a new window or print preview
                var printWindow = window.open('', '', 'height=800,width=600');
                var namasistem = $(".namasistem").html();
                var namas = $(".namas").val();
                var kodes = $(".kodes").val();
                printWindow.document.write('<html><head><title>' + namasistem + '</title>');
                printWindow.document.write('<style>');
                printWindow.document.write(
                    'body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }');
                printWindow.document.write(
                    'h1 { text-align: center; font-size: 28px; margin-bottom: 10px; }');
                printWindow.document.write(
                    'h2 { text-align: center; font-size: 18px; margin-bottom: 10px; }');
                printWindow.document.write(
                    'hr.double { border: 0; border-top: 3px double #000; height: 0; margin: 5px 0; }'
                );
                printWindow.document.write(
                    'table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }');
                printWindow.document.write('th, td { border: none; padding: 8px; text-align: left; }');
                printWindow.document.write('.entry { margin-bottom: 5px; }');
                printWindow.document.write('@page { size: A4 portrait; margin: 20mm; }');
                printWindow.document.write('</style>');
                printWindow.document.write('</head><body>');
                printWindow.document.write('<h1>SIPEKA</h1>');
                printWindow.document.write('<h2>Laporan Data Audit</h2>');
                printWindow.document.write('<hr class="double">');
                // printWindow.document.write('<hr class="double">');
                printWindow.document.write(
                    '<table style="padding:0; margin-left:40px; font-size:14px; width:310px;">');
                printWindow.document.write('<tr><td>Nama Sistem</td><td> : ' + namas + '</td></tr>');
                printWindow.document.write('<tr><td>Kode Sistem</td><td> : ' + kodes + '</td></tr>');
                printWindow.document.write('</table>');
                $.each(selectedData, function(index, item) {
                    printWindow.document.write(
                        '<div class="entry" style="margin-left:40px; margin-right:40px; ">');
                    printWindow.document.write('<h3 style="text-align: left;"> Audit Ke : ' + (
                        index + 1) + '</h3>');
                    printWindow.document.write('<table style="font-size:12px; width:300px;">');

                    printWindow.document.write('<tr><td>Tanggal Audit</strong></td><td> : ' +
                        item.tanggal_audit + '</td></tr>');
                    printWindow.document.write('<tr><td>Versi</strong></td><td> : ' + item
                        .versi + '</td></tr>');
                    printWindow.document.write('<tr><td>Keamanan Sistem</strong></td><td> : ' +
                        item.keamanan_sistem + '</td></tr>');
                    printWindow.document.write(
                        '<tr><td>Bahasa Pemrograman</strong></td><td> : ' + item
                        .bahasa_pemrograman + '</td></tr>');
                    printWindow.document.write('<tr><td>Framework</strong></td><td> : ' + item
                        .framework + '</td></tr>');
                    printWindow.document.write(
                        '<tr><td>Maksimum Pengguna</strong></td><td> : ' + item
                        .maksimum_pengguna + '</td></tr>');
                    printWindow.document.write(
                        '<tr><td>Maksimum Penyimpanan</strong></td><td> : ' + item
                        .maksimum_penyimpanan + '</td></tr>');
                    printWindow.document.write('<tr><td>Pengguna Sistem</strong></td><td> : ' +
                        item.pengguna_sistem + '</td></tr>');
                    printWindow.document.write('<tr><td>Status</strong></td><td> : ' + item
                        .status + '</td></tr>');
                    printWindow.document.write('</table>');
                    printWindow.document.write('</div>');
                });

                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            } else {
                alert('Tidak ada data yang dipilih');
            }
        });



          $(".pilihsistem").change(function(){
            console.log($(this).val());
            var id = $(this).val();
            var url = "{{route('getAuditInsidental', '') }}/" + id;
            $(".formtambahan").empty();
            $(".loading").toggleClass("d-none");
            $.ajax({
                url : url,
                method : 'GET',
                success : function(response){
                    $(".loading").toggleClass("d-none");
                    console.log(response);
                    if(response.auditInsidental.length > 0){
                        var form = $(".formTambahAudit");
                        var id = response.auditInsidental[0].id;
                        var action = "{{ route('penindakan-insidental.update', '') }}/" + id;
                        form.attr("action", action)
                          var selectedUnitKerjaId = response.auditInsidental[0].unitkerja_id;
                          var selectedVersi = response.auditInsidental[0].versi;
                        var data = `
                          @method('PUT')
                        <div class="form-group">
                                    <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                                    <input type="date" value="${response.auditInsidental[0].tanggal_audit}" name="tanggal_audit"
                                        id="tanggal_audit" required class="form-control" placeholder="Tanggal Audit">
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
                    <input type="text" value="${response.auditInsidental[0].judul}" name="judul" id="judul" class="form-control" placeholder="Judul" >
                </div>
                             <div class="form-group">
                                    <label for="versi" class="form-label">Versi</label>
                                    <select name="versi" class="form-select">
                <option class="form-option" value="">-Versi-</option>
                     ${$.map(response.versi, function(item) {
                    // Cek jika item.id sama dengan selectedUnitKerjaId
                    console.log(item.versi);
                       var isSelected = item.versi === selectedVersi ? 'selected' : '';
                     return `<option class="form-option" value="${item.versi}" ${isSelected}>${item.versi}</option>`;
                        }).join('')}
                      </select>
                                </div>

                               <div class="form-group">
                    <label for="pendahuluan" class="form-label">Pendahuluan</label>
                    <textarea name="pendahuluan" id="pendahuluan" class="form-control ckeditor" placeholder="Pendahuluan">
                    ${response.auditInsidental[0].pendahuluan}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="cakupan_audit" class="form-label">Cakupan Audit</label>
                    <textarea name="cakupan_audit" id="cakupan_audit"  class="form-control ckeditor" placeholder="Cakupan Audit">
                    ${response.auditInsidental[0].cakupan_audit}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="tujuan_audit" class="form-label">Tujuan Audit</label>
                    <textarea name="tujuan_audit" id="tujuan_audit" class="form-control ckeditor" placeholder="Tujuan Audit">
                    ${response.auditInsidental[0].tujuan_audit}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="metodologi_audit" class="form-label">Metodologi Audit</label>
                    <textarea name="metodologi_audit" id="metodologi_audit" class="form-control ckeditor" placeholder="Metodologi Audit">
                    ${response.auditInsidental[0].metodologi_audit}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="hasil_audit" class="form-label">Hasil Audit</label>
                    <textarea name="hasil_audit" id="hasil_audit" class="form-control ckeditor" placeholder="Hasil Audit">
                     ${response.auditInsidental[0].hasil_audit}</textarea>
                </div>

                <div class="form-group">
                    <label for="rekomendasi" class="form-label">Rekomendasi</label>
                    <textarea name="rekomendasi" id="rekomendasi" class="form-control ckeditor" placeholder="Rekomendasi">
                     ${response.auditInsidental[0].rekomendasi}</textarea>
                </div>
                <div class="form-group">
                    <label for="kesimpulan" class="form-label">Kesimpulan Audit</label>
                    <textarea name="kesimpulan_audit" id="kesimpulan" class="form-control ckeditor" placeholder="Kesimpulan Audit">
                     ${response.auditInsidental[0].kesimpulan_audit}</textarea>
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
                                  document.querySelectorAll('.ckeditor').forEach(function(editorElement) {
                    ClassicEditor
                        .create(editorElement, {
                            ckfinder: {
                                uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
                            },

                        })
                        .then(editor => {
                            console.log('Editor was initialized', editor);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });

                 function validateForm() {
                let valid = true;
                document.querySelectorAll('.ckeditor').forEach(function(editorElement) {
                    if (editorElement.style.display !== 'none') {
                        let editorData = editorElement.closest('.ck-editor').querySelector('.ck-content').innerHTML;
                        if (editorData.trim() === '') {
                            alert('Please fill out all required fields.');
                            valid = false;
                        }
                    }
                });
                return valid;
            }

                    }else if(response.auditProses){
                         var form = $(".formTambahAudit");
                           var selectedUnitKerjaId = response.auditProses.unitkerja_id;
                           var selectedVersi = response.auditProses.versi;
                        var action = "{{ route('penindakan-insidental.store')}}" ;
                        form.attr("action", action)
                         var data = `

                        <div class="form-group">
                                    <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                                    <input type="date"  name="tanggal_audit" value="${response.auditProses.tanggal_audit}"
                                        id="tanggal_audit" required class="form-control" placeholder="Tanggal Audit">
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
                    <input type="text"  name="judul" id="judul" class="form-control" value="${response.auditProses.judul}" placeholder="Judul" >
                </div>
                             <div class="form-group">
                                    <label for="versi" class="form-label">Versi</label>
                                    <select name="versi" class="form-select">
                <option class="form-option" value="">-Versi-</option>
                     ${$.map(response.versi, function(item) {
                    // Cek jika item.id sama dengan selectedUnitKerjaId
                    console.log(item.versi);
                       var isSelected = item.versi === selectedVersi ? 'selected' : '';
                     return `<option class="form-option" value="${item.versi}" ${isSelected}>${item.versi}</option>`;
                        }).join('')}
                      </select>
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
                    <textarea name="metodologi_audit" id="metodologi_audit"  class="form-control ckeditor" placeholder="Metodologi Audit">
                    ${response.auditProses.metodologi_audit}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="hasil_audit" class="form-label">Hasil Audit</label>
                    <textarea name="hasil_audit" id="hasil_audit" class="form-control ckeditor" placeholder="Hasil Audit">
                    ${response.auditProses.hasil_audit}
                     </textarea>
                </div>

                <div class="form-group">
                    <label for="rekomendasi" class="form-label">Rekomendasi</label>
                    <textarea name="rekomendasi" id="rekomendasi" class="form-control ckeditor" placeholder="Rekomendasi">
                    ${response.auditProses.rekomendasi}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="kesimpulan" class="form-label">Kesimpulan Audit</label>
                    <textarea name="kesimpulan_audit" id="kesimpulan" class="form-control ckeditor" placeholder="Kesimpulan Audit">
                    ${response.auditProses.kesimpulan_audit}
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
                                $(".formtambahan").append(data);
                                  document.querySelectorAll('.ckeditor').forEach(function(editorElement) {
                    ClassicEditor
                        .create(editorElement, {
                            ckfinder: {
                                uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
                            },

                        })
                        .then(editor => {
                            console.log('Editor was initialized', editor);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });

                 function validateForm() {
                let valid = true;
                document.querySelectorAll('.ckeditor').forEach(function(editorElement) {
                    if (editorElement.style.display !== 'none') {
                        let editorData = editorElement.closest('.ck-editor').querySelector('.ck-content').innerHTML;
                        if (editorData.trim() === '') {
                            alert('Please fill out all required fields.');
                            valid = false;
                        }
                    }
                });
                return valid;
            }
        }else{
              var form = $(".formTambahAudit");

                        var action = "{{ route('penindakan-insidental.store')}}" ;
                        form.attr("action", action)
                         var data = `

                        <div class="form-group">
                                    <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                                    <input type="date"  name="tanggal_audit"
                                        id="tanggal_audit" required class="form-control" placeholder="Tanggal Audit">
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
                    <input type="text"  name="judul" id="judul" class="form-control"  placeholder="Judul">
                </div>
                             <div class="form-group">
                                    <label for="versi" class="form-label">Versi</label>
                                    <select name="versi" class="form-select">
                <option class="form-option" value="">-Versi-</option>
                     ${$.map(response.versi, function(item) {
                    // Cek jika item.id sama dengan selectedUnitKerjaId
                    console.log(item.versi);

                     return `<option class="form-option" >${item.versi}</option>`;
                        }).join('')}
                      </select>
                                </div>

                               <div class="form-group">
                    <label for="pendahuluan" class="form-label">Pendahuluan</label>
                    <textarea name="pendahuluan" id="pendahuluan" class="form-control ckeditor" placeholder="Pendahuluan">

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
                    <textarea name="metodologi_audit" id="metodologi_audit"  class="form-control ckeditor" placeholder="Metodologi Audit">

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
                                $(".formtambahan").append(data);
                                  document.querySelectorAll('.ckeditor').forEach(function(editorElement) {
                    ClassicEditor
                        .create(editorElement, {
                            ckfinder: {
                                uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
                            },

                        })
                        .then(editor => {
                            console.log('Editor was initialized', editor);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });

                 function validateForm() {
                let valid = true;
                document.querySelectorAll('.ckeditor').forEach(function(editorElement) {
                    if (editorElement.style.display !== 'none') {
                        let editorData = editorElement.closest('.ck-editor').querySelector('.ck-content').innerHTML;
                        if (editorData.trim() === '') {
                            alert('Please fill out all required fields.');
                            valid = false;
                        }
                    }
                });
                return valid;
            }

        }
                },
                error : function(error){
                    console.log(error);
                }
            })




    })
    });
</script>
<script>

</script>

@extends('admin.admin_layout')


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
                            <li class="breadcrumb-item"><a href="/auth/penindakan-rutin">Pelaporan Audit Sistem Informasi
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
                                        <option class="form-option" value="{{ $item->kode_audit_rutin }}">
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
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
                                placeholder="Tanggal Audit">
                        </div>

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="form-group">
                            <label for="versi" class="form-label">Versi</label>
                            <input type="text" name="versi" id="versiaudit" class="form-control"
                                placeholder="Versi">
                        </div>
                        <div class="form-group">
                            <label for="keamanan_sistem" class="form-label">Keamanan Sistem</label>
                            <input type="text" name="keamanan_sistem" id="keamanan_sistemaudit" class="form-control"
                                placeholder="Keamanan Sistem">
                        </div>
                        <div class="form-group">
                            <label for="bahasa_pemrograman" class="form-label">Bahasa Pemrograman</label>
                            <input type="text" name="bahasa_pemrograman" id="bahasa_pemrogramanaudit"
                                class="form-control" placeholder="Bahasa Pemrograman">
                        </div>
                        <div class="form-group">
                            <label for="framework" class="form-label">Framework</label>
                            <input type="text" name="framework" id="frameworkaudit" class="form-control"
                                placeholder="Framework">
                        </div>
                        <div class="form-group">
                            <label for="maksimum_penyimpanan" class="form-label">Maksimum Penyimpanan</label>
                            <input type="text" name="maksimum_penyimpanan" id="maksimum_penyimpananaudit"
                                class="form-control" placeholder="Maksimum Penyimpanan">
                        </div>
                        <div class="form-group">
                            <label for="maksimum_pengguna" class="form-label">Maksimum Pengguna</label>
                            <input type="text" name="maksimum_pengguna" id="maksimum_penggunaaudit"
                                class="form-control" placeholder="Maksimum Pengguna">
                        </div>
                        <div class="form-group">
                            <label for="pengguna_sistem" class="form-label">Pengguna Sistem</label>
                            <input type="text" name="pengguna_sistem" id="pengguna_sistemaudit" class="form-control"
                                placeholder="Pengguna Sistem">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" aria-label="Contoh Select">
                                <option>Status</option>
                                <option value="draft">Draft</option>
                                <option selected value="proses">Proses</option>

                            </select>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
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
                    console.log(response.auditRutin);
                    if (response.auditRutin.length > 0) {
                        var form = $(".formTambahAudit");
                        var id = response.auditRutin[0].id;
                        var action = "{{ route('penindakan-rutin.update', '') }}/" + id;
                        form.attr("action", action)
                        var selectedUnitKerjaId = response.auditRutin[0].unitkerja_id;
                        var data = `
                          @method('PUT')
                        <div class="form-group">
                                    <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                                    <input type="date" value="${response.auditRutin[0].tanggal_audit}" name="tanggal_audit"
                                        id="tanggal_audit" class="form-control" placeholder="Tanggal Audit">
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
                    <input type="text" value="${response.auditRutin[0].judul}" name="judul" id="judul" class="form-control" placeholder="Judul" required>
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
                    <label for="kesimpulan" class="form-label">Kesimpulan</label>
                    <textarea name="kesimpulan_audit" id="kesimpulan" class="form-control ckeditor" placeholder="Kesimpulan">
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

                    } else {
                        console.log("anjay");


                        var form = $(".formTambahAudit");

                        var action = "{{ route('tambahAuditRutin') }}";
                        form.attr("action", action)
                        var data = `

                        <div class="form-group">
                                    <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                                    <input type="date"  name="tanggal_audit"
                                        id="tanggal_audit" class="form-control" value="" placeholder="Tanggal Audit">
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
                    <input type="text"  name="judul" id="judul" class="form-control"  placeholder="Judul" required>
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
                    <label for="kesimpulan" class="form-label">Kesimpulan</label>
                    <textarea name="kesimpulan_audit" id="kesimpulan" class="form-control ckeditor" placeholder="Kesimpulan">


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

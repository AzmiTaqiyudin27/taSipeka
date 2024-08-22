@extends('pimpinan.pimpinan_layout')

@section('content')


    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="namasistem">{{ $kodeaudit->nama_sistem }} | {{ $kodeaudit->kode_audit_rutin }}</h3>
                    <input type="hidden" class="namas" value="{{ $kodeaudit->nama_sistem }}">
                    <input type="hidden" class="kodes" value="{{ $kodeaudit->kode_audit_rutin }}">
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="pelaporanRutin.html">Pelaporan Audit Sistem Informasi
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

        @if (count($auditDiedit) < 1)
            <a href="#formTambah" class="mb-2 btn btn-success">Tambah
            </a>
        @endif
        <!-- <button type="button" class="mb-2 btn btn-secondary" id="printSelected">Cetak Data Terpilih</button> -->

        @if (count($auditProses) > 0)
            <section class="section">
                <div class="col-12 col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table row-table" id="table1">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th>
                                            <th>Tanggal Pelaporan</th>
                                            <th>Versi</th>
                                            <th>Keamanan Sistem</th>
                                            <th>Bahasa Pemrograman</th>
                                            <th>Framework</th>
                                            <th>Maksimum Pengguna</th>
                                            <th>Maksimum Penyimpanan</th>
                                            <th>Pengguna Sistem</th>
                                            <th>Status</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($auditProses as $item)
                                            <tr>
                                                <td><input type="checkbox" class="rowCheckbox" value="{{ $item->id }}">
                                                </td>
                                                <td>{{ $item->tanggal_audit }}</td>
                                                <td>{{ $item->versi }}</td>
                                                <td>{{ $item->keamanan_sistem }}</td>
                                                <td>{{ $item->bahasa_pemrograman }}</td>
                                                <td>{{ $item->framework }}</td>
                                                <td>{{ $item->maksimum_pengguna }}</td>
                                                <td>{{ $item->maksimum_penyimpanan }}</td>
                                                <td>{{ $item->pengguna_sistem }}</td>
                                                <td>
                                                    @if ($item->status == 'proses')
                                                        Diproses
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="tomboldetail btn btn-info"
                                                        data-bs-toggle="modal" data-bs-target="#detailModal"
                                                        data-id="{{ $item->id }}">Detail</button>
                                                    <button type="button" class="tomboledit btn btn-warning"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="{{ $item->id }}">Edit</button>
                                                    <button type="button" class="tombolhapus btn btn-danger"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-id="{{ $item->id }}">Hapus </button>
                                                </td>





                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div </div>
            </section>
        @else
            <section class="section">
                <div class="col-12 col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <h2>Belum Ada Data</h2>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if (count($auditDiedit) > 0)
            <section class="section">
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('penindakan-rutin.update', $auditDiedit[0]->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input class="idPelaporan" type="hidden" value="{{ $auditDiedit[0]->id }}">
                                <div class="form-group">
                                    <label for="tanggal_audit" class="form-label">Tanggal Lapor</label>
                                    <input type="date" value="{{ $auditDiedit[0]->tanggal_audit }}" name="tanggal_audit"
                                        id="tanggal_audit" class="form-control" placeholder="Tanggal Audit" required>
                                </div>
                                <input type="hidden" name="kode_audit" value="{{ $kodeaudit->kode_audit_rutin }}">
                                <input type="hidden" name="user_id" value="{{ $userid }}">
                                <div class="form-group">
                                    <label for="versi" class="form-label">Versi</label>
                                    <input type="text" name="versi" id="versi" class="form-control"
                                        placeholder="Versi" value="{{ $auditDiedit[0]->versi }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="keamanan_sistem" class="form-label">Keamanan Sistem</label>
                                    <input type="text" name="keamanan_sistem" id="keamanan_sistem"
                                        class="form-control" placeholder="Versi"
                                        value="{{ $auditDiedit[0]->keamanan_sistem }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="bahasa_pemrograman" class="form-label">Bahasa Pemrograman</label>
                                    <input type="text" name="bahasa_pemrograman" id="bahasa_pemrograman"
                                        class="form-control" placeholder="Bahasa Pemrograman"
                                        value="{{ $auditDiedit[0]->bahasa_pemrograman }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="framework" class="form-label">Framework</label>
                                    <input type="text" name="framework" id="framework" class="form-control"
                                        placeholder="Framework" value="{{ $auditDiedit[0]->framework }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="maksimum_penyimpanan" class="form-label">Maksimum Penyimpanan</label>
                                    <input type="text" name="maksimum_penyimpanan" id="maksimum_penyimpanan"
                                        class="form-control" placeholder="Maksimum Penyimpanan"
                                        value="{{ $auditDiedit[0]->maksimum_penyimpanan }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="maksimum_pengguna" class="form-label">Maksimum Pengguna</label>
                                    <input type="text" name="maksimum_pengguna" id="maksimum_pengguna"
                                        class="form-control" placeholder="Maksimum Pengguna"
                                        value="{{ $auditDiedit[0]->maksimum_pengguna }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="pengguna_sistem" class="form-label">Pengguna Sistem</label>
                                    <input type="text" name="pengguna_sistem" id="pengguna_sistem"
                                        class="form-control" placeholder="Pengguna Sistem"
                                        value="{{ $auditDiedit[0]->pengguna_sistem }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status"
                                        aria-label="Contoh Select">
                                        <option>Status</option>
                                        <option selected value="diedit">Diedit</option>
                                        <option value="proses">Proses</option>

                                    </select>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Proses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
    </section>
@else
    <section class="section" id="formTambah">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('penindakan-rutin.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="tanggal_audit" class="form-label">Tanggal Lapor</label>
                            <input type="date" name="tanggal_audit" id="tanggal_audit" class="form-control"
                                placeholder="Tanggal Lapor" required>
                        </div>
                        <input type="hidden" name="kode_audit" value="{{ $kodeaudit->kode_audit_rutin }}">
                        <input type="hidden" name="user_id" value="{{ $userid }}">
                        <div class="form-group">
                            <label for="versi" class="form-label">Versi</label>
                            <input type="text" name="versi" id="versi" class="form-control"
                                placeholder="Versi" required>
                        </div>
                        <div class="form-group">
                            <label for="keamanan_sistem" class="form-label">Keamanan Sistem</label>
                            <input type="text" name="keamanan_sistem" id="keamanan_sistem" class="form-control"
                                placeholder="Keamanan Sistem" required>
                        </div>
                        <div class="form-group">
                            <label for="bahasa_pemrograman" class="form-label">Bahasa Pemrograman</label>
                            <input type="text" name="bahasa_pemrograman" id="bahasa_pemrograman" class="form-control"
                                placeholder="Bahasa Pemrograman" required>
                        </div>
                        <div class="form-group">
                            <label for="framework" class="form-label">Framework</label>
                            <input type="text" name="framework" id="framework" class="form-control"
                                placeholder="Framework" required>
                        </div>
                        <div class="form-group">
                            <label for="maksimum_penyimpanan" class="form-label">Maksimum Penyimpanan</label>
                            <input type="text" name="maksimum_penyimpanan" id="maksimum_penyimpanan"
                                class="form-control" placeholder="Maksimum Penyimpanan" required>
                        </div>
                        <div class="form-group">
                            <label for="maksimum_pengguna" class="form-label">Maksimum Pengguna</label>
                            <input type="text" name="maksimum_pengguna" id="maksimum_pengguna" class="form-control"
                                placeholder="Maksimum Pengguna" required>
                        </div>
                        <div class="form-group">
                            <label for="pengguna_sistem" class="form-label">Pengguna Sistem</label>
                            <input type="text" name="pengguna_sistem" id="pengguna_sistem" class="form-control"
                                placeholder="Pengguna Sistem" required>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" aria-label="Contoh Select">
                                <option>Status</option>
                                <option value="diedit">Diedit</option>
                                <option value="proses">Proses</option>

                            </select>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    @endif

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
    @if (count($auditProses) > 0)
        <!-- Detail Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Detail Audit</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table row-table" id="table1">
                            <tr>
                                <td>Tanggal Audit :</td>
                                <td>: <span class="tglAudit"></span></td>
                            </tr>
                            <tr>
                                <td>Versi</td>
                                <td>: <span class="versiAudit"></span></td>
                            </tr>
                            <tr>
                                <td>Bahasa Pemrograman</td>
                                <td>: <span class="bahasaAudit"></span></td>
                            </tr>
                            <tr>
                                <td>Framework</td>
                                <td>: <span class="frameworkAudit"></span></td>
                            </tr>
                            <tr>
                                <td>Keamanan Sistem</td>
                                <td>: <span class="keamanansistemAudit"></span></td>
                            </tr>
                            <tr>
                                <td>Maksimum Pengguna</td>
                                <td>: <span class="maksimumpenggunaAudit"></span></td>
                            </tr>
                            <tr>
                                <td>Maksimum Penyimpanan</td>
                                <td>: <span class="maksimumpenyimpananAudit"></span></td>
                            </tr>
                            <tr>
                                <td>Pengguna Sistem</td>
                                <td>: <span class="penggunasistemAudit"></span></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: <span class="statusAudit"></span></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    @endif
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
                            <label for="tanggal_audit" class="form-label">Tanggal Lapor</label>
                            <input type="date" name="tanggal_audit" id="tglaudit" class="form-control"
                                placeholder="Tanggal Lapor" required>
                        </div>
                        <input type="hidden" name="kode_audit" value="{{ $kodeaudit->kode_audit_rutin }}">
                        <input type="hidden" name="user_id" value="{{ $userid }}">
                        <div class="form-group">
                            <label for="versi" class="form-label">Versi</label>
                            <input type="text" name="versi" id="versiaudit" class="form-control"
                                placeholder="Versi" required>
                        </div>
                        <div class="form-group">
                            <label for="keamanan_sistem" class="form-label">Keamanan Sistem</label>
                            <input type="text" name="keamanan_sistem" id="keamanan_sistemaudit" class="form-control"
                                placeholder="Keamanan Sistem" required>
                        </div>
                        <div class="form-group">
                            <label for="bahasa_pemrograman" class="form-label">Bahasa Pemrograman</label>
                            <input type="text" name="bahasa_pemrograman" id="bahasa_pemrogramanaudit"
                                class="form-control" placeholder="Bahasa Pemrograman" required>
                        </div>
                        <div class="form-group">
                            <label for="framework" class="form-label">Framework</label>
                            <input type="text" name="framework" id="frameworkaudit" class="form-control"
                                placeholder="Framework" required>
                        </div>
                        <div class="form-group">
                            <label for="maksimum_penyimpanan" class="form-label">Maksimum Penyimpanan</label>
                            <input type="text" name="maksimum_penyimpanan" id="maksimum_penyimpananaudit"
                                class="form-control" placeholder="Maksimum Penyimpanan" required>
                        </div>
                        <div class="form-group">
                            <label for="maksimum_pengguna" class="form-label">Maksimum Pengguna</label>
                            <input type="text" name="maksimum_pengguna" id="maksimum_penggunaaudit"
                                class="form-control" placeholder="Maksimum Pengguna" required>
                        </div>
                        <div class="form-group">
                            <label for="pengguna_sistem" class="form-label">Pengguna Sistem</label>
                            <input type="text" name="pengguna_sistem" id="pengguna_sistemaudit" class="form-control"
                                placeholder="Pengguna Sistem" required>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" aria-label="Contoh Select">
                                <option>Status</option>
                                <option value="diedit">Diedit</option>
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
    });
</script>

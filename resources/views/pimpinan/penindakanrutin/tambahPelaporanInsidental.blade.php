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




        <button type="button" class="mb-2 btn btn-secondary" id="printSelected">Cetak Data Terpilih</button>



        <section class="section">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table row-table" id="table1">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>Pendahuluan</th>
                                        <th>Cakupan Audit</th>
                                        <th>Tujuan Audit</th>
                                        <th>Metodologi Audit</th>
                                        <th>Hasil Audit</th>
                                        <th>Rekomendasi</th>
                                        <th>Kesimpulan Audit</th>

                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($auditInsidental as $item)
                                        <tr>
                                            <td><input type="checkbox" class="rowCheckbox" value="{{ $item->id }}"></td>
                                            <td>{{ $item->pendahuluan }}</td>
                                            <td>{{ $item->cakupan_audit }}</td>
                                            <td>{{ $item->tujuan_audit }}</td>
                                            <td>{{ $item->metodologi_audit }}</td>
                                            <td>{{ $item->hasil_audit }}</td>
                                            <td>{{ $item->rekomendasi }}</td>
                                            <td>{{ $item->kesimpulan_audit }}</td>


                                            <td>
                                                <button type="button" class="tomboldetail btn btn-info"
                                                    data-bs-toggle="modal" data-bs-target="#detailModal"
                                                    data-id="{{ $item->id }}">Detail</button>
                                                {{-- <button type="button" class="tomboledit btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{$item->id}}">Edit</button> --}}
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

        <!-- <section class="section">
                    <div class="col-12 col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <h2>Belum Ada Data</h2>
                              </div>
                        </div>
                    </div>
                </section> -->


        <section class="section" id="formTambah">
            <!-- <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('penindakan-insidental.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="pendahuluan" class="form-label">Pendahuluan</label>
                                        <input type="text" name="pendahuluan" id="pendahuluan" class="form-control"
                                            placeholder="Pendahuluan" required>
                                    </div>
                                    <input type="hidden" name="kode_audit" value="{{ $kodeaudit->kode_audit_rutin }}">
                                    <input type="hidden" name="user_id" value="{{ $userid }}">
                                    <div class="form-group">
                                        <label for="cakupan_audit" class="form-label">Cakupan Audit</label>
                                        <input type="text" name="cakupan_audit" id="cakupan_audit" class="form-control"
                                            placeholder="Cakupan Audit" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tujuan_audit" class="form-label">Tujuan Audit</label>
                                        <input type="text" name="tujuan_audit" id="tujuan_audit" class="form-control" placeholder="Tujuan Audit"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="metodologi_audit" class="form-label">Metodologi Audit</label>
                                        <input type="text" name="metodologi_audit" id="metodologi_audit" class="form-control"
                                            placeholder="Metodologi Audit"  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="hasil_audit" class="form-label">Hasil Audit</label>
                                        <input type="text" name="hasil_audit" id="hasil_audit" class="form-control"
                                            placeholder="Hasil Audit"  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="rekomendasi" class="form-label">Rekomendasi</label>
                                        <input type="text" name="rekomendasi" id="rekomendasi" class="form-control"
                                            placeholder="Rekomendasi" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kesimpulan_audit" class="form-label">Kesimpulan Audit</label>
                                        <input type="text" name="kesimpulan_audit" id="kesimpulan_audit" class="form-control"
                                            placeholder="Kesimpulan Audit"  required>
                                    </div>



                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div> -->
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
                                <td>Pendahuluan :</td>
                                <td>: <span class="pendahuluan"></span></td>
                            </tr>
                            <tr>
                                <td>Kode Audit :</td>
                                <td>: <span class="kode_audit"></span></td>
                            </tr>
                            <tr>
                                <td>User ID :</td>
                                <td>: <span class="user_id"></span></td>
                            </tr>
                            <tr>
                                <td>Cakupan Audit :</td>
                                <td>: <span class="cakupan_audit"></span></td>
                            </tr>
                            <tr>
                                <td>Tujuan Audit :</td>
                                <td>: <span class="tujuan_audit"></span></td>
                            </tr>
                            <tr>
                                <td>Metodologi Audit :</td>
                                <td>: <span class="metodologi_audit"></span></td>
                            </tr>
                            <tr>
                                <td>Hasil Audit :</td>
                                <td>: <span class="hasil_audit"></span></td>
                            </tr>
                            <tr>
                                <td>Rekomendasi :</td>
                                <td>: <span class="rekomendasi"></span></td>
                            </tr>
                            <tr>
                                <td>Kesimpulan Audit :</td>
                                <td>: <span class="kesimpulan_audit"></span></td>
                            </tr>
                        </table>
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
                                <label for="pendahuluan" class="form-label">Pendahuluan</label>
                                <input type="text" name="pendahuluan_edit" id="pendahuluan" class="form-control"
                                    placeholder="Pendahuluan" required>
                            </div>

                            <input type="hidden" name="kode_audit_edit" value="{{ $kodeaudit->kode_audit_rutin }}">
                            <input type="hidden" name="user_id_edit" value="{{ $userid }}">

                            <div class="form-group">
                                <label for="cakupan_audit" class="form-label">Cakupan Audit</label>
                                <input type="text" name="cakupan_audit_edit" id="cakupan_audit" class="form-control"
                                    placeholder="Cakupan Audit" required>
                            </div>

                            <div class="form-group">
                                <label for="tujuan_audit" class="form-label">Tujuan Audit</label>
                                <input type="text" name="tujuan_audit_edit" id="tujuan_audit" class="form-control"
                                    placeholder="Tujuan Audit" required>
                            </div>

                            <div class="form-group">
                                <label for="metodologi_audit" class="form-label">Metodologi Audit</label>
                                <input type="text" name="metodologi_audit_edit" id="metodologi_audit"
                                    class="form-control" placeholder="Metodologi Audit" required>
                            </div>

                            <div class="form-group">
                                <label for="hasil_audit" class="form-label">Hasil Audit</label>
                                <input type="text" name="hasil_audit_edit" id="hasil_audit" class="form-control"
                                    placeholder="Hasil Audit" required>
                            </div>

                            <div class="form-group">
                                <label for="rekomendasi" class="form-label">Rekomendasi</label>
                                <input type="text" name="rekomendasi_edit" id="rekomendasi" class="form-control"
                                    placeholder="Rekomendasi" required>
                            </div>

                            <div class="form-group">
                                <label for="kesimpulan_audit" class="form-label">Kesimpulan Audit</label>
                                <input type="text" name="kesimpulan_audit_edit" id="kesimpulan_audit"
                                    class="form-control" placeholder="Kesimpulan Audit" required>
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
                var action = "{{ route('audit-insidental.destroy', '') }}/" + id;
                form.attr('action', action);
            });
            // detail
            $(".tomboldetail").click(function() {
                console.log("lah");
                var id = $(this).data("id");
                console.log(id);
                var url = "{{ route('audit-insidental.getData', '') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Assuming response is JSON, you can parse and display it as needed
                        console.log(response);
                        $(".pendahuluan").text(response.pendahuluan);
                        $(".kode_audit").text(response.kode_audit);
                        $(".user_id").text(response.user_id);
                        $(".cakupan_audit").text(response.cakupan_audit);
                        $(".tujuan_audit").text(response.tujuan_audit);
                        $(".metodologi_audit").text(response.metodologi_audit);
                        $(".hasil_audit").text(response.hasil_audit);
                        $(".rekomendasi").text(response.rekomendasi);
                        $(".kesimpulan_audit").text(response.kesimpulan_audit);


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
                // var action = "{{ route('hasil-rutin.update', '') }}/" + id;
                var action = "{{ route('audit-insidental.update', '') }}/" + id;
                form.attr('action', action);
                var url = "{{ route('audit-insidental.getData', '') }}/" + id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Assuming response is JSON, you can parse and display it as needed
                        console.log(response);
                        $('#pendahuluan').val(response.pendahuluan);
                        $('#cakupan_audit').val(response.cakupan_audit);
                        $('#tujuan_audit').val(response.tujuan_audit);
                        $('#metodologi_audit').val(response.metodologi_audit);
                        $('#hasil_audit').val(response.hasil_audit);
                        $('#rekomendasi').val(response.rekomendasi);
                        $('#kesimpulan_audit').val(response.kesimpulan_audit);



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

@php
    use Carbon\Carbon;
@endphp

@extends('admin.admin_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Sistem</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/auth/dashboard-audit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penindakan Audit Sistem Informasi Rutin
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (session()->has('suksestambah'))
            <div class="alert alert-success" role="alert">
                {{ session('suksestambah') }}
            </div>
        @endif
        @if (session()->has('sukseshapus'))
            <div class="alert alert-danger" role="alert">
                {{ session('sukseshapus') }}
                {{-- Coba lagi setelah ini. --}}
            </div>
        @endif
        @if (session()->has('suksesubah'))
            <div class="alert alert-success" role="alert">
                {{ session('suksesubah') }}
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Minimal jQuery Datatable end -->
        <!-- Basic Tables start -->
        <section class="section">
            <!-- <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah Sistem
            </button> -->
            <!-- <a href="" class="btn btn-secondary mt-4">
                                                        Search
                                                    </a> -->
            <!-- <button data-bs-toggle="modal" data-bs-target="#cetakModal" id="printSelected" class="btn btn-secondary mt-4">
                                                        Cetak
                                                    </button> -->
            {{-- <a href="{{ route('pelaporan-rutin.printPDF') }}" class="btn btn-info float-lg-end">
                <i class="bi bi-printer"></i> Cetak PDF
            </a> --}}
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table row-table" id="table1">
                            <thead>
                                <tr>
                                    {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                    <th>Kode Audit</th>
                                    <th>Nama Sistem</th>
                                    <th>Jumlah Audit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $item)
                                    <tr>
                                        {{-- <td><input type="checkbox" class="rowCheckbox" value="{{ $item->id }}"></td> --}}
                                        <td>{{ $item->kode_audit }}</td>
                                        <td>{{ $item->nama_sistem }}</td>
                                        <td>{{ $item->audit_rutin_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                </div>
        </section>
        <!-- Basic Tables end -->
        <!-- Edit modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Edit Sistem</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" action="" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="kode_audit_edit" class="form-label">Kode Audit</label>
                                <input type="text" name="kode_audit" id="kode_audit_edit" class="form-control"
                                    placeholder="Kode Audit" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_sistem_edit" class="form-label">Nama Sistem</label>
                                <input type="text" name="nama_sistem" id="nama_sistem_edit" class="form-control"
                                    placeholder="Nama Sistem" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal cetak -->
        <div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="cetakModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cetakModalLabel">Preview</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="preview">

                        </div>
                        <button class="btn btn-info cetakin">Cetak</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- tambah modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Tambah Sistem</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm" action="{{ route('audit-rutin-kode.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="kode_audit_edit" class="form-label">Kode Audit</label>
                                <input type="text" name="kode_audit" id="kode_audit" class="form-control"
                                    placeholder="Kode Audit" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_sistem_edit" class="form-label">Nama Sistem</label>
                                <input type="text" name="nama_sistem" id="nama_sistem" class="form-control"
                                    placeholder="Nama Sistem" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- delete modal -->
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
            var action = "{{ route('audit-rutin-kode.destroy', '') }}/" + id;
            form.attr('action', action);
        });
        // edit
        $(".tomboledit").click(function() {
            var id = $(this).data("id");
            console.log(id);
            var url = "{{ route('audit-rutin-kode.getData', '') }}/" + id;
            var form = $('#editForm');
            var action = "{{ route('audit-rutin-kode.update', '') }}/" + id;
            form.attr('action', action);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Assuming response is JSON, you can parse and display it as needed
                    console.log(response);
                    $("#kode_audit_edit").val(response.kode_audit);
                    $("#nama_sistem_edit").val(response.nama_sistem);



                },
                error: function(xhr) {
                    // Handle error
                    alert('Error fetching data');
                }
            });
        })

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
                    kode_audit: row.find('td').eq(1).text(),
                    nama_sistem: row.find('td').eq(2).text(),
                    jumlah_audit: row.find('td').eq(3).text(),

                };
                selectedData.push(rowData);
            });

            if (selectedData.length > 0) {
                var namasistem = $(".namasistem").html();
                var content = '<html><head><title>' + namasistem + '</title>';
                content += '<style>';

                content +=
                    'hr.double { border: 0; border-top: 3px double #000; height: 0; margin: 5px 0; }';



                content += '@page { size: A4 portrait; margin: 20mm; }';
                content += '</style>';
                content +=
                    '</head><body style="font-family: Arial, sans-serif; font-size: 12px; margin: 20px;">';

                content +=
                    '<h1 style="color : black; text-align: center; font-size: 30px; margin-bottom: 10px;">SIPEKA</h1>';
                content +=
                    '<h2 style="color:black; text-align: center; font-size: 20px; margin-bottom: 10px; ">Data Sistem Audit</h2>';
                content += '<hr class="double">';

                $.each(selectedData, function(index, item) {
                    content +=
                        '<div class="entry" style="margin-bottom: 5px; margin-left:40px; margin-right:40px;">';
                    content +=
                        '<h3 style="text-align: left;font-size: 18px; color:black;"> Sistem Ke : ' +
                        (index + 1) + '</h3>';
                    content +=
                        '<table style=" width: 100%; border-collapse: collapse; margin-bottom: 10px; font-size:16px; width:300px;">';
                    content +=
                        '<tr><td style="border: none; padding: 8px;">Kode Audit</td><td> : ' +
                        item.kode_audit + '</td></tr>';
                    content +=
                        '<tr><td style="border: none; padding: 8px;">Nama Sistem</td><td> : ' +
                        item.nama_sistem + '</td></tr>';
                    content +=
                        '<tr><td style="border: none; padding: 8px;">Jumlah Audit</td><td> : ' +
                        item.jumlah_audit + '</td></tr>';
                    content += '</table>';
                    content += '</div>';
                });

                content += '</body></html>';
                $('.preview').html(content);

                // Create a new window or print preview
                // var printWindow = window.open('', '', 'height=800,width=600');
                // var namasistem = $(".namasistem").html();
                // // var namas = $(".namas").val();
                // // var kodes = $(".kodes").val();
                // printWindow.document.write('<html><head><title>' + namasistem + '</title>');
                // printWindow.document.write('<style>');
                // printWindow.document.write('body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }');
                // printWindow.document.write('h1 { text-align: center; font-size: 30px; margin-bottom: 10px; }');
                // printWindow.document.write('h2 { text-align: center; font-size: 20px; margin-bottom: 10px; }');
                // printWindow.document.write('hr.double { border: 0; border-top: 3px double #000; height: 0; margin: 5px 0; }');
                // printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }');
                // printWindow.document.write('th, td { border: none; padding: 8px; text-align: left; }');
                // printWindow.document.write('.entry { margin-bottom: 5px; }');
                // printWindow.document.write('@page { size: A4 portrait; margin: 20mm; }');
                // printWindow.document.write('</style>');
                // printWindow.document.write('</head><body>');
                // printWindow.document.write('<h1>SIPEKA</h1>');
                // printWindow.document.write('<h2>Data Sistem Audit</h2>');
                // printWindow.document.write('<hr class="double">');
                // // printWindow.document.write('<hr class="double">');
                // // printWindow.document.write('<table style="padding:0; margin-left:40px; font-size:14px; width:310px;">');
                // // printWindow.document.write('<tr><td>Nama Sistem</td><td> : ' + namas + '</td></tr>');
                // // printWindow.document.write('<tr><td>Kode Sistem</td><td> : ' + kodes + '</td></tr>');
                // //    printWindow.document.write('</table>');
                // $.each(selectedData, function(index, item) {
                //     printWindow.document.write('<div class="entry" style="margin-left:40px; margin-right:40px; ">');
                //     printWindow.document.write('<h3 style="text-align: left;"> Sistem Ke : ' + (index + 1) + '</h3>');
                //     printWindow.document.write('<table style="font-size:16px; width:300px;">');

                //     printWindow.document.write('<tr><td>Kode Audit</strong></td><td> : ' + item.kode_audit + '</td></tr>');
                //     printWindow.document.write('<tr><td>Nama Sistem</strong></td><td> : ' + item.nama_sistem + '</td></tr>');
                //     printWindow.document.write('<tr><td>Jumlah Audit</strong></td><td> : ' + item.jumlah_audit + '</td></tr>');

                //     printWindow.document.write('</table>');
                //     printWindow.document.write('</div>');
                // });

                // printWindow.document.write('</body></html>');
                // printWindow.document.close();
                // printWindow.print();
            } else {
                alert('Tidak ada data yang dipilih');
            }
        });

        $(".cetakin").click(function() {
            var printContent = $('.preview').html();
            var printWindow = window.open('', '', 'height=800,width=600');
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        })
    });
</script>

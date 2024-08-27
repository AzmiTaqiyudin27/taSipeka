@php
use Carbon\Carbon;
@endphp
@extends('admin.admin_layout')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Hasil Audit Sistem Informasi Insidental</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/auth/auth/dashboard-audit">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Hasil Audit Sistem Informasi Insidental
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

    <section class="section">
        <div class="col-12 col-lg-10">
            <input type="hidden" class="namas">
            <input type="hidden" class="kodes">
            <div class="card p-3">
                <div class="col-4">
                    <label for="dropdownSelect">Unit Kerja</label>
                    <select class="form-control" name="unitkerja" id="unitkerjaSelect">
                        <option value="">-- Pilih Unit Kerja --</option>
                        @foreach ($listunitkerja as $unitkerja)
                        <option value="{{ $unitkerja->id }}">{{ $unitkerja->username }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group dropdownsistem my-2 col-4">
                    <label for="dropdownSelect">Pilih Sistem</label>
                    <select class="form-control" id="dropdownSelect">
                         <option value="" selected>-- Pilih Sistem --</option>
                        @foreach ($laporan as $kds)
                        <option value="{{ $kds->kode_audit_rutin }}">{{ $kds->nama_sistem }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="mt-2">
                    <div class="table-responsive tableDisini">
                        <div class="d-flex my-1 filtertanggal align-items-end flex-row">
                            <div class="form-group col-4 d-flex flex-column me-2">
                                <label for="tanggal_audit" class="form-label">Dari</label>
                                <input type="date" id="tgldari" class="form-control" placeholder="Tanggal Audit">
                            </div>

                            <div class="form-group col-4 d-flex flex-column ">
                                <label for="tanggal_audit" class="form-label">Sampai</label>
                                <input type="date" id="tglsampai" class="form-control" placeholder="Tanggal Audit">
                            </div>
                            <div class="form-group align-items-end  mx-2 d-flex justify-items-end flex-column">
                                <label for="tanggal_audit" class="form-label"></label>
                                <button
                                    class="btn self-end align-self-end justify-self-end btn-primary tampilin">Filter</button>
                            </div>


                        </div>

                        <button type="button" class="btn my-3 btn-secondary" id="printSelected">Cetak Data
                            Terpilih</button>
                        {{-- <button id="excel" class="d-none  btn btn-info">Export Excel</button> --}}
                        <table class="table row-table" id="tablehasil">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Tanggal Audit</th>
                                    <th>Judul</th>
                                    <th>Unit Kerja</th>
                                    <th>Nama Sistem</th>
                                    <th>Versi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <tr>
                                    <td class="text-center" colspan="9">Belum Menampilkan Data</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="cetakModal" tabindex="-1" role="dialog" aria-labelledby="cetakModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cetakModalLabel">Preview</h5>
                    <button class="btn btn-info cetakin">Cetak</button>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="preview">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- full size modal-->
<div class="modal fade text-left w-100" id="full-scrn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Pelaporan Audit</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table row-table">

                    <tr>
                        <td>Pendahuluan</td>
                        <td> <span id="detailPendahuluan"></span></td>
                    </tr>
                    <tr>
                        <td>Cakupan Audit</td>
                        <td> <span id="detailCakupan"></span></td>
                    </tr>
                    <tr>
                        <td>Tujuan Audit</td>
                        <td> <span id="detailTujuan"></span></td>
                    </tr>
                    <tr>
                        <td>Metodelogi Audit</td>
                        <td><span id="detailMetodologi"></span></td>
                    </tr>
                    <tr>
                        <td>Hasil Audit</td>
                        <td> <span id="detailHasil"></span></td>
                    </tr>
                    <tr>
                        <td>Rekomendasi</td>
                        <td> <span id="detailRekomendasi"></span></td>
                    </tr>
                    <tr>
                        <td>Kesimpulan Audit</td>
                        <td> <span id="detailKesimpulan"></span></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')


<script>
    $(document).ready(function() {
        $("#unitkerjaSelect").select2();
        $("#dropdownSelect").select2();

        // console.log(select2());
 function formatDate(dateString) {
            const [year, month, day] = dateString.split('-');
            return `${day}/${month}/${year}`;
        }

        var kode = null;
        var unitkerja = null;
        var tanggaldari = null;
        var tanggalsampai = null;
        var requestData = {
            sistem: kode,
            unitkerja: unitkerja,
            dari: tanggaldari,
            sampai: tanggalsampai
        };


        // Define the URL for the AJAX request
        var url = "/auth/hasil-audit-insidental-get";

        // Send an AJAX GET request
        $.ajax({
            url: url,
            type: "GET",
            data: requestData,
            success: function(response) {
                $(".tbody").empty();
                // Handle select all checkbox functionality
                $('#selectAll').change(function() {
                    $('.rowCheckbox').prop('checked', $(this).prop('checked'));
                });

                // If response contains data
                if (response.length > 0) {
                    // Show filter options
                    $(".filtertanggal").removeClass("d-none");
                    $("#excel, #printSelected").removeClass("d-none");

                    // Iterate through the response and append rows to the tbody
                    var tbody = $(".tbody");
                    response.forEach(function(item) {
                        var row = `
                    <tr>
                        ${item.status === 'proses'
                            ? '<td><input type="checkbox" class="rowCheckbox" value="' + item.id + '"></td>'
                            : '<td> - </td>'}
                        <td>${formatDate(item.tanggal_audit)}</td>
                        <td>${item.judul}</td>
                        <td>${item.unit_kerja.username}</td>
                        <td>${item.kodeaudit.nama_sistem}</td>
                        <td>${item.versi}</td>
                        <td>${item.status}</td>
                        <td><button type="button" class="tomboldetail btn btn-info"
                                    data-bs-toggle="modal" data-bs-target="#full-scrn"
                                    data-id="${item.id}">Detail</button></td>
                    </tr>
                `;
                        tbody.append(row);
                    });

                    // Handle click events for the detail buttons
                    $(".tomboldetail").click(function() {
                        var id = $(this).data('id');
                        var url = "{{ route('audit-insidental.getData', '') }}/" +
                            id;
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                // Populate modal with response data
                                $("#detailUnit").html(response.unitkerja_name);
                                $("#detailPendahuluan").html(response.pendahuluan);
                                $("#detailCakupan").html(response.cakupan_audit);
                                $("#detailTujuan").html(response.tujuan_audit);
                                $("#detailMetodologi").html(response.metodologi_audit);
                                $("#detailHasil").html(response.hasil_audit);
                                $("#detailRekomendasi").html(response.rekomendasi);
                                $("#detailKesimpulan").html(response.kesimpulan_audit);
                                $(".statusAudit").html(response.status);
                            },
                            error: function(xhr) {
                                // Handle error
                                alert('Error fetching data');
                            }
                        });
                    });
                }else{
                    tbody.append(` <tr>
                                        <td class="text-center" colspan="9">Tidak Ada Data</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>`);
                }
            },
            error: function() {
                // Handle any errors during the AJAX request
                alert('Error fetching data');
            }
        });

    $("#unitkerjaSelect").change(function() {
        console.log($(this).val());



        if($(this).val() == ""){
            var id = null;
        }else{
            var id = $(this).val();
        }

        if($("#dropdownSelect").val() == ""){
            var sistem = null;
        }else{
            var sistem = $("#dropdownSelect").val();
        }
        console.log($("#dropdownSelect").val())
        if ($("#tgldari").val() == "") {
            var dari = null;
        } else {
            var dari = $("#tgldari").val();
        }

        if ($("#tglsampai").val() == "") {
            var sampai = null;
        } else {
            var sampai = $("#tglsampai").val();
        }

        console.log(dari);
        console.log(sampai);
        var requestData = {
            sistem: sistem,
            unitkerja: id,
            dari: dari,
            sampai: sampai
        };

        var urlAuditInsidental = "/auth/hasil-audit-insidental-get";
        console.log(requestData);

        $.ajax({
            url: urlAuditInsidental,
            type: "GET",
            data: requestData, // Data yang dikirim dalam format JSON

            success: function(res) {
                $('#selectAll').change(function() {
                    $('.rowCheckbox').prop('checked', $(this).prop('checked'));
                });

                console.log(res);
                var tbody = $(".tbody");
                tbody.empty();
                res.forEach(function(item) {
                    var row = `
        <tr>
            ${item.status === 'proses'
                            ? '<td><input type="checkbox" class="rowCheckbox" value="' + item.id + '"></td>'
                            : '<td> - </td>'}
            <td>${formatDate(item.tanggal_audit)}</td>
            <td>${item.judul}</td>
            <td>${item.unit_kerja.username}</td>
            <td>${item.kodeaudit.nama_sistem}</td>
            <td>${item.versi}</td>
            <td>${item.status}</td>
            <td><button type="button" class="tomboldetail btn btn-info"
                        data-bs-toggle="modal" data-bs-target="#full-scrn"
                        data-id="${item.id}">Detail</button></td>
        </tr>
    `;
                    tbody.append(row);
                });
                $(".tomboldetail").click(function() {
                    console.log("tes");
                    var id = $(this).data('id');
                    var url = "{{ route('audit-insidental.getData', '') }}/" +
                        id;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            // Assuming response is JSON, you can parse and display it as needed
                            console.log(response);
                            $("#detailUnit").html(response
                                .unitkerja_name);
                            $("#detailPendahuluan").html(response
                                .pendahuluan);
                            $("#detailCakupan").html(response
                                .cakupan_audit);
                            $("#detailTujuan").html(response
                                .tujuan_audit);
                            $("#detailMetodologi").html(response
                                .metodologi_audit);
                            $("#detailHasil").html(response
                                .hasil_audit);
                            $("#detailRekomendasi").html(response
                                .rekomendasi);
                            $("#detailKesimpulan").html(response
                                .kesimpulan_audit);
                            $(".statusAudit").html(response.status);


                        },
                        error: function(xhr) {
                            // Handle error
                            alert('Error fetching data');
                        }
                    });
                })


            },
            error: function(err) {
                console.log(err);
            }
        })

    })

    $("#dropdownSelect").change(function() {
        if($(this).val() == ""){
            var kode = null;
        }else{
            var kode = $(this).val();
        }
        if($("#unitkerjaSelect").val() == ""){
            var unitkerja = null;
        }else{
            var unitkerja = $("#unitkerjaSelect").val();
        }
        if ($("#tgldari").val() == "") {
            var dari = null;
        } else {
            var dari = $("#tgldari").val();
        }

        if ($("#tglsampai").val() == "") {
            var sampai = null;
        } else {
            var sampai = $("#tglsampai").val();
        }
        var requestData = {
            sistem: kode,
            unitkerja: unitkerja,
            dari: dari,
            sampai: sampai
        };
        var namasistem = $(this).find('option:selected').text()
        $(".kodes").val(kode);
        $(".namas").val(namasistem);
        $(".tbody").empty();

        var url = "/auth/hasil-audit-insidental-get";
        $.ajax({
            url: url,
            type: 'GET',
            data: requestData,
            success: function(response) {
                $('#selectAll').change(function() {
                    $('.rowCheckbox').prop('checked', $(this).prop('checked'));
                });
                console.log(response);
                if (response.length > 0) {
                    $(".filtertanggal").removeClass("d-none")
                }
                $("#excel, #printSelected").removeClass("d-none");
                $(".tbody").empty();


                var tbody = $(".tbody");
                response.forEach(function(item) {
                    var row = `
        <tr>
            ${item.status === 'proses'
                            ? '<td><input type="checkbox" class="rowCheckbox" value="' + item.id + '"></td>'
                            : '<td> - </td>'}
             <td>${formatDate(item.tanggal_audit)}</td>
            <td>${item.judul}</td>
            <td>${item.unit_kerja.username}</td>
            <td>${item.kodeaudit.nama_sistem}</td>
            <td>${item.versi}</td>
            <td>${item.status}</td>
            <td><button type="button" class="tomboldetail btn btn-info"
                        data-bs-toggle="modal" data-bs-target="#full-scrn"
                        data-id="${item.id}">Detail</button></td>
        </tr>
    `;
                    tbody.append(row);
                });

                $(".tomboldetail").click(function() {
                    console.log("tes");
                    var id = $(this).data('id');
                    var url = "{{ route('audit-insidental.getData', '') }}/" +
                        id;
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            // Assuming response is JSON, you can parse and display it as needed
                            console.log(response);
                            $("#detailUnit").html(response
                                .unitkerja_name);
                            $("#detailPendahuluan").html(response
                                .pendahuluan);
                            $("#detailCakupan").html(response
                                .cakupan_audit);
                            $("#detailTujuan").html(response
                                .tujuan_audit);
                            $("#detailMetodologi").html(response
                                .metodologi_audit);
                            $("#detailHasil").html(response
                                .hasil_audit);
                            $("#detailRekomendasi").html(response
                                .rekomendasi);
                            $("#detailKesimpulan").html(response
                                .kesimpulan_audit);
                            $(".statusAudit").html(response.status);


                        },
                        error: function(xhr) {
                            // Handle error
                            alert('Error fetching data');
                        }
                    });
                })



                $('#selectAll').change(function() {
                    $('.rowCheckbox').prop('checked', $(this).prop('checked'));
                });
            },
            error: function(xhr) {
                console.log(xhr);
                alert('Error fetching data');
            }
        });
    });


    $(".tampilin").click(function() {

        if($("dropdownSelect").val() == ""){
                var kode = null;
            }else{
                var kode = $("#dropdownSelect").val();
            }
            if($("#unitkerjaSelect").val() == ""){
                var unitkerja = null;
            }else{
                var unitkerja = $("#unitkerjaSelect").val();
            }
        if (tanggaldari == "" || tanggalsampai == "") {
           var tanggaldari = null;
        var tanggalsampai = null;
        } else {
             var tanggaldari = $("#tgldari").val();
        var tanggalsampai = $("#tglsampai").val();
            var requestData = {
                sistem: kode,
                unitkerja: unitkerja,
                dari: tanggaldari,
                sampai: tanggalsampai
            };
            $(".tbody").empty();
            var url = "/auth/hasil-audit-insidental-get";
            $.ajax({
                url: url,
                type: "GET",
                data: requestData,
                success: function(response) {
                    $('#selectAll').change(function() {
                        $('.rowCheckbox').prop('checked', $(this).prop('checked'));
                    });
                    console.log(response);
                    if (response.length > 0) {
                        var tbody = $(".tbody");
                        response.forEach(function(item) {
                            console.log(item)
                            var id = item.id;
                            var row = `
                                <tr>
                                <td><input type="checkbox" class="rowCheckbox" value='${id}'></td>
                                <td>${formatDate(item.tanggal_audit)}</td>
                                <td>${item.judul}</td>
                                <td>${item.unit_kerja.username}</td>
                                <td>${item.kodeaudit.nama_sistem}</td>
                                <td>${item.versi}</td>
                                <td><button type="button" class="tomboldetail btn btn-info"
                                data-bs-toggle="modal" data-bs-target="#full-scrn"
                                data-id="${item.id}">Detail</button></td>
                                </tr>
                                `;
                            tbody.append(row);
                        });
                    } else {
                        $(".tbody").append(`
                             <tr>
                                        <td class="text-center" colspan="9">Tidak Ada Data</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                            `);
                    }
                    $(".tomboldetail").click(function() {
                        console.log("tes");
                        var id = $(this).data('id');
                        var url = "{{ route('audit-insidental.getData', '') }}/" +
                            id;
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                // Assuming response is JSON, you can parse and display it as needed
                                console.log(response);
                                $("#detailUnit").html(response
                                    .unitkerja_name);
                                $("#detailPendahuluan").html(response
                                    .pendahuluan);
                                $("#detailCakupan").html(response
                                    .cakupan_audit);
                                $("#detailTujuan").html(response
                                    .tujuan_audit);
                                $("#detailMetodologi").html(response
                                    .metodologi_audit);
                                $("#detailHasil").html(response
                                    .hasil_audit);
                                $("#detailRekomendasi").html(response
                                    .rekomendasi);
                                $("#detailKesimpulan").html(response
                                    .kesimpulan_audit);
                                $(".statusAudit").html(response.status);


                            },
                            error: function(xhr) {
                                // Handle error
                                alert('Error fetching data');
                            }
                        });
                    })
                },
                error: function(err) {
                    console.log(err);
                }
            })

        }
    })

    $("#excel").click(function() {
        const table = document.getElementById("tablehasil");
        const ws = XLSX.utils.table_to_sheet(table);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
        const filename = $(".namas").val() + ".xlsx";
        XLSX.writeFile(wb, filename);
    });

    $('#printSelected').click(function() {
        var selectedData = [];
        var ajaxPromises = [];

        // Mendapatkan nilai dari checkbox yang diceklis
        $('.rowCheckbox:checked').each(function() {
            console.log($(this))
            var id = $(this).val(); // Mengambil ID atau nilai unik yang diperluka
            console.log(id);
            // Menambahkan AJAX request ke dalam promises array
            var ajaxPromise = $.ajax({
                url: "{{ route('audit-insidental.getData', '') }}/" + id,
                type: 'GET'
            }).then(function(response) {
                // Jika sukses mendapatkan data, masukkan ke dalam rowData
                console.log(response);
                var rowData = {
                    pendahuluan: response.pendahuluan,
                    unitkerja: response.unitkerja_name,
                    judul: response.judul,
                    cakupan_audit: response.cakupan_audit,
                    tujuan_audit: response.tujuan_audit,
                    tanggal_audit: response.tanggal_audit,
                    versi: response.versi,
                    metodologi_audit: response.metodologi_audit,
                    hasil_audit: response.hasil_audit,
                    rekomendasi: response.rekomendasi,
                    kesimpulan_audit: response.kesimpulan_audit,
                    namasistem: response.nama_sistem
                };
                selectedData.push(
                    rowData); // Memasukkan rowData ke dalam selectedData
            }).catch(function(xhr, status, error) {
                console.error('Error fetching data:',
                    error); // Tangani error jika ada

            });

            ajaxPromises.push(ajaxPromise);
        });


        Promise.all(ajaxPromises).then(function() {
            console.log(selectedData); // Data sudah terisi lengkap

            if (selectedData.length > 0) {
                var namas = $(".namas").val();
                var kodes = $(".kodes").val();
                var htmlContent = '<html><head><title>' + namas + ' | ' + kodes +
                    '</title>';
                htmlContent += '<style>';
                htmlContent += '@page { size: A4; margin: 20mm; }';
                htmlContent +=
                    'body { font-family: "Times New Roman", sans-serif; font-size: 12px; margin: 0; padding: 0; }';
                htmlContent +=
                    'h1 { color: black; text-align: center; font-size: 24px; margin-bottom: 10px; }';
                htmlContent +=
                    'h2 { color: black; text-align: center; font-size: 18px; margin-bottom: 10px; }';
                htmlContent +=
                    'h3 { color: black; text-align: center; font-size: 15px; margin-bottom: 10px; }';
                htmlContent += 'img {width: 100px; height:100px; margin-bottom: 10px; }';
                htmlContent +=
                    'hr.double { border: 0; border-top: 3px double #000; height: 0; margin: 5px 0; }';
                htmlContent += '.entry { margin-bottom: 20px; }';
                htmlContent +=
                    'table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }';
                htmlContent +=
                    '.entry img { width: 400px; height:200px; }';
                htmlContent += 'table, th, td { border: 1px solid black; padding: 5px; }';
                htmlContent +=
                    '.center-vertical-right { display: flex; flex-direction: column; justify-content: center; height: 100vh; text-align: right; padding-right: 20mm; }';
                htmlContent += '</style>';
                htmlContent += '</head><body>';

                htmlContent += '<div class="center-vertical-right">';
                htmlContent +=
                    '<div style="display:flex; justify-content : flex-end; margin-bottom: 20px;">';
                htmlContent +=
                    '<img style="margin-right:5px;" src="/images/logounsud.png" alt="Logo Unsud">';
                htmlContent +=
                    '<img style="margin-left:5px;" src="/images/logoaudit.png" alt="Logo Audit">';
                htmlContent += '</div>';
                htmlContent +=
                    '<h2 style="text-align:right;">LAPORAN AUDIT INVESTIGASI</h2>';
                htmlContent += '<hr>';
                htmlContent +=
                    '<h3 style="text-align:right;">Pusat Keamanan dan Audit Sistem Informasi LPTSI UNSOED</h3>';
                htmlContent += '<hr>';
                htmlContent +=
                    '<p style="text-align : right;">Prof. Dr. Eng, Ir. Retno Supriyanti, S.T., M.T.</p>';
                htmlContent +=
                    '<p>Koordinator Pusat Keamanan dan Audit Sistem Informasi</p>';
                htmlContent +=
                    '<p>Lembaga Pengembangan Teknologi dan Sistem Informasi Universitas Jendral Soedirman</p>';
                htmlContent += '<hr class="double">';
                // htmlContent += '<table>';
                // htmlContent += '<tr><td>Nama Sistem</td><td>' + namas + '</td></tr>';
                // htmlContent += '<tr><td>Kode Sistem</td><td>' + kodes + '</td></tr>';
                // htmlContent += '</table>';
                htmlContent += '</div>';

                // Page break after the header
                htmlContent += '<div style="page-break-after: always;"></div>';

                selectedData.forEach(function(data, index) {
                    htmlContent += '<div class="entry" style="text-align:center;">';
                    htmlContent += '<h3 style="text-align: left;">Audit Ke - ' + (
                        index + 1) + '</h3>';
                    htmlContent +=
                        '<h3 style="text-align: left;">Tanggal Audit : ' + data
                        .tanggal_audit + '</h3>';
                    htmlContent += '<h3 style="text-align: left;">Versi : ' + data
                        .versi + '</h3>';
                    htmlContent += '<h3 style="text-align: left;">Judul : ' + data
                        .judul + '</h3>';
                    htmlContent +=
                        '<h2 style="font-weight: bold;">Pendahuluan</h2>';
                    htmlContent += '<div style="text-align: center;">' + data
                        .pendahuluan + '</div>';
                    htmlContent +=
                        '<h2 style="font-weight: bold;">Nama Sistem</h2>';
                    htmlContent += '<div style="text-align: center;">' + data
                        .namasistem + '</div>';
                    htmlContent +=
                        '<h2 style="font-weight: bold;">Cakupan Audit</h2>';
                    htmlContent += '<div style="text-align: center;">' + data
                        .cakupan_audit + '</div>';
                    htmlContent +=
                        '<h2 style="font-weight: bold;">Tujuan Audit</h2>';
                    htmlContent += '<div style="text-align: center;">' + data
                        .tujuan_audit + '</div>';
                    htmlContent +=
                        '<h2 style="font-weight: bold;">Metodologi Audit</h2>';
                    htmlContent += '<div style="text-align: center;">' + data
                        .metodologi_audit + '</div>';
                    htmlContent +=
                        '<h2 style="font-weight: bold;">Hasil Audit</h2>';
                    htmlContent += '<div style="text-align: center;">' + data
                        .hasil_audit + '</div>';
                    htmlContent +=
                        '<h2 style="font-weight: bold;">Rekomendasi</h2>';
                    htmlContent += '<div style="text-align: center;">' + data
                        .rekomendasi + '</div>';
                    htmlContent +=
                        '<h2 style="font-weight: bold;">Kesimpulan Audit</h2>';
                    htmlContent += '<div style="text-align: center;">' + data
                        .kesimpulan_audit + '</div>';
                    htmlContent += '<hr class="double">';
                    htmlContent += '</div>';
                    if (index < selectedData.length - 1) {
                        htmlContent +=
                            '<div style="page-break-after: always;"></div>';
                    }
                });

                htmlContent +=
                    '<div style="display:flex; width:100%; justify-content:end; ">';
                htmlContent +=
                    '<div style="display:block; text-align:center; width:300px; ">';

                htmlContent += '<p style="margin-top:10px;">Mengetahui</p>';
                htmlContent += '<br>';
                htmlContent +=
                    '<p style="">Prof. Dr. Eng. Ir. Retno Supriyanti, S.T., M.T.</p>';
                htmlContent += '</div>';
                htmlContent += '</div>';

                htmlContent += '</body></html>';


                var printWindow = window.open('', '', 'width=1024,height=768');
                printWindow.document.open();
                printWindow.document.write(htmlContent);
                printWindow.document.close();
                setTimeout(function() {
                    printWindow.print();
                }, 1000);
            } else {
                alert('Tidak ada data terpilih');
            }
        });

    });




    $('.cetakin').click(function() {
        var printContents = $('.preview').html();
        var printWindow = window.open('', '', 'width=1024,height=768');
        printWindow.document.open();
        printWindow.document.write(printContents);
        printWindow.document.close();
        printWindow.print();
    });
     });
</script>

@endpush

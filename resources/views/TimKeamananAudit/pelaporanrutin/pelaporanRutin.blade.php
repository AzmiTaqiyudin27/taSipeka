@php
    use Carbon\Carbon;
@endphp

@extends('TimKeamananAudit.keamananaudit_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pelaporan Audit Sistem Informasi Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/auth/auth/dashboard-audit">Dashboard</a></li>
                                <li class="breadcrumb-item">Pelaporan Audit Sistem
                                    Informasi
                                    Rutin</li>
                            </ol>
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

        <section class="section">
            <a href="{{ route('pelaporan-rutin.create') }}" class="btn btn-success mt-4">
                Tambah
            </a>


            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table row-table" id="table1">
                            <thead>
                                <tr>
                                    <th>Tanggal Audit</th>
                                    <th>Judul</th>
                                    <th>Nama Sistem</th>
                                    <th>Unit Kerja</th>
                                    <th>Versi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($laporan as $item)
                                    <tr>
                                        <td>{{ Carbon::parse($item->tanggal_audit)->format('d-m-Y') }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->kodeaudit->nama_sistem }}</td>
                                        <td>{{ $item->unitkerja->username }}</td>

                                        <td>{{ $item->versi }}</td>
                                        <td style="text-transform:capitalize ">{{ $item->status }}</td>

                                        <td>
                                            @if($item->status == 'draft')
                                            <a href="{{ 'edit-pelaporan-audit-rutin/'. $item->id }}" class="btn btn-warning">Edit</a>
                                            @endif
                                            {{-- <button type="button" class="tomboldetail btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailModal" data-id="{{ $item->id }}">Detail</button> --}}
                                            <button type="button" class="btn btn btn-info tomboldetail"
                                                data-bs-toggle="modal" data-bs-target="#full-scrn"
                                                data-id="{{ $item->id }}">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>



        <div class="me-1 mb-1 d-inline-block">
            <!-- Button trigger for full size modal -->


            <!-- full size modal-->
            <div class="modal fade text-left w-100" id="full-scrn" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel20" aria-hidden="true">
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
                                    <td><span id="detailPendahuluan"></span></td>
                                </tr>
                                <tr>
                                    <td>Cakupan Audit</td>
                                    <td><span id="detailCakupan"></span></td>
                                </tr>
                                <tr>
                                    <td>Tujuan Audit</td>
                                    <td><span id="detailTujuan"></span></td>
                                </tr>
                                <tr>
                                    <td>Metodelogi Audit</td>
                                    <td><span id="detailMetodologi"></span></td>
                                </tr>
                                <tr>
                                    <td>Hasil Audit</td>
                                    <td><span id="detailHasil"></span></td>
                                </tr>
                                <tr>
                                    <td>Rekomendasi</td>
                                    <td><span id="detailRekomendasi"></span></td>
                                </tr>
                                <tr>
                                    <td>Kesimpulan Audit</td>
                                    <td><span id="detailKesimpulan"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
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
                                <td>Unit Kerja</td>
                                <td> <span id="detailUnit"></span></td>
                            </tr>
                            <tr>
                                <td>Pendahuluan</td>
                                <td>: <span id="detailPendahuluan"></span></td>
                            </tr>
                            <tr>
                                <td>Cakupan Audit</td>
                                <td>: <span id="detailCakupan"></span></td>
                            </tr>
                            <tr>
                                <td>Tujuan Audit</td>
                                <td>: <span id="detailTujuan"></span></td>
                            </tr>
                            <tr>
                                <td>Metodelogi Audit</td>
                                <td>: <span id="detailMetodologi"></span></td>
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
                                <td>Kesimpulan</td>
                                <td> <span id="detailKesimpulan"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".tomboldetail").click(function() {
            console.log("anjay");
            var id = $(this).data('id');
            var url = "{{ route('pelaporan-rutin.getData', '') }}/" + id;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Assuming response is JSON, you can parse and display it as needed
                    console.log(response);
                    $("#detailUnit").html(response.unit_kerja.username);
                    $("#detailPendahuluan").html(response.pendahuluan);
                    $("#detailCakupan").html(response.cakupan_audit);
                    $("#detailTujuan").html(response.tujuan_audit);
                    $("#detailMetodologi").html(response.metodologi_audit);
                    $("#detailHasil").html(response.hasil_audit);
                    $("#detailRekomendasi").html(response.rekomendasi);
                    $("#detailKesimpulan").html(response.kesimpulan_audit);


                },
                error: function(xhr) {
                    // Handle error
                    alert('Error fetching data');
                }
            });
        })
    </script>
@endsection

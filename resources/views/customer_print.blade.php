<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Pelanggan</title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <!-- PLUGINS CSS STYLE -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

</head>

<body class="g-sidenav-show">
    <div class="row">
        <div class="col-12">
            <div class="my-4">
                <div class="text-center pb-0">
                    <h4>Daftar Pelanggan</h4>
                </div>

                <div class="px-0 pt-0 pb-2">
                    <div class="p-3">
                        <div>
                            <table id="dataTable" class="table align-items-center mb-0 table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center ">NIK</th>
                                        <th class="text-center ">No. KK</th>
                                        <th class="text-center ">No. Telepon</th>
                                        <th class="text-center ">Alamat</th>
                                        @can('operator')
                                            <th class="text-center ">Petugas</th>
                                        @endcan
                                        <th class="text-center ">Kategori</th>
                                        <th class="text-center ">Tempat Sampah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer as $item)
                                        <tr>
                                            <td class="text-center"><?= $loop->iteration ?></td>
                                            <td><?= $item->nama_pelanggan ?></td>
                                            <td class="text-center "><?= $item->nik ?></td>
                                            <td class="text-center "><?= $item->no_kk ?></td>
                                            <td class="text-center "><?= $item->no_hp ?></td>
                                            <td><?= $item->alamat ?></td>
                                            @can('operator')
                                                <td><?= $item->petugas ?></td>
                                            @endcan
                                            <td class="text-center "><?= $item->kategori ?></td>
                                            <td class="text-center "><?= $item->status ?></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--   JAVASCRIPT   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
</body>

</html>

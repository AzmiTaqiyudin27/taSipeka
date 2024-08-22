@extends('layout')

<?php $data = json_encode($customer); ?>

@section('content')
    <style>
        #pagination .active {
            color: white !important;
        }

        #pagination a {
            padding: 7px 15px;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header text-center pb-0 mt-4">
                    <h4>Pelanggan</h4>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="p-3">
                        <div class="row justify-content-end">
                            <div class="col-4 d-flex justify-content-end">
                                <button class="btn btn-outline-success mx-2 export" data-type="excel"><i
                                        class="bi bi-file-earmark-excel"></i></button>
                                <button class="btn btn-outline-dark export" data-type="print"><i
                                        class="bi bi-printer"></i></button>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-md-6 col-12">
                                @can('operator')
                                    <button data-toggle="modal" data-target="#tambah" type="button"
                                        class="btn btn-primary ml-2">
                                        <i class="fas fa-plus"></i> &nbsp; Tambah</button>
                                    <button data-toggle="modal" data-target="#upload" type="button"
                                        class="btn btn-secondary ml-2">
                                        <i class="fas fa-upload"></i> &nbsp; Unggah</button>
                                @endcan
                            </div>
                            <div class="col-md-3 col-8">
                                <input type="text" id="searchInput" placeholder="Cari..." class="form-control mb-3"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable"
                                class="table align-items-center mb-0 table-striped table-hover table-bordered">
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
                                        @can('operator')
                                            <th class="text-center ">Aksi</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody id="table-body"> </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="pagination" class="justify-content-center text-center mt-3">
                        <a id="prevPage" class="btn btn-outline-primary"><span><i class="fa fa-angle-left"></i></span></a>
                        <div id="pageNumbers" class="btn-group"></div>
                        <a id="nextPage" class="btn btn-outline-primary"><span><i class="fa fa-angle-right"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('operator')
        {{-- Modal tambah --}}
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                    </div>
                    <div class="modal-body">
                        <form id="form-tambah" class="row g-3 needs-validation" novalidate autocomplete="off" method="post">
                            <div class="form-group">
                                <label for="nama_pelanggan">Nama Pelanggan</label>
                                <input required type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                                    placeholder="Masukkan Nama Pelanggan">
                            </div>
                            <div class="form-group">
                                <label for="nik">Nomor Induk Kependudukan</label>
                                <input required type="number" class="form-control" id="nik" name="nik"
                                    placeholder="Masukkan Nomor Induk Kependudukan">
                            </div>
                            <div class="form-group">
                                <label for="no_kk">Nomor Kartu Keluarga</label>
                                <input required type="number" class="form-control" id="no_kk" name="no_kk"
                                    placeholder="Masukkan Nomor Kartu Keluarga">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor Telepon</label>
                                <input required type="number" class="form-control" id="no_hp" name="no_hp"
                                    placeholder="Masukkan Nomor Telepon">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input required type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Masukkan Alamat">
                            </div>
                            <div class="form-group">
                                <label for="petugas">Petugas</label>
                                <select required class="form-control" id="petugas" name="user_id">
                                    <option value="" hidden>Pilih Petugas</option>
                                    @foreach ($petugas as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['nama_petugas'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select required class="form-control" id="kategori" name="category_id">
                                    <option value="" hidden>Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['nama_kategori'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status Tempat Sampah</label>
                                <select required class="form-control" id="status" name="status">
                                    <option value="" hidden>Pilih Status Tempat Sampah</option>
                                    <option value="Ada">Ada</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Tidak Ada">Tidak Ada</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="tambah_pelanggan"
                            data-route="{{ route('pelanggan.store') }}">Simpan</button>
                        <button id="tutup_tambah" class="d-none" data-dismiss="modal"></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal upload --}}
        <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Unggah Pelanggan</h5>
                    </div>
                    <div class="modal-body">
                        <form id="form-upload" class="row g-3 needs-validation" novalidate autocomplete="off" method="post"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label for="file_pelanggan">File Pelanggan</label>
                                    <label>
                                        <a href="" id="template"><i class="fas fa-download"></i>
                                            &nbsp;Template</a>
                                    </label>
                                </div>
                                <input required type="file" accept=".xlsx" class="form-control" id="file_pelanggan"
                                    name="file_pelanggan">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="upload_pelanggan"
                            data-route="{{ route('pelanggan.upload') }}">Simpan</button>
                        <button id="tutup_upload" class="d-none" data-dismiss="modal"></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal edit --}}
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Petugas</h5>
                    </div>
                    <div class="modal-body">
                        <form id="form-edit" class="row g-3 needs-validation" novalidate autocomplete="off" method="post">
                            <div class="form-group">
                                <label for="nama_pelanggan">Nama Pelanggan</label>
                                <input required type="text" class="form-control" id="nama_pelanggan_edit"
                                    name="nama_pelanggan" placeholder="Masukkan Nama Pelanggan">
                            </div>
                            <div class="form-group">
                                <label for="nik">Nomor Induk Kependudukan</label>
                                <input required type="number" class="form-control" id="nik_edit" name="nik"
                                    placeholder="Masukkan Nomor Induk Kependudukan">
                            </div>
                            <div class="form-group">
                                <label for="no_kk">Nomor Kartu Keluarga</label>
                                <input required type="number" class="form-control" id="no_kk_edit" name="no_kk"
                                    placeholder="Masukkan Nomor Kartu Keluarga">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor Telepon</label>
                                <input required type="number" class="form-control" id="no_hp_edit" name="no_hp"
                                    placeholder="Masukkan Nomor Telepon">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input required type="text" class="form-control" id="alamat_edit" name="alamat"
                                    placeholder="Masukkan Alamat">
                            </div>
                            <div class="form-group">
                                <label for="petugas">Petugas</label>
                                <select required class="form-control" id="petugas_edit" name="user_id">
                                    <option value="" hidden>Pilih Petugas</option>
                                    @foreach ($petugas as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['nama_petugas'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select required class="form-control" id="kategori_edit" name="category_id">
                                    <option value="" hidden>Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['nama_kategori'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status Tempat Sampah</label>
                                <select required class="form-control" id="status_edit" name="status">
                                    <option value="" hidden>Pilih Status Tempat Sampah</option>
                                    <option value="Ada">Ada</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Tidak Ada">Tidak Ada</option>
                                </select>
                            </div>
                            <input type="text" name="id" id="id_edit" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="edit_pelanggan"
                            data-route="{{ route('pelanggan.update') }}">Simpan</button>
                        <button id="tutup_edit" class="d-none" data-dismiss="modal"></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    <div id="fetchRoute" data-route="{{ route('pelanggan.fetch') }}"></div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.2/xlsx.full.min.js"></script>
    <script>
        const category_list = <?php echo $kategori; ?>

        const officer_list = <?php echo $petugas; ?>

        // Menampilkan data pada modal edit
        $('#edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang membuka modal
            var id = button.data('id');
            var nama_pelanggan = button.data('nama_pelanggan');
            var nik = button.data('nik');
            var no_kk = button.data('no_kk');
            var no_hp = button.data('no_hp');
            var alamat = button.data('alamat');
            var user_id = button.data('user_id');
            var category_id = button.data('category_id');
            var status = button.data('status');

            // Mengisi data yang diterima ke dalam modal
            var modal = $(this);
            modal.find('#id_edit').val(id);
            modal.find('#nama_pelanggan_edit').val(nama_pelanggan);
            modal.find('#nik_edit').val(nik);
            modal.find('#no_kk_edit').val(no_kk);
            modal.find('#no_hp_edit').val(no_hp);
            modal.find('#alamat_edit').val(alamat);
            modal.find('#petugas_edit').val(user_id);
            modal.find('#kategori_edit').val(category_id);
            modal.find('#status_edit').val(status);
        });


        // Pagination
        let data = <?php echo $data; ?>;

        var role = '<?php echo auth()->user()->role; ?>';

        const itemsPerPage = 10; // Jumlah item per halaman
        let currentPage = 1;
        const maxPageButtons = 5;


        function displayData(page, searchTerm) {
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            let filteredData = data;

            // Filter data berdasarkan searchTerm jika ada
            if (searchTerm) {
                // searchTerm = searchTerm.toLowerCase();
                filteredData = data.filter(item => {
                    return (
                        item.nama_pelanggan.toLowerCase().includes(searchTerm) ||
                        item.nik.toLowerCase().includes(searchTerm) ||
                        item.no_kk.toLowerCase().includes(searchTerm) ||
                        item.no_hp.toLowerCase().includes(searchTerm) ||
                        item.alamat.toLowerCase().includes(searchTerm) ||
                        item.petugas.toLowerCase().includes(searchTerm) ||
                        item.kategori.toLowerCase().includes(searchTerm) ||
                        item.status.toLowerCase().includes(searchTerm)
                    );
                });
            }

            const tableBody = document.getElementById("table-body");

            // Kosongkan isi tabel
            tableBody.innerHTML = "";

            // Tampilkan data pada halaman saat ini dalam tabel
            const pageData = filteredData.slice(startIndex, endIndex);

            let kolom = role == 'petugas' ? 8 : 10;

            if (pageData.length == 0) {
                tableBody.innerHTML = `<tr><td class="text-center" colspan=${kolom}>Data tidak ditemukan</td></tr>`;
            }

            pageData.forEach((item, index) => {
                const row = tableBody.insertRow();
                const no = row.insertCell(0);
                const nama = row.insertCell(1);
                const nik = row.insertCell(2);
                const no_kk = row.insertCell(3);
                const no_hp = row.insertCell(4);
                const alamat = row.insertCell(5);
                let kategori, status, petugas, aksi;
                if (kolom == 8) {
                    kategori = row.insertCell(6);
                    status = row.insertCell(7);
                } else {
                    petugas = row.insertCell(6);
                    kategori = row.insertCell(7);
                    status = row.insertCell(8);
                    aksi = row.insertCell(9);
                }

                // Isi kolom tabel sesuai dengan data Anda
                no.innerHTML = `<td class="align-middle text-center">
                                            <span class="">${startIndex + index + 1 }</span>
                                        </td>`;
                no.style.textAlign = 'center';
                nama.innerHTML = `  <td class="align-middle">
                                                <span class="">${ item.nama_pelanggan }</span>
                                            </td>`;
                nik.innerHTML = `<td class="align-middle text-center">
                                            <span class="">${ item.nik }</span>
                                        </td>`;
                nik.style.textAlign = 'center';
                no_kk.innerHTML = `<td class="align-middle text-center">
                                            <span class="">${ item.no_kk }</span>
                                        </td>`;
                no_kk.style.textAlign = 'center';
                no_hp.innerHTML = `<td class="align-middle text-center">
                                            <span class="">${ item.no_hp }</span>
                                        </td>`;
                no_hp.style.textAlign = 'center';
                alamat.innerHTML = `  <td class="align-middle">
                                                <span class="">${ item.alamat }</span>
                                            </td>`;
                kategori.innerHTML = `<td class="align-middle text-center">
                                            <span class="">${ item.kategori }</span>
                                        </td>`;
                kategori.style.textAlign = 'center';
                status.innerHTML = `<td class="align-middle text-center">
                                            <span class="">${ item.status }</span>
                                        </td>`;
                status.style.textAlign = 'center';

                if (kolom != 8) {
                    petugas.innerHTML = `  <td class="align-middle">
                                                <span class="">${ item.petugas }</span>
                                            </td>`;
                    aksi.innerHTML = ` <td class="align-middle text-center">
                                            <button class="btn btn-link text-danger text-gradient mb-0 delete-button"
                                                data-link="{{ route('pelanggan.destroy') }}" data-id="${item.id}"><i
                                                    class="far fa-trash-alt me-2"></i>Hapus</button>
                                            <button class="btn btn-link text-dark mb-0" data-toggle="modal"
                                                data-target="#edit" data-id="${item.id}"
                                                data-nama_pelanggan="${item.nama_pelanggan}" data-nik="${item.nik}"
                                                data-no_kk="${item.no_kk}" data-no_hp="${item.no_hp}" data-alamat="${item.alamat}" 
                                                data-user_id="${item.user_id}" data-category_id="${item.category_id}"
                                                data-status="${item.status}"><i class="fas fa-pencil-alt text-dark me-2"
                                                    aria-hidden="true"></i>Edit</button>
                                        </td>`;
                    aksi.style.textAlign = 'center';
                }

                // Tambahkan event listener untuk tombol hapus data
                document.querySelectorAll('.delete-button').forEach(button => {
                    button.addEventListener('click', function() {
                        const delete_link = this.getAttribute('data-link');
                        const id_user = this.getAttribute('data-id');

                        // Tampilkan SweetAlert konfirmasi
                        Swal.fire({
                            title: 'Konfirmasi',
                            text: 'Anda yakin ingin menghapus data ini?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, Hapus',
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    html: '<div class="text-center p-4 d-flex justify-content-center"><div class="custom-loader"></div></div>',
                                    allowOutsideClick: false, // Mencegah pengguna menutup alert
                                    showConfirmButton: false,
                                    customClass: {
                                        popup: 'custom-swalert-popup',
                                        content: 'custom-swalert-content'
                                    },
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                                // Jika pengguna menekan "Ya, Hapus," kirim permintaan penghapusan ke controller Laravel
                                $.ajax({
                                    type: 'POST', // Gunakan metode POST
                                    url: delete_link,
                                    data: {
                                        _method: 'DELETE', // Tambahkan _method: 'DELETE' ke data
                                        id: id_user
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr(
                                                'content'
                                            ) // CSRF Token jika diperlukan
                                    },
                                    success: function() {
                                        // fetch data
                                        let fetchRoute = $('#fetchRoute').data(
                                            'route');
                                        $.ajax({
                                            type: 'GET', // Gunakan metode POST
                                            url: fetchRoute,
                                            success: function(
                                                response) {
                                                data = response
                                                currentPage = 1
                                                var prev = document
                                                    .getElementById(
                                                        'prevPage');
                                                var next = document
                                                    .getElementById(
                                                        'nextPage');
                                                prev.style.display =
                                                    'inline-block';
                                                next.style.display =
                                                    'inline-block';

                                                $('#searchInput')
                                                    .val('')
                                                displayData(
                                                    currentPage);
                                                updatePageButtons();
                                            }
                                        });
                                        // memberikan pesan sukses
                                        Swal.fire({
                                            title: 'Sukses',
                                            text: "Data berhasil di hapus",
                                            icon: 'success',
                                            showConfirmButton: true
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        // Handle kesalahan
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: "Terjadi kesalahan",
                                            icon: 'error',
                                            showConfirmButton: true,
                                            // timer: 1500
                                        })
                                    }
                                });
                            }
                        });
                    });
                });
            });
        }


        // Fungsi untuk mengatur halaman ke halaman berikutnya
        function nextPage(searchTerm) {
            if (currentPage < Math.ceil(data.length / itemsPerPage)) {
                currentPage++;
                displayData(currentPage);
                updatePageButtons();
            }
        }


        // // Fungsi untuk mengatur halaman ke halaman sebelumnya
        function prevPage(searchTerm) {
            if (currentPage > 1) {
                currentPage--;
                displayData(currentPage);
                updatePageButtons();
            }
        }


        function updatePageButtons(searchTerm) {
            let filteredData = data;
            if (searchTerm) {
                // searchTerm = searchTerm.toLowerCase();
                filteredData = data.filter(item => {
                    return (
                        item.nama_pelanggan.toLowerCase().includes(searchTerm) ||
                        item.nik.toLowerCase().includes(searchTerm) ||
                        item.no_kk.toLowerCase().includes(searchTerm) ||
                        item.alamat.toLowerCase().includes(searchTerm) ||
                        item.petugas.toLowerCase().includes(searchTerm) ||
                        item.kategori.toLowerCase().includes(searchTerm) ||
                        item.status.toLowerCase().includes(searchTerm)
                    );
                });
            }

            const maxPage = Math.ceil(filteredData.length / itemsPerPage);
            const pageNumbers = document.getElementById("pageNumbers");

            const prevPageButton = document.getElementById("prevPage");
            const nextPageButton = document.getElementById("nextPage");

            pageNumbers.innerHTML = "";

            // Hitung rentang tombol halaman yang akan ditampilkan
            const startPage = Math.max(1, currentPage - Math.floor(maxPageButtons / 2));
            const endPage = Math.min(maxPage, startPage + maxPageButtons - 1);

            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement("a");
                pageButton.textContent = i;
                pageButton.className = "btn btn-outline-primary";
                pageButton.addEventListener("click", () => {
                    currentPage = i;
                    if (searchTerm) {
                        displayData(currentPage, searchTerm);
                        updatePageButtons(searchTerm);
                    } else {
                        displayData(currentPage);
                        updatePageButtons();
                    }
                });

                if (i === currentPage) {
                    pageButton.classList.add("active");
                }

                pageNumbers.appendChild(pageButton);
            }

            prevPageButton.hidden = currentPage === 1;
            nextPageButton.hidden = currentPage === maxPage;

            prevPageButton.addEventListener("click", prevPage);
            nextPageButton.addEventListener("click", nextPage);

            prevPageButton.classList.remove("active");
            nextPageButton.classList.remove("active");

            if (filteredData.length <= itemsPerPage) {
                $('#pagination').addClass("d-none");
            } else {
                $('#pagination').removeClass("d-none");
            }

        }


        displayData(currentPage);
        updatePageButtons();


        // // Searching
        document.querySelector('#searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value;
            var prev = document.getElementById('prevPage');
            var next = document.getElementById('nextPage');
            currentPage = 1;

            displayData(currentPage, searchTerm);
            updatePageButtons(searchTerm);

            if (searchTerm) {
                prev.style.display = 'none';
                next.style.display = 'none';
            } else {
                prev.style.display = 'inline-block';
                next.style.display = 'inline-block';
            }
        });


        // form tambah
        $(document).on('click', '#tambah_pelanggan', function() {
            event.preventDefault()
            event.stopPropagation()

            const link = this.getAttribute('data-route');
            const nama_pelanggan = $('#nama_pelanggan').val()
            const nik = $('#nik').val()
            const no_kk = $('#no_kk').val()
            const no_hp = $('#no_hp').val()
            const alamat = $('#alamat').val()
            const user_id = $('#petugas').val()
            const category_id = $('#kategori').val()
            const status = $('#status').val()
            const formData = new FormData();
            let tombol = document.getElementById('tutup_tambah')

            // validasi
            if (!nama_pelanggan || !nik || !no_kk || !no_hp || !alamat || !role || !user_id || !category_id || !
                status) {
                $("#form-tambah").addClass('was-validated')
                return;
            }

            tombol.click()
            $("#form-tambah").removeClass('was-validated')

            // Tambahkan nilai nama dan jabatan ke FormData
            formData.append('nama_pelanggan', nama_pelanggan);
            formData.append('nik', nik);
            formData.append('no_kk', no_kk);
            formData.append('no_hp', no_hp);
            formData.append('alamat', alamat);
            formData.append('role', role);
            formData.append('user_id', user_id);
            formData.append('category_id', category_id);
            formData.append('status', status);

            // konfirmasi
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah data yang anda masukan sudah benar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // menampilkan loading
                    Swal.fire({
                        html: '<div class="text-center p-4 d-flex justify-content-center"><div class="custom-loader"></div></div>',
                        allowOutsideClick: false, // Mencegah pengguna menutup alert
                        showConfirmButton: false,
                        customClass: {
                            popup: 'custom-swalert-popup',
                            content: 'custom-swalert-content'
                        },
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    // Jika pengguna menekan "Ya, Hapus," kirim permintaan penghapusan ke controller Laravel
                    $.ajax({
                        type: 'POST', // Gunakan metode POST
                        url: link,
                        processData: false,
                        contentType: false,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // CSRF Token jika diperlukan
                        },
                        success: function() {
                            // fetch data
                            $('#nama_pelanggan').val('')
                            $('#nik').val('')
                            $('#no_kk').val('')
                            $('#no_hp').val('')
                            $('#alamat').val('')
                            $('#petugas').val('')
                            $('#kategori').val('')
                            $('#status').val('')
                            let fetchRoute = $('#fetchRoute').data(
                                'route');
                            $.ajax({
                                type: 'GET', // Gunakan metode POST
                                url: fetchRoute,
                                success: function(
                                    response) {
                                    data = response
                                    currentPage = 1
                                    var prev = document.getElementById('prevPage');
                                    var next = document.getElementById('nextPage');

                                    prev.style.display = 'inline-block';
                                    next.style.display = 'inline-block';
                                    $('#searchInput').val('')
                                    displayData(currentPage);
                                    updatePageButtons();
                                }
                            });
                            // memberikan pesan sukses
                            Swal.fire({
                                title: 'Sukses',
                                text: "Data berhasil di simpan",
                                icon: 'success',
                                showConfirmButton: true
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle kesalahan
                            Swal.fire({
                                title: 'Gagal',
                                text: xhr.responseJSON.message,
                                icon: 'error',
                                showConfirmButton: true,
                                // timer: 1500
                            })
                        }
                    });
                }
            });
        })


        // download template
        $('#template').click(function(e) {

            e.preventDefault()

            let dataToExport = [
                ["Petugas", "Kategori", "Nama", "NIK", "No. KK", "No. Telepon", "Alamat", "Tempat Sampah"],
            ];

            let dataGuide = [
                ["Tempat Sampah :"],
                ["- Ada"],
                ["- Tidak Ada"],
                ["- Rusak"],
                [],
                ["Kategori :"],
            ];

            category_list.forEach(function(item) {
                dataGuide.push([item.id + '. ' + item
                    .nama_kategori
                ]);
            });

            dataGuide.push([]);
            dataGuide.push(["Petugas :"]);

            officer_list.forEach(function(item) {
                dataGuide.push([item.id + '. ' + item
                    .nama_petugas
                ]);
            });

            let wb = XLSX.utils.book_new();
            let ws = XLSX.utils.aoa_to_sheet(dataToExport);
            XLSX.utils.book_append_sheet(wb, ws, 'Data Pelanggan');

            ws = XLSX.utils.aoa_to_sheet(dataGuide);
            XLSX.utils.book_append_sheet(wb, ws, 'Petunjuk Pengisian');

            // Simpan workbook sebagai file Excel
            XLSX.writeFile(wb, `Unggah_Pelanggan.xlsx`);
        })


        // form upload
        $(document).on('click', '#upload_pelanggan', function() {
            event.preventDefault()
            event.stopPropagation()

            const link = this.getAttribute('data-route');
            const file_pelanggan = $('#file_pelanggan').val()
            const jabatan = $('#jabatan').val()
            let tombol = document.getElementById('tutup_upload')
            const fileInput = document.getElementById('file_pelanggan');
            const formData = new FormData();

            // validasi
            if (!file_pelanggan) {
                $("#form-upload").addClass('was-validated')
                return;
            }

            tombol.click()
            $("#form-upload").removeClass('was-validated')

            // Tambahkan nilai nama dan jabatan ke FormData
            const file = fileInput.files[0];
            formData.append('file_pelanggan', file);

            // konfirmasi
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah data yang anda masukan sudah benar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // menampilkan loading
                    Swal.fire({
                        html: '<div class="text-center p-4 d-flex justify-content-center"><div class="custom-loader"></div></div>',
                        allowOutsideClick: false, // Mencegah pengguna menutup alert
                        showConfirmButton: false,
                        customClass: {
                            popup: 'custom-swalert-popup',
                            content: 'custom-swalert-content'
                        },
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    // Jika pengguna menekan "Ya, Hapus," kirim permintaan penghapusan ke controller Laravel
                    $.ajax({
                        type: 'POST', // Gunakan metode POST
                        url: link,
                        processData: false,
                        contentType: false,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // CSRF Token jika diperlukan
                        },
                        success: function() {
                            // fetch data
                            $('#file_petugas').val('')
                            let fetchRoute = $('#fetchRoute').data(
                                'route');
                            $.ajax({
                                type: 'GET', // Gunakan metode POST
                                url: fetchRoute,
                                success: function(
                                    response) {
                                    data = response
                                    currentPage = 1
                                    var prev = document.getElementById('prevPage');
                                    var next = document.getElementById('nextPage');

                                    prev.style.display = 'inline-block';
                                    next.style.display = 'inline-block';
                                    $('#searchInput').val('')
                                    $('#file_pelanggan').val('')
                                    displayData(currentPage);
                                    updatePageButtons();
                                }
                            });
                            // memberikan pesan sukses
                            Swal.fire({
                                title: 'Sukses',
                                text: "Data berhasil di simpan",
                                icon: 'success',
                                showConfirmButton: true
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle kesalahan
                            Swal.fire({
                                title: 'Gagal',
                                text: "Periksa file yang anda masukan dan coba lagi",
                                icon: 'error',
                                showConfirmButton: true,
                                // timer: 1500
                            })
                            $('#file_pelanggan').val('')
                        }
                    });
                }
            });
        })


        // form edit
        $(document).on('click', '#edit_pelanggan', function() {
            event.preventDefault()
            event.stopPropagation()

            const link = this.getAttribute('data-route');
            const id = $('#id_edit').val()
            const nama_pelanggan = $('#nama_pelanggan_edit').val()
            const nik = $('#nik_edit').val()
            const no_kk = $('#no_kk_edit').val()
            const no_hp = $('#no_hp_edit').val()
            const alamat = $('#alamat_edit').val()
            const user_id = $('#petugas_edit').val()
            const category_id = $('#kategori_edit').val()
            const status = $('#status_edit').val()
            const formData = new FormData();
            let tombol = document.getElementById('tutup_edit')

            // validasi
            if (!nama_pelanggan || !nik || !no_kk || !no_hp || !alamat || !role || !user_id || !category_id || !
                status) {
                $("#form-edit").addClass('was-validated')
                return;
            }

            tombol.click()
            $("#form-edit").removeClass('was-validated')

            // Tambahkan nilai nama dan jabatan ke FormData
            formData.append('id', id);
            formData.append('nama_pelanggan', nama_pelanggan);
            formData.append('nik', nik);
            formData.append('no_kk', no_kk);
            formData.append('no_hp', no_hp);
            formData.append('alamat', alamat);
            formData.append('role', role);
            formData.append('user_id', user_id);
            formData.append('category_id', category_id);
            formData.append('status', status);

            // konfirmasi
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah data yang anda masukan sudah benar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // menampilkan loading
                    Swal.fire({
                        html: '<div class="text-center p-4 d-flex justify-content-center"><div class="custom-loader"></div></div>',
                        allowOutsideClick: false, // Mencegah pengguna menutup alert
                        showConfirmButton: false,
                        customClass: {
                            popup: 'custom-swalert-popup',
                            content: 'custom-swalert-content'
                        },
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    // Jika pengguna menekan "Ya, Hapus," kirim permintaan penghapusan ke controller Laravel
                    $.ajax({
                        type: 'POST', // Gunakan metode POST
                        url: link,
                        processData: false,
                        contentType: false,
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-HTTP-Method-Override',
                                'PUT'); // Menambahkan header untuk metode PUT
                        },
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // CSRF Token jika diperlukan
                        },
                        success: function() {
                            // fetch data
                            let fetchRoute = $('#fetchRoute').data(
                                'route');
                            $.ajax({
                                type: 'GET', // Gunakan metode POST
                                url: fetchRoute,
                                success: function(
                                    response) {
                                    data = response
                                    currentPage = 1
                                    var prev = document.getElementById('prevPage');
                                    var next = document.getElementById('nextPage');

                                    prev.style.display = 'inline-block';
                                    next.style.display = 'inline-block';
                                    $('#searchInput').val('')
                                    displayData(currentPage);
                                    updatePageButtons();
                                }
                            });
                            // memberikan pesan sukses
                            Swal.fire({
                                title: 'Sukses',
                                text: "Data berhasil di simpan",
                                icon: 'success',
                                showConfirmButton: true
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle kesalahan
                            Swal.fire({
                                title: 'Gagal',
                                text: xhr.responseJSON.message,
                                icon: 'error',
                                showConfirmButton: true,
                                // timer: 1500
                            })
                        }
                    });
                }
            });
        })

        $('.export').on('click', function() {
            // Data yang akan diekspor (misalnya dari variabel)
            let dataToExport = [
                ["No.", "Nama", "NIK", "No. KK", "No. Telepon", "Alamat", "Petugas", "Kategori",
                    "Tempat Sampah"
                ]
            ];

            // push data
            data.forEach(function(item, index) {
                dataToExport.push([index + 1, item.nama_pelanggan, item.nik, item.no_kk, item.no_hp, item
                    .alamat, item
                    .petugas, item.kategori, item.status
                ]);
            });

            if (this.getAttribute('data-type') == 'excel') {

                // Buat objek Workbook dari data
                let wb = XLSX.utils.book_new();
                let ws = XLSX.utils.aoa_to_sheet(dataToExport);
                XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                // Simpan workbook sebagai file Excel
                XLSX.writeFile(wb, `Data_Pelanggan.xlsx`);

            } else {

                let currentURL = window.location.href;
                let pathArray = currentURL.split('/');
                let protocol = pathArray[0];
                let host = pathArray[2];
                let rootURL = protocol + '//' + host + "/pelanggan/print";

                let width = screen.width;
                let height = screen.height;
                // let customerWindow = window.open(rootURL, '', `fullscreen=yes`);
                let customerWindow = window.open(rootURL, '', `width=${width},height=${height}`);

                customerWindow.onload = function() {
                    customerWindow.print();
                };

                customerWindow.onafterprint = function() {
                    customerWindow.close();
                };

                customerWindow.onbeforeunload = function() {
                    customerWindow.close();
                };

            }
        });
    </script>
@endsection

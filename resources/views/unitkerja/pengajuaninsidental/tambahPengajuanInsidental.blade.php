@extends('unitkerja.unitkerja_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Pengajuan Audit Sistem Informasi Insidental</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/dashboard-unitkerja">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/auth/auditinsidental-unitkerja">Pengajuan Audit Sistem
                                    Informasi
                                    Insidental</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pengajuan-insidental.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal_lapor" class="form-label">Tanggal Pengajuan</label>
                            <input type="date" name="tanggal_lapor" id="tanggal_lapor" class="form-control"
                                placeholder="Tanggal Lapor" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_sistem" class="form-label">Nama Sistem</label>
                            <input type="text" name="nama_sistem" id="nama_sistem" class="form-control"
                                placeholder="Nama Sistem" required>
                        </div>
                        <div class="form-group">
                            <label for="kendala" class="form-label">Kendala</label>
                            <input type="text" name="kendala" id="kendala" class="form-control" placeholder="Kendala"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control"
                                placeholder="Keterangan" required>
                        </div>

                        <!-- Input Foto untuk Multiple File Upload -->
                        <div class="form-group" id="fileInputsContainer">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" name="foto[]" id="fotoInput" class="form-control mb-2" multiple>
                        </div>

                        <!-- Daftar file yang telah dipilih -->
                        <div class="form-group">
                            <label>File yang Dipilih:</label>
                            <ul id="fileList"></ul> <!-- Tempat file yang akan ditampilkan -->
                        </div>

                        <!-- Tombol untuk menambah input file -->
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" id="addFileInputBtn">Tambah File</button>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Script untuk menambahkan dan mengelola file input -->
      <script>
    let fileInputIndex = 1; // Index untuk input file yang dinamis

    document.getElementById('fotoInput').addEventListener('change', function() {
        handleFileChange(this);
    });

    // Menangani perubahan pada input file
    function handleFileChange(input) {
        var fileList = document.getElementById('fileList');
        fileList.innerHTML = ''; // Kosongkan isi sebelumnya

        for (var i = 0; i < input.files.length; i++) {
            var li = document.createElement('li');
            li.textContent = input.files[i].name + " ";

            // Buat tombol hapus untuk file
            var removeButton = document.createElement('button');
            removeButton.type = "button";
            removeButton.textContent = "Hapus";
            removeButton.className = "btn btn-danger btn-sm";
            removeButton.onclick = function() {
                input.value = ""; // Reset input file
                li.remove(); // Hapus nama file dari list
            };

            li.appendChild(removeButton);
            fileList.appendChild(li);
        }
    }

    // Menambah input file baru saat tombol 'Tambah File Lain' diklik
    document.getElementById('addFileInputBtn').addEventListener('click', function() {
        fileInputIndex++;
        var newFileInput = document.createElement('input');
        newFileInput.type = 'file';
        newFileInput.name = 'foto[]';
        newFileInput.className = 'form-control mb-2';
        newFileInput.id = 'fotoInput' + fileInputIndex;
        newFileInput.multiple = true;

        newFileInput.addEventListener('change', function() {
            handleFileChange(this);
        });

        // Tambahkan input file baru ke container
        document.getElementById('fileInputsContainer').appendChild(newFileInput);
    });
</script>
    @endsection

@extends('unitkerja.unitkerja_layout')
@section('content')


    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Pengajuan Audit Sistem Informasi Rutin</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/auth/dashboard-unitkerja">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/auth/pengajuan-rutin">Pengajuan Audit Sistem Informasi
                                    Rutin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

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
                       <form action="{{ route('pengajuan-rutin.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="tanggal_lapor" class="form-label">Tanggal Pengajuan</label>
        <input type="date" name="tanggal_lapor" id="tanggal_lapor" class="form-control"  value="{{  date('Y-m-d'); }}"placeholder="Tanggal Lapor"  value="{{  date('Y-m-d'); }}" required>
    </div>
    <div class="form-group">
        <label for="nama_sistem" class="form-label">Nama Sistem</label>
        <input type="text" name="nama_sistem" id="nama_sistem" class="form-control" placeholder="Nama Sistem" required>
    </div>
    <div class="form-group">
        <label for="versi" class="form-label">Versi</label>
        <input type="text" name="versi" id="versi" class="form-control" placeholder="Versi" required>
    </div>
    <div class="form-group">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="longText" name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" required>
    </div>

    <!-- Input Dokumen untuk Multiple File Upload -->
    <div id="fileInputsContainer" class="form-group">
        <label for="dokumen" class="form-label">Dokumen</label>
        <input type="file" name="dokumen[]" id="dokumen" class="form-control" placeholder="Dokumen" multiple>
    </div>

    <!-- Elemen untuk Menampilkan Nama File yang Dipilih -->
    <div class="form-group">
        <label>File yang Dipilih:</label>
        <ul id="fileList"></ul> <!-- Ini adalah tempat nama file yang akan ditampilkan -->
    </div>

    <!-- Tombol untuk menambahkan input file lagi -->
    <div class="form-group">
        <button type="button" id="addFileInputBtn" class="btn btn-primary">Tambah File Lain</button>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Tambah</button>
    </div>
</form>
                    </div>
                </div>
            </div>
    </div>
    </section>


   <script>
    let fileInputIndex = 1; // Index untuk input file yang dinamis

    document.getElementById('dokumen').addEventListener('change', function() {
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
        newFileInput.name = 'dokumen[]';
        newFileInput.className = 'form-control';
        newFileInput.id = 'dokumen' + fileInputIndex;
        newFileInput.multiple = true;

        newFileInput.addEventListener('change', function() {
            handleFileChange(this);
        });

        // Tambahkan input file baru ke container
        document.getElementById('fileInputsContainer').appendChild(newFileInput);
    });
</script>

@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <h6>Audit Ke-{!! $urutan !!}</h6>
    <h6>Tanggal Audit: {!! $tanggal !!}</h6>
    <h6>Versi : {!! $versi !!}</h6>
    <h6>Judul : {!! $judul !!}</h6>
    <h3 class="text-center">Pendahuluan</h3>
    <div class="text-center">{!! str_replace('src="/storage/storage', 'src="' . public_path('storage/storage'), $pendahuluan) !!}</div> 
    <h3 class="text-center">Cakupan Audit</h3>
    <div class="text-center">{!! str_replace('src="/storage/storage', 'src="' . public_path('storage/storage'), $cakupanAudit) !!}</div>

    <h3 class="text-center">Tujuan Audit</h3>
    <div class="text-center">{!! str_replace('src="/storage/storage', 'src="' . public_path('storage/storage'), $tujuanAudit) !!}</div>
    <h3 class="text-center">Metodologi Audit</h3>
    <div class="text-center">{!! str_replace('src="/storage/storage', 'src="' . public_path('storage/storage'), $metodologiAudit) !!}</div>
    <h3 class="text-center">Hasil Audit</h3>
    <div class="text-center">{!! str_replace('src="/storage/storage', 'src="' . public_path('storage/storage'), $hasilAudit) !!}</div>
    <h3 class="text-center">Rekomendasi</h3>
    <div class="text-center">{!! str_replace('src="/storage/storage', 'src="' . public_path('storage/storage'), $hasilAudit) !!}</div>
    <h3 class="text-center">Kesimpulan Audit</h3>
    <div class="text-center">{!! str_replace('src="/storage/storage', 'src="' . public_path('storage/storage'), $kesimpulanAudit) !!}</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

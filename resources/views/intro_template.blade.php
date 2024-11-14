 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cover</title>
    <style>
        body {
            font-family: "Times New Roman", sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: black;
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
        }
        h2 {
            color: black;
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
        }
        h3 {
            color: black;
            text-align: center;
            font-size: 15px;
            margin-bottom: 10px;
        }
        img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }
        hr.double {
            border: 0;
            border-top: 3px double #000;
            height: 0;
            margin: 5px 0;
        }
        .entry {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .entry img {
            width: 400px;
            height: 200px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
        .center-vertical-right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
            text-align: right;
            padding-right: 20mm;
        }
    </style>
</head>
<body>
    <div class="center-vertical-right" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%;">
        <!-- Logo Section -->
        <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
            {{-- <img style="margin-right: 5px;" src="{{ asset('assets/compiled/png/unsoed.png') }}" alt="Logo Unsud"> --}}
            <img src="{{ public_path('images/logounsud.png') }}" alt="Logo Unsoed" style="margin-right: 5px; width:100px; height:100px;">
            <img src="{{ public_path('images/logoaudit.png') }}" alt="Logo Audit" style="margin-left: 5px; width:100px; height:100px;">
            {{-- <img src="{{ public_path('storage/storage/1731571970_pocong.jpg') }}" alt="Logo Audit" style="margin-left: 5px; width:100px; height:100px;"> --}}
            {{-- <img src="{{ Storage::url('storage/1731571970_pocong.jpg') }}" alt="Logo Unsoed"> --}}
         


             </div>

        <!-- Title Section -->
        <h2 style="text-align: right;">LAPORAN AUDIT INVESTIGASI</h2>
        <hr>
        <h3 style="text-align: right;">Pusat Keamanan dan Audit Sistem Informasi LPTSI UNSOED</h3>
        <hr>

        <!-- Coordinator Information -->
        <p style="text-align: right;">Prof. Dr. Eng, Ir. Retno Supriyanti, S.T., M.T.</p>
        <p>Koordinator Pusat Keamanan dan Audit Sistem Informasi</p>
        <p>Lembaga Pengembangan Teknologi dan Sistem Informasi Universitas Jendral Soedirman</p>
        <hr class="double">
    </div>
</body>
</html> 
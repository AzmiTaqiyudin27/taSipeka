<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Audit Sistem Informasi Rutin</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .foto {
            width: 50%;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>UNIVERSITAS JENDRAL SOEDIRMAN</h2>
        <p>ALAMAT DISINI</p>
    </div>

    <h1>Laporan Audit Sistem Informasi Rutin</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal Lapor</th>
                <th>Nama Sistem</th>
                <th>Kendala</th>
                <th>Keterangan</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->tanggal_lapor }}</td>
                    <td>{{ $item->nama_sistem }}</td>
                    <td>{{ $item->kendala }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        @foreach (explode(', ', $item->foto) as $foto)
                            <img src="{{ public_path('foto/' . $foto) }}" class="foto" alt="Foto">
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

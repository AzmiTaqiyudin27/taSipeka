<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penindakan Audit Sistem Informasi Rutin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1,
        h2 {
            text-align: center;
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
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>UNIVERSITAS JENDRAL SOEDIRMAN</h2>
        <p>ALAMAT DISINI</p>
    </div>
    <h1>Penindakan Audit Sistem Informasi Rutin</h1>

    @foreach ($data as $group)
        <h2>Kode: {{ $group->first()->pelaporan_rutin_id }}</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelaporan Rutin ID</th>
                    <th>User ID</th>
                    <th>Tanggal Audit</th>
                    <th>Nama Sistem</th>
                    <th>Versi</th>
                    <th>Keamanan Sistem</th>
                    <th>Bahasa Pemrograman</th>
                    <th>Framework</th>
                    <th>Maksimum Penyimpanan</th>
                    <th>Maksimum Pengguna</th>
                    <th>Pengguna Sistem</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->pelaporan_rutin_id }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_audit)->format('d-m-Y') }}</td>
                        <td>{{ $item->nama_sistem }}</td>
                        <td>{{ $item->versi }}</td>
                        <td>{{ $item->keamanan_sistem }}</td>
                        <td>{{ $item->bahasa_pemrograman }}</td>
                        <td>{{ $item->framework }}</td>
                        <td>{{ $item->maksimum_penyimpanan }}</td>
                        <td>{{ $item->maksimum_pengguna }}</td>
                        <td>{{ $item->pengguna_sistem }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>

</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Gaji</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2, p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 6px;
        }

        th {
            background-color: #eeeeee;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

<h2>Laporan Gaji Karyawan</h2>

<p>
    Periode:
    {{ $bulanTahun ?? 'Semua Periode' }}
</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Jabatan</th>
            <th>Bulan/Tahun</th>
            <th>Potongan Pinjaman</th>
            <th>Gaji Bersih</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($penggajians as $penggajian)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penggajian->karyawan->nama_karyawan ?? '-' }}</td>
                <td>{{ $penggajian->karyawan->jabatan->nama_jabatan ?? '-' }}</td>
                <td>{{ $penggajian->bulan_tahun }}</td>
                <td class="text-right">
                    Rp {{ number_format($penggajian->potongan_pinjaman, 0, ',', '.') }}
                </td>
                <td class="text-right">
                    Rp {{ number_format($penggajian->gaji_bersih, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th colspan="5" class="text-right">Total Gaji Bersih</th>
            <th class="text-right">
                Rp {{ number_format($totalGajiBersih, 0, ',', '.') }}
            </th>
        </tr>
    </tfoot>
</table>

</body>
</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Rekap Gaji</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .container {
            width: 100%;
            margin: 20px auto;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .header {
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #eeeeee;
        }

        .summary {
            margin-top: 20px;
            width: 45%;
            margin-left: auto;
        }

        .signature {
            margin-top: 50px;
            width: 250px;
            margin-left: auto;
            text-align: center;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

<div class="container">

    <div class="header text-center">
        <h2>PT PELATIHAN LSP</h2>
        <p>Jl. Pendidikan No. 1, Tangerang Selatan</p>
        <h3>LAPORAN REKAPITULASI PENGGAJIAN</h3>

        <p>
            Periode:
            @if ($bulan && $tahun)
                {{ $bulan }} {{ $tahun }}
            @else
                Semua Periode
            @endif
        </p>

        <p>
            Tanggal Cetak: {{ date('d-m-Y H:i') }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Periode</th>
                <th>Gapok</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
                <th>Gaji Bersih</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($penggajians as $penggajian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $penggajian->karyawan->nik ?? '-' }}</td>
                    <td>{{ $penggajian->karyawan->nama_karyawan ?? '-' }}</td>
                    <td>{{ $penggajian->karyawan->jabatan->nama_jabatan ?? '-' }}</td>
                    <td>{{ $penggajian->bulan_tahun }}</td>

                    <td class="text-right">
                        Rp {{ number_format($penggajian->karyawan->jabatan->gapok ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        Rp {{ number_format($penggajian->karyawan->jabatan->tunjangan_makan ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        Rp {{ number_format($penggajian->potongan_pinjaman, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        Rp {{ number_format($penggajian->gaji_bersih, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="summary">
        <tr>
            <th>Total Gapok</th>
            <td class="text-right">
                Rp {{ number_format($totalGapok, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th>Total Tunjangan</th>
            <td class="text-right">
                Rp {{ number_format($totalTunjangan, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th>Total Potongan</th>
            <td class="text-right">
                Rp {{ number_format($totalPotongan, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th>Total Gaji Bersih</th>
            <td class="text-right">
                Rp {{ number_format($totalGajiBersih, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <div class="signature">
        <p>Administrator</p>
        <br><br><br>
        <p>
            {{ Auth::user()->name ?? 'Admin' }}
        </p>
    </div>

    <div class="text-center">
        <button onclick="window.print()">Cetak Ulang</button>
    </div>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Slip Gaji</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000;
        }

        .container {
            width: 700px;
            margin: 30px auto;
            border: 1px solid #000;
            padding: 30px;
        }

        .text-center {
            text-align: center;
        }

        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 7px;
            vertical-align: top;
        }

        .section-title {
            background: #eeeeee;
            font-weight: bold;
            padding: 8px;
            margin-top: 20px;
            border: 1px solid #000;
        }

        .bordered td {
            border: 1px solid #000;
        }

        .text-right {
            text-align: right;
        }

        .total {
            font-weight: bold;
            font-size: 16px;
        }

        @media print {
            button {
                display: none;
            }

            .container {
                margin: 0 auto;
            }
        }
    </style>
</head>

<body onload="window.print()">

<div class="container">

    <div class="header text-center">
        <h2>PT Pelatihan LSP</h2>
        <p>Jl. Pendidikan No. 1, Tangerang Selatan</p>
        <h3>SLIP GAJI KARYAWAN</h3>
    </div>

    <table>
        <tr>
            <td width="160">NIK</td>
            <td width="10">:</td>
            <td>{{ $penggajian->karyawan->nik ?? '-' }}</td>
        </tr>

        <tr>
            <td>Nama Karyawan</td>
            <td>:</td>
            <td>{{ $penggajian->karyawan->nama_karyawan ?? '-' }}</td>
        </tr>

        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $penggajian->karyawan->jabatan->nama_jabatan ?? '-' }}</td>
        </tr>

        <tr>
            <td>Periode</td>
            <td>:</td>
            <td>{{ $penggajian->bulan_tahun }}</td>
        </tr>
    </table>

    <div class="section-title">Pendapatan</div>

    <table class="bordered">
        <tr>
            <td>Gaji Pokok</td>
            <td class="text-right">
                Rp {{ number_format($penggajian->karyawan->jabatan->gapok ?? 0, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <td>Tunjangan Makan</td>
            <td class="text-right">
                Rp {{ number_format($penggajian->karyawan->jabatan->tunjangan_makan ?? 0, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <div class="section-title">Potongan</div>

    <table class="bordered">
        <tr>
            <td>Potongan Pinjaman</td>
            <td class="text-right">
                Rp {{ number_format($penggajian->potongan_pinjaman, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <div class="section-title">Total</div>

    <table class="bordered">
        <tr>
            <td class="total">Gaji Bersih</td>
            <td class="text-right total">
                Rp {{ number_format($penggajian->gaji_bersih, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <br><br>

    <table>
        <tr>
            <td class="text-center">
                Karyawan
                <br><br><br><br>
                {{ $penggajian->karyawan->nama_karyawan ?? '-' }}
            </td>

            <td class="text-center">
                Admin
                <br><br><br><br>
                {{ Auth::user()->name ?? 'Administrator' }}
            </td>
        </tr>
    </table>

    <br>

    <div class="text-center">
        <button onclick="window.print()">Cetak Ulang</button>
    </div>

</div>

</body>
</html>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            line-height: 1.5;
            color: #000;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        .main-table td {
            border: 1px solid #000;
            padding: 10px;
            vertical-align: top;
        }

        .header-logo {
            width: 80px;
            text-align: center;
        }

        .header-title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .header-date {
            text-align: left;
            font-size: 12px;
        }

        .section-header {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .label {
            font-weight: bold;
            width: 25%;
        }

        .value {
            width: 25%;
        }

        .signature-table {
            width: 100%;
            margin-top: 50px;
            border: none;
        }

        .signature-table td {
            border: none;
            text-align: center;
            vertical-align: top;
            padding: 10px;
        }
    </style>
</head>

<body>

    <table class="main-table">
        <!-- Header -->
        <tr>
            <td class="header-logo"><img src="{{ public_path('image/logo-rs.png') }}" width="60"></td>
            <td class="header-title" style="vertical-align: middle;">FORM PERMINTAAN PERUBAHAN</td>
            <td class="header-date" style="vertical-align: middle;">
                Tanggal Permintaan:<br>{{ $permintaan->created_at->format('d-m-Y') }}
            </td>
        </tr>
    </table>

    <table class="main-table" style="margin-top: -1px;">
        <!-- Informasi Pemohon -->
        <tr>
            <td colspan="4" class="section-header">Informasi Pemohon :</td>
        </tr>
        <tr>
            <td class="label">Nama Pemohon</td>
            <td class="value">{{ $permintaan->nama_pemohon }}</td>
            <td class="label">Bagian / Unit</td>
            <td class="value">{{ $permintaan->bagian_unit }}</td>
        </tr>
        <tr>
            <td class="label">NIP</td>
            <td class="value">{{ $permintaan->nip ?? '-' }}</td>
            <td class="label">EXT</td>
            <td class="value">{{ $permintaan->nomor_ext ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">RM Pasien & Nama</td>
            <td colspan="3">{{ $permintaan->data_pasien ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Permintaan</td>
            <td colspan="3">{{ $permintaan->jenisPermintaan->name }}</td>
        </tr>
        <!-- Uraian -->
        <tr>
            <td colspan="4" class="section-header">Uraian Alasan Perubahan :</td>
        </tr>
        <tr>
            <td colspan="4" style="height: 150px;">{{ $permintaan->uraian_alasan }}</td>
        </tr>
    </table>

    <!-- Tanda Tangan -->
    <!-- Tabel Tanda Tangan dengan Data Dinamis -->
    <table class="main-table" style="margin-top: -1px;">
        <tr>
            <td style="width: 33.33%; text-align: center; padding-top: 10px;">
                Pemohon
                <br><br><br><br>
                ( {{ $permintaan->nama_pemohon }} )
            </td>
            <td style="width: 33.33%; text-align: center; padding-top: 10px;">
                Menyetujui
                <br><br><br><br>
                (
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                )
                <br>
                Atasan Pemohon
            </td>
            <td style="width: 33.33%; text-align: center; padding-top: 10px;">
                Mengetahui
                <br><br><br><br>
                ( {{ $permintaan->teknisi ? $permintaan->teknisi->name : '...........................' }} )
                <br>
                IT / Rekam Medis
            </td>
        </tr>
    </table>

</body>

</html>

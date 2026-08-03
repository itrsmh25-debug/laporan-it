<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            /* Mengubah font ke Times New Roman */
            font-family: 'Times New Roman', Times, serif;
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
            text-align: center;
            /* Mengubah rata kiri menjadi rata tengah */
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
    </style>
</head>

<body>

    <table class="main-table">
        <tr>
            <td class="header-logo"><img src="{{ public_path('image/logo-rs.png') }}" width="60"></td>
            <td class="header-title" style="vertical-align: middle;">FORM PERMINTAAN HAK AKSES</td>
            <td class="header-date" style="vertical-align: middle;">
                Tanggal Pengajuan:<br>{{ $item->created_at->format('d-m-Y') }}
            </td>
        </tr>
    </table>

    <table class="main-table" style="margin-top: -1px;">
        <tr>
            <td colspan="4" class="section-header">Data Personal :</td>
        </tr>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td class="value">{{ $item->nama_lengkap }}</td>
            <td class="label">NIK Penduduk</td>
            <td class="value">{{ $item->nik_penduduk }}</td>
        </tr>
        <tr>
            <td class="label">Tempat/Tgl Lahir</td>
            <td class="value">{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir->format('d-m-Y') }}</td>
            <td class="label">Unit / Bagian</td>
            <td class="value">{{ $item->unit }}</td>
        </tr>
        <tr>
            <td class="label">Pendidikan</td>
            <td class="value">{{ $item->pendidikan }}</td>
            <td class="label">Lulusan</td>
            <td class="value">{{ $item->lulusan }}</td>
        </tr>
        <tr>
            <td class="label">Email</td>
            <td class="value">{{ $item->email }}</td>
            <td class="label">HP / WhatsApp</td>
            <td class="value">{{ $item->hp_whatsapp }}</td>
        </tr>
        <tr>
            <td colspan="4" class="section-header">Data Profesional :</td>
        </tr>
        <tr>
            <td class="label">No. STR</td>
            <td class="value">{{ $item->no_str }}</td>
            <td class="label">Tgl Terbit STR</td>
            <td class="value">{{ $item->tgl_terbit_str->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="label">No. SIP</td>
            <td class="value">{{ $item->no_sip ?? '-' }}</td>
            <td class="label">Tgl Terbit SIP</td>
            <td class="value">{{ $item->tgl_terbit_sip ? $item->tgl_terbit_sip->format('d-m-Y') : '-' }}</td>
        </tr>
        <tr>
            <td class="label">NIP</td>
            <td colspan="3">{{ $item->nip ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Alamat KTP</td>
            <td colspan="3">{{ $item->alamat_ktp }}</td>
        </tr>
    </table>

    <!-- Tabel Tanda Tangan (3 Kolom) -->
    <table class="main-table" style="margin-top: -1px;">
        <tr>
            <td style="width: 33.33%; text-align: center; padding-top: 10px;">
                Pemohon
                <br><br><br><br>
                ( {{ $item->nama_lengkap }} )
            </td>
            <td style="width: 33.33%; text-align: center; padding-top: 10px;">
                Menyetujui,
                <br>
                Atasan Pemohon
                <br><br><br>
                ( ........................... )
            </td>
            <td style="width: 33.33%; text-align: center; padding-top: 10px;">
                Mengetahui,
                <br>
                IT / HRD
                <br><br><br>
                ( ........................... )
            </td>
        </tr>
    </table>

</body>

</html>

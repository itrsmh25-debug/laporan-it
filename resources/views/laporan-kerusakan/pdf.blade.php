<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            /* Ubah bagian ini */
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        /* Layout Header */
        .kop-surat {
            text-align: center;
            margin-bottom: 30px;
        }

        .kop-surat img {
            width: 100%;
            max-width: 700px;
            height: auto;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 20px;
            text-decoration: underline;
        }

        /* Layout Tabel Utama */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td,
        th {
            padding: 12px;
            border: 1px solid #333;
            vertical-align: top;
        }

        th {
            background-color: #f8f8f8;
            width: 35%;
            font-weight: bold;
        }

        /* Foto */
        .foto-container {
            text-align: center;
            padding: 10px;
        }

        .foto-container img {
            max-width: 250px;
            border: 1px solid #ddd;
        }

        /* Tanda Tangan */
        .signature-table {
            margin-top: 40px;
            width: 100%;
        }

        .signature-table td {
            border: none;
            text-align: center;
        }

        .space {
            height: 80px;
        }
    </style>
</head>

<body>

    <div class="kop-surat">
        <!-- Sesuaikan path jika perlu -->
        <img src="{{ public_path('image/kop-surat.png') }}" alt="Kop Surat">
    </div>

    <div class="title">FORM REKOMENDASI PERBAIKAN/PENGADAAN ASET</div>

    <div style="margin-bottom: 15px; font-size: 12px; line-height: 1; border: 1px solid #ccc; padding: 10px;">
        <strong>Hasil Pemeriksaan Teknis:</strong>
        <br><br>

        @if ($laporan->rekomendasi == 'service')
            <span style="font-weight: bold; font-size: 14px;">&#9745;</span> <span style="font-weight: bold;">Tindakan
                Perbaikan (Service)</span>
            <br>
            <span style="color: #444; font-size: 14px;">&#9744;</span> <span style="color: #444;">Pengadaan Perangkat
                Baru</span>
        @else
            <span style="color: #444; font-size: 14px;">&#9744;</span> <span style="color: #444;">Tindakan Perbaikan
                (Service)</span>
            <br>
            <span style="font-weight: bold; font-size: 14px;">&#9745;</span> <span style="font-weight: bold;">Pengadaan
                Perangkat Baru</span>
        @endif

        <br>
        <p style="margin-top: 10px; font-style: italic; color: #555;">
            Status di atas ditetapkan berdasarkan hasil analisis teknis terhadap kondisi aset saat ini.
        </p>
    </div>
    <table>
        <tr>
            <th>Nama Aset / Perangkat</th>
            <td>{{ $laporan->asset->nama_perangkat }}</td>
        </tr>
        <tr>
            <th>Kode Inventaris</th>
            <td>{{ $laporan->asset->kode_aset }}</td>
        </tr>
        <tr>
            <th>Deskripsi Kerusakan</th>
            <td>{{ $laporan->deskripsi_kerusakan }}</td>
        </tr>
        <tr>
            <th>Rekomendasi Tindakan</th>
            <td>{{ strtoupper(str_replace('_', ' ', $laporan->rekomendasi)) }}</td>
        </tr>
        <tr>
            <th>Estimasi Biaya</th>
            <td>Rp {{ number_format($laporan->estimasi_biaya, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Bukti Foto</th>
            <td class="foto-container">
                @if ($laporan->foto_bukti)
                    <!-- Jika file disimpan di public/bukti_dukung/ -->
                    <img src="{{ public_path('bukti_dukung/' . $laporan->foto_bukti) }}" width="150">
                @else
                    <p>Tidak ada lampiran foto</p>
                @endif
            </td>
        </tr>
        <tr>
            <th>Alasan Rekomendasi</th>
            <td>{{ $laporan->alasan_rekomendasi }}</td>
        </tr>
    </table>

    <table class="signature-table">
        <tr>
            <td width="50%">Pelapor,</td>
            <td width="50%">Staff IT,</td>
        </tr>
        <tr>
            <td class="space"></td>
            <td class="space"></td>
        </tr>
        <tr>
            <td>( ___________________ )</td>
            <td>( ___________________ )</td>
        </tr>
    </table>

</body>

</html>

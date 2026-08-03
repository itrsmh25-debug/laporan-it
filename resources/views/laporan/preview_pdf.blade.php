<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Bulanan IT</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .page-content {
            padding: 40px 50px;
        }

        .page-break {
            page-break-after: always;
        }

        table.laporan-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12px;
        }

        table.laporan-table th,
        table.laporan-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        table.laporan-table thead {
            background-color: #f2f2f2;
        }

        .ttd-table {
            width: 100%;
            border: none;
            margin-top: 40px;
            text-align: center;
        }

        .ttd-table td {
            border: none;
            font-size: 12px;
        }

        h2 {
            border-bottom: 2px solid #1a365d;
            padding-bottom: 5px;
            color: #1a365d;
            text-transform: uppercase;
            font-size: 20px;
        }

        h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-top: 20px;
        }

        p {
            font-size: 14px;
            text-align: justify;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="page-content page-break">
        <h2>BAB I: PENDAHULUAN</h2>
        <h3>1.1 Latar Belakang</h3>
        <p>{!! nl2br(e($input['bab1_latar_belakang'] ?? '')) !!}</p>

        <h3>1.2 Tujuan Laporan</h3>
        <p>{!! nl2br(e($input['bab1_tujuan'] ?? '')) !!}</p>
    </div>

    <div class="page-content page-break">
        <h2>BAB II: REKAPITULASI KASUS HARIAN & KPI</h2>
        <p>{!! nl2br(e($input['bab2_narasi'] ?? '')) !!}</p>

        <table class="laporan-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Jumlah Aktifitas/Masalah Non ASHA</th>
                    <th>Jumlah Aktifitas/Masalah ASHA</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 30; $i++)
                    @php $tgl = sprintf('%02d', $i); @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $tgl }}
                            {{ \Carbon\Carbon::create()->month((int) ($input['bulan'] ?? date('m')))->format('F') }}
                            {{ $input['tahun'] ?? date('Y') }}</td>
                        <td>{{ $dataHarian->where('tanggal', 'like', "%-$tgl")->sum('jumlah_non_asha') ?? 0 }}</td>
                        <td>{{ $dataHarian->where('tanggal', 'like', "%-$tgl")->sum('jumlah_asha') ?? 0 }}</td>
                    </tr>
                @endfor
            </tbody>
            <tfoot style="font-weight: bold; background-color: #e9ecef;">
                <tr>
                    <td colspan="2">JUMLAH BULAN {{ $input['bulan'] ?? '' }}/{{ substr($input['tahun'] ?? '', -2) }}
                    </td>
                    <td>{{ $dataHarian->sum('jumlah_non_asha') ?? 0 }}</td>
                    <td>{{ $dataHarian->sum('jumlah_asha') ?? 0 }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="page-content page-break">
        <h2>BAB III: ANALISIS & KONDISI INVENTARIS ASET IT</h2>
        <p>{!! nl2br(e($input['bab3_aset_narasi'] ?? '')) !!}</p>
    </div>

    <div class="page-content page-break">
        <h2>BAB IV: RENCANA TINDAK LANJUT (RTL)</h2>
        <p>{!! nl2br(e($input['bab4_rtl'] ?? '')) !!}</p>
    </div>

    <div class="page-content">
        <h2>BAB V: PENUTUP</h2>
        <h3>5.1 Kesimpulan</h3>
        <p>{!! nl2br(e($input['bab5_kesimpulan'] ?? '')) !!}</p>

        <h3>5.2 Rekomendasi Manajemen</h3>
        <p>{!! nl2br(e($input['bab5_rekomendasi'] ?? '')) !!}</p>

        <div style="margin-top: 40px;">
            <p style="text-align: right;">Tangerang,
                {{ isset($input['tanggal_cetak']) ? \Carbon\Carbon::parse($input['tanggal_cetak'])->format('d F Y') : date('d F Y') }}
            </p>
            <table class="ttd-table">
                <tr>
                    <td>Koordinator</td>
                    <td>Anggota I</td>
                    <td>Anggota II</td>
                    <td>Anggota III</td>
                    <td>Anggota IV</td>
                </tr>
                <tr style="height: 80px;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="font-weight: bold;">
                    <td>{{ $input['nama_koordinator'] ?? 'M. Fikri Ramadhon' }}</td>
                    <td>M. Ryan Andika</td>
                    <td>Vino Abdullah</td>
                    <td>Eko Nugie</td>
                    <td>Yudha Wastu P</td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>

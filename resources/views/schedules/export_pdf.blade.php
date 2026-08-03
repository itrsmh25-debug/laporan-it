<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: landscape;
            margin: 5mm;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            color: #000;
        }

        .kop {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
            position: relative;
            /* Penting untuk posisi logo */
            min-height: 60px;
            /* Memberi ruang untuk logo */
        }

        .logo {
            position: absolute;
            left: 0;
            top: -5px;
            /* Nilai negatif untuk menaikkan logo lebih tinggi */
            width: 50px;
        }

        .kop-text {
            margin-left: 60px;
            /* Memberi jarak agar teks tidak tertutup logo */
            text-align: center;
        }

        .kop img {
            width: 50px;
            float: left;
            margin-left: 20px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 2px;
            font-size: 14px;
        }

        .periode {
            text-align: center;
            margin-bottom: 5px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 2px;
            text-align: center;
            height: 25px;
            vertical-align: middle;
        }

        /* Warna Latar Belakang (Wajib aktifkan 'Background Graphics' di menu cetak browser) */
        .bg-red {
            background-color: #ff0000 !important;
            -webkit-print-color-adjust: exact;
            color: #fff;
        }

        .bg-green {
            background-color: #008000 !important;
            -webkit-print-color-adjust: exact;
            color: #fff;
        }

        .bg-yellow {
            background-color: #ffff00 !important;
            -webkit-print-color-adjust: exact;
            color: #000;
        }

        .bg-purple {
            background-color: #800080 !important;
            -webkit-print-color-adjust: exact;
            color: #fff;
        }

        .footer-info {
            margin-top: 10px;
            font-size: 9px;
        }

        .legend-box {
            width: 15px;
            height: 10px;
            display: inline-block;
            border: 1px solid #000;
        }

        .sign {
            float: right;
            text-align: center;
            width: 200px;
            margin-top: 5px;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="kop">
        <img src="{{ asset('image/logo-rs.png') }}" class="logo" alt="Logo">
        <div class="kop-text">
            <h2 style="margin:0; font-size: 16px;">RS. MITRA HUSADA</h2>
            <p style="margin:0; font-size: 10px;">Jl. Kp. Melayu Barat No. 12, Kec. Teluknaga, Kab. Tangerang - Banten
                15510</p>
            <div class="title" style="text-decoration:none; margin-top:5px;">JADWAL DINAS PETUGAS IT RS MITRA HUSADA
                TANGERANG</div>
            <div class="periode">BULAN : {{ $period->first()->format('d F') }} s/d
                {{ $period->last()->format('d F Y') }}</div>
        </div>
    </div>

    {{-- <div class="title">JADWAL DINAS PETUGAS IT RS MITRA HUSADA TANGERANG</div>
    <div class="periode">BULAN : {{ $period->first()->format('d F') }} s/d {{ $period->last()->format('d F Y') }}</div> --}}

    <table>
        <thead>
            <tr>
                <th width="30" rowspan="2">NO</th>
                <th width="120" rowspan="2">NAMA</th>
                <th colspan="{{ count($period) }}">TGL :</th>
            </tr>
            <tr>
                @foreach ($period as $date)
                    <th width="25">{{ $date->format('d') }}</th>
                @endforeach
            </tr>
            <tr>
                <th colspan="2">HARI :</th>
                @foreach ($period as $date)
                    <th>{{ substr($date->format('D'), 0, 1) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($teknisiList as $index => $t)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: left; padding-left: 5px;">{{ $t->name }}</td>
                    @foreach ($period as $date)
                        @php
                            $key = $t->id . '_' . $date->format('Y-m-d');
                            $shift = $schedules[$key] ?? '';
                            $isSun = $date->format('D') == 'Sun';

                            // LOGIKA WARNA FINAL
                            $cls = '';
                            if ($shift == 'C') {
                                $cls = 'bg-green';
                            } elseif ($shift == 'OC') {
                                $cls = 'bg-yellow';
                            } elseif ($shift == 'MD') {
                                $cls = 'bg-purple';
                            } elseif ($isSun) {
                                $cls = 'bg-red';
                            } // Jika tidak ada shift khusus, Minggu jadi merah
                        @endphp
                        <td class="{{ $cls }}">{{ $shift }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bagian Footer yang diubah menjadi menurun -->
    <div class="footer-info" style="display: flex; flex-direction: column; margin-top: 10px;">

        <!-- Jam Kerja (Diambil dari MasterMapping) -->
        <div style="margin-bottom: 5px;">
            <strong>Jam Kerja:</strong>
            <ul style="list-style: none; padding-left: 0; margin: 0;">
                @foreach ($jamKerja as $jk)
                    <li>{{ $jk->name }} : {{ $jk->value }}</li> <!-- Asumsi kolomnya 'name' dan 'value' -->
                @endforeach
            </ul>
        </div>

        <!-- Keterangan (Menurun) -->
        <div>
            <strong>Keterangan:</strong>
            <div style="margin-top: 3px;">
                <div class="legend-box bg-green"></div> Cuti (Hijau)
            </div>
            <div style="margin-top: 3px;">
                <div class="legend-box bg-red"></div> Tgl Merah (Merah)
            </div>
            <div style="margin-top: 3px;">
                <div class="legend-box bg-yellow"></div> On Call (Kuning)
            </div>
            <div style="margin-top: 3px;">
                <div class="legend-box bg-purple"></div> MD (Ungu)
            </div>
        </div>
    </div>

    <div class="sign">
        TANGERANG, {{ date('d F Y') }}<br>Mengetahui,<br><br><br><br><br>(M Nur Faiq M)
    </div>

</body>

</html>

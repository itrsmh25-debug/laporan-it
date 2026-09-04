<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan IT Mitra Husada Tangerang - {{ $bulanName }} {{ $tahun }}</title>
    <style>
        @page {
            margin: 15mm;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 11px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* --- STYLING HALAMAN COVER (LOGO DIPERBESAR & TEKS DIBAWAHKAN) --- */
        .cover-page {
            position: relative;
            height: 98vh;
            text-align: center;
            box-sizing: border-box;
            page-break-after: always;
            font-family: 'Times New Roman', Times, serif;
        }

        .cover-border {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 1px solid #444;
            padding: 20px;
            box-sizing: border-box;
        }

        .cover-top {
            padding-top: 50px;
        }

        .cover-top h2 {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 6px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .cover-logo-container {
            padding: 50px 0;
        }

        .cover-logo {
            width: 230px;
            /* Logo diperbesar */
            height: auto;
        }

        .cover-address {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .cover-date {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.5;
            padding-bottom: 20px;
        }

        /* --- STYLING ISI LAPORAN --- */
        .header-table {
            width: 100%;
            border-bottom: 3px double #008744;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .title-container {
            text-align: center;
        }

        .title-container h3,
        .title-container h4 {
            margin: 0;
            color: #1b5e20;
            text-transform: uppercase;
        }

        .title-container p {
            margin: 3px 0 0;
            font-size: 10px;
            color: #555;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #008744;
            margin-top: 25px;
            margin-bottom: 8px;
            text-transform: uppercase;
            border-bottom: 1px solid #ddd;
            padding-bottom: 3px;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        table.data-table th,
        table.data-table td {
            border: 1px solid #b0bec5;
            padding: 5px 7px;
            text-align: left;
            vertical-align: top;
        }

        table.data-table th {
            background-color: #f1f8e9;
            color: #2e7d32;
            font-weight: bold;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .badge {
            padding: 2px 5px;
            font-size: 9px;
            border-radius: 3px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #e8fadf;
            color: #155724;
        }

        .badge-warning {
            background-color: #fff2e2;
            color: #856404;
        }

        .badge-danger {
            background-color: #ffe5e5;
            color: #ff3e1d;
        }

        .signature-container {
            width: 100%;
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .signature-table td {
            padding: 5px;
            vertical-align: top;
            font-size: 9px;
        }

        .space-sign {
            height: 35px;
        }
    </style>
</head>

<body>

    <!-- ========================================== -->
    <!-- HALAMAN COVER                               -->
    <!-- ========================================== -->
    <div class="cover-page">
        <div class="cover-border">
            <table style="width: 100%; height: 100%; border-collapse: collapse; text-align: center;">
                <!-- Baris Atas: Judul Laporan -->
                <tr>
                    <td style="vertical-align: top; height: 15%;">
                        <div class="cover-top">
                            <h2>LAPORAN IT</h2>
                            <h2>MITRA HUSADA TANGERANG</h2>
                        </div>
                    </td>
                </tr>

                <!-- Baris Tengah: Logo (Diperbesar) -->
                <tr>
                    <td style="vertical-align: middle; height: 45%;">
                        <div class="cover-logo-container">
                            <img src="{{ public_path('image/logo-rs.png') }}" class="cover-logo"
                                alt="Logo RS Mitra Husada">
                        </div>
                    </td>
                </tr>

                <!-- Baris Bawah: Alamat & Periode (Diturunkan) -->
                <tr>
                    <td style="vertical-align: bottom; height: 40%; padding-bottom: 20px;">
                        <div class="cover-address">
                            JL. RAYA KAMPUNG MELAYU BARAT NO.11A<br>
                            TELUKNAGA<br>
                            KABUPATEN TANGERANG<br>
                            BANTEN
                        </div>
                        <div class="cover-date">
                            {{ strtoupper($bulanName) }}<br>
                            {{ $tahun }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <!-- ========================================== -->
    <!-- ISI LAPORAN (MULAI HALAMAN 2)              -->
    <!-- ========================================== -->

    <!-- KOP / HEADER KONTEN -->
    <table class="header-table">
        <tr>
            <td width="15%" class="text-center">
                <img src="{{ public_path('image/logo-rs.png') }}" width="45" alt="Logo">
            </td>
            <td width="85%" class="title-container">
                <h3>LAPORAN KERJA UNIT IT</h3>
                <h4>RUMAH SAKIT MITRA HUSADA TANGERANG</h4>
                <p>JL. Raya Kampung Melayu Barat No. 11A, Teluknaga, Kabupaten Tangerang, Banten</p>
            </td>
        </tr>
    </table>

    <!-- METADATA LAPORAN -->
    <table style="width: 100%; margin-bottom: 15px; font-size: 11px;">
        <tr>
            <td width="20%"><strong>PERIODE LAPORAN</strong></td>
            <td width="2%">:</td>
            <td width="78%"><strong>{{ strtoupper($bulanName) }} {{ $tahun }}</strong></td>
        </tr>
        <tr>
            <td><strong>UNIT KERJA</strong></td>
            <td>:</td>
            <td>Instalasi Teknologi Informasi (IT Core)</td>
        </tr>
        <tr>
            <td><strong>KOORDINATOR</strong></td>
            <td>:</td>
            <td>Muhamad Fikri Ramadhon, S.Kom.</td>
        </tr>
    </table>

    <!-- BAB I: PENDAHULUAN -->
    <div class="section-title">I. PENDAHULUAN</div>
    <p style="text-align: justify; margin-top: 5px;">
        Selama melaksanakan tugas dan operasional yang berlangsung selama bulan <strong>{{ $bulanName }}
            {{ $tahun }}</strong> di Rumah Sakit Mitra Husada Tangerang, Tim Unit IT telah mengelola pemeliharaan
        perangkat, jaringan, penanganan troubleshooting, rekapitulasi kerusakan aset, penilaian KPI kinerja teknisi,
        serta peningkatan layanan infrastruktur rumah sakit.
    </p>

    <!-- BAB II: REKAPITULASI BERDASARKAN KATEGORI -->
    <div class="section-title">II. REKAPITULASI BERDASARKAN KATEGORI MASALAH</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="60%">Kategori / Faktor Masalah</th>
                <th width="30%">Jumlah Kasus (Volume)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoriRekap as $katName5 => $katCount)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $katName5 }}</td>
                    <td class="text-center">{{ $katCount }} Kasus</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data kategori.</td>
                </tr>
            @endforelse
            <tr style="background-color: #f9f9f9; font-weight: bold;">
                <td colspan="2" class="text-right">TOTAL KESELURUHAN KASUS :</td>
                <td class="text-center">{{ $totalKasus }} Kasus</td>
            </tr>
        </tbody>
    </table>

    <!-- BAB III: LAPORAN KERUSAKAN ASET & ESTIMASI BIAYA -->
    <div class="section-title">III. REKAPITULASI LAPORAN KERUSAKAN ASET & ESTIMASI BIAYA</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="8%">No</th>
                <th width="37%">Nama Aset / Perangkat</th>
                <th width="25%">Rekomendasi Tindakan</th>
                <th width="30%">Estimasi Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporanKerusakan as $indexKerusakan => $kerusakan)
                <tr>
                    <td class="text-center">{{ $indexKerusakan + 1 }}</td>
                    <td><strong>{{ $kerusakan->asset->nama_perangkat ?? 'Aset Tidak Ditemukan' }}</strong></td>
                    <td class="text-center">
                        <span
                            class="badge {{ $kerusakan->rekomendasi == 'beli_baru' ? 'badge-danger' : 'badge-warning' }}">
                            {{ strtoupper(str_replace('_', ' ', $kerusakan->rekomendasi)) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($kerusakan->estimasi_biaya, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center" style="padding: 10px; color: #777;">Tidak ada catatan
                        kerusakan aset pada periode ini.</td>
                </tr>
            @endforelse
            <tr style="background-color: #f9f9f9; font-weight: bold;">
                <td colspan="3" class="text-right">TOTAL ESTIMASI BIAYA KERUSAKAN :</td>
                <td>Rp {{ number_format($totalBiayaKerusakan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- BAB IV: REKAPITULASI KPI KINERJA TEKNISI IT -->
    <div class="section-title">IV. REKAPITULASI KPI KINERJA TEKNISI IT</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="10%" class="text-center">Rank</th>
                <th width="50%">Nama Teknisi IT</th>
                <th width="20%" class="text-center">Total Poin KPI</th>
                <th width="20%" class="text-center">Beban Kerja (%)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kpiTeknisi as $indexKpi => $kpi)
                @php
                    $safeTotal = ($totalSeluruhCase ?? 0) > 0 ? $totalSeluruhCase : 1;
                    $persentaseKpi = round(($kpi->skor / $safeTotal) * 100);
                @endphp
                <tr>
                    <td class="text-center font-weight-bold">{{ $indexKpi + 1 }}</td>
                    <td><strong>{{ $kpi->teknisi->name ?? 'Teknisi Tidak Ditemukan' }}</strong></td>
                    <td class="text-center">{{ number_format($kpi->skor, 1) }} Poin</td>
                    <td class="text-center">{{ $persentaseKpi }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center" style="padding: 10px; color: #777;">Tidak ada data KPI
                        teknisi pada periode ini.</td>
                </tr>
            @endforelse
            <tr style="background-color: #f9f9f9; font-weight: bold;">
                <td colspan="2" class="text-right">TOTAL POIN KESELURUHAN :</td>
                <td colspan="2" class="text-center">{{ number_format($totalSeluruhCase, 1) }} Poin</td>
            </tr>
        </tbody>
    </table>

    <!-- BAB V: REKAPITULASI LAPORAN DOWNTIME SISTEM / LAYANAN IT -->
    <div class="section-title">V. REKAPITULASI LAPORAN DOWNTIME SISTEM / LAYANAN IT</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">No. Tiket</th>
                <th width="20%">Sistem / Layanan</th>
                <th width="20%">Waktu Gangguan</th>
                <th width="25%">Penyebab & Perbaikan</th>
                <th width="15%">Status / Durasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporanDowntimes ?? [] as $indexDowntime => $downtime)
                <tr>
                    <td class="text-center">{{ $indexDowntime + 1 }}</td>
                    <td><strong>{{ $downtime->nomor_tiket }}</strong></td>
                    <td>
                        <strong>{{ $downtime->sistemLayanan->name ?? '-' }}</strong><br>
                        <small style="color: #666;">Pelapor: {{ $downtime->pelapor ?? '-' }}</small>
                    </td>
                    <td>
                        <small>Mulai:
                            {{ \Carbon\Carbon::parse($downtime->waktu_mulai)->format('d/m/Y H:i') }}</small><br>
                        <small>Selesai:
                            {{ $downtime->waktu_selesai ? \Carbon\Carbon::parse($downtime->waktu_selesai)->format('d/m/Y H:i') : 'Berlangsung' }}</small>
                    </td>
                    <td>
                        <strong>Penyebab:</strong> {{ $downtime->penyebab }}<br>
                        <span style="color: #2e7d32;"><strong>Solusi:</strong>
                            {{ $downtime->tindakan_perbaikan }}</span>
                    </td>
                    <td class="text-center">
                        @php
                            $statusDowntimeName = $downtime->statusDowntime->name ?? 'Open';
                        @endphp
                        @if (in_array(strtolower($statusDowntimeName), ['selesai', 'resolved', 'closed']))
                            <span class="badge badge-success">{{ $statusDowntimeName }}</span>
                        @else
                            <span class="badge badge-warning">{{ $statusDowntimeName }}</span>
                        @endif
                        @if ($downtime->durasi_menit)
                            <br><small style="color: #555;">({{ $downtime->durasi_menit }} Menit)</small>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 15px; color: #777;">Tidak ada catatan
                        downtime sistem pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- BAB VI: RENCANA TINDAK LANJUT (RTL) -->
    <div class="section-title">VI. RENCANA TINDAK LANJUT (RTL) & EVALUASI</div>
    <p
        style="text-align: justify; margin-top: 5px; background-color: #f4f6f8; padding: 10px; border-left: 3px solid #008744;">
        {{ $rencanaTindakLanjut }}
    </p>

    <!-- BAB VII: DETAIL LOG AKTIVITAS HARIAN -->
    <div class="section-title">VII. DETAIL TINDAK LANJUT KEGIATAN HARIAN</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Tanggal</th>
                <th width="15%">Unit / Ruangan</th>
                <th width="18%">Pelapor / Teknisi</th>
                <th width="35%">Uraian Masalah & Tindak Lanjut</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($allLaporan as $index => $lap)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($lap->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $lap->unit->name ?? '-' }}</td>
                    <td>
                        Pelapor: {{ $lap->nama_pelapor ?? '-' }}<br>
                        <small style="color: #666;">Teknisi: {{ $lap->teknisi->name ?? '-' }}</small>
                    </td>
                    <td>
                        <strong>Masalah:</strong> {{ $lap->masalah }}<br>
                        @if ($lap->tindak_lanjut && $lap->tindak_lanjut !== '-')
                            <span style="color: #2e7d32;"><strong>Solusi:</strong> {{ $lap->tindak_lanjut }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @php
                            $statusName = $lap->statusTiket->name ?? 'Proses';
                        @endphp
                        @if (in_array(strtolower($statusName), ['selesai', 'solve', 'solved']))
                            <span class="badge badge-success">{{ $statusName }}</span>
                        @else
                            <span class="badge badge-warning">{{ $statusName }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 15px; color: #777;">Tidak ada data laporan
                        tercatat pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- BAB VIII: PENUTUP & TANDA TANGAN -->
    <div class="section-title">VIII. PENUTUP</div>
    <p>Demikian laporan kerja unit IT ini disusun untuk dapat dipergunakan dan dijadikan bahan evaluasi manajemen
        sebagaimana mestinya.</p>

    <p style="text-align: right; margin-top: 10px;">Tangerang,
        {{ \Carbon\Carbon::create($tahun, $bulan)->endOfMonth()->translatedFormat('d F Y') }}</p>

    <!-- Tanda Tangan Anggota & Koordinator Tim IT dengan Mapping Gambar TTD -->
    <div class="signature-container">
        <table class="signature-table" style="width: 100%;">
            <tr>
                <td width="20%">
                    <br><strong>Anggota I</strong>
                    <div style="height: 40px; margin: 3px 0;">
                        <img src="{{ public_path('image/ttd/vino.jpg') }}" width="65"
                            style="height: 35px; object-fit: contain;" alt="TTD">
                    </div>
                    <strong>( Vino Abdullah, S.Kom. )</strong>
                </td>
                <td width="20%">
                    <br><strong>Anggota II</strong>
                    <div style="height: 40px; margin: 3px 0;">
                        <img src="{{ public_path('image/ttd/eko.jpg') }}" width="65"
                            style="height: 35px; object-fit: contain;" alt="TTD">
                    </div>
                    <strong>( Eko Nugie Nugroho, S.Kom. )</strong>
                </td>
                <td width="20%">
                    <br><strong>Anggota III</strong>
                    <div style="height: 40px; margin: 3px 0;">
                        <img src="{{ public_path('image/ttd/ryan.jpg') }}" width="65"
                            style="height: 35px; object-fit: contain;" alt="TTD">
                    </div>
                    <strong>( M. Ryan Andika, S.Kom. )</strong>
                </td>
                <td width="20%">
                    <br><strong>Anggota IV</strong>
                    <div style="height: 40px; margin: 3px 0;">
                        <img src="{{ public_path('image/ttd/yudha.png') }}" width="65"
                            style="height: 35px; object-fit: contain;" alt="TTD">
                    </div>
                    <strong>( Yudha Wastu Pratama, S.Kom. )</strong>
                </td>
                <td width="20%">
                    Mengetahui,<br><strong>Koordinator Unit IT</strong>
                    <div style="height: 40px; margin: 3px 0;">
                        <img src="{{ public_path('image/ttd/fikri.jpg') }}" width="65"
                            style="height: 35px; object-fit: contain;" alt="TTD">
                    </div>
                    <strong>( Muhamad Fikri Ramadhon, S.Kom. )</strong>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>

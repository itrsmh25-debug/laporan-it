<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\LaporanHarian;
use App\Models\LaporanKerusakan;
use App\Models\MasterMapping;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanHarianController extends Controller
{
    public function index()
    {
        // Mengambil data dengan Eager Loading, diurutkan dari yang terbaru, dan dipaginasi 10 data per halaman
        $laporans = LaporanHarian::with(['unit', 'teknisi', 'statusTiket', 'faktorMasalah'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('laporan.index', compact('laporans'));
    }

    public function create()
    {
        $mappings = MasterMapping::all()->groupBy('type');

        $types = ['unit', 'shift', 'teknisi', 'status_tiket', 'faktor_masalah'];
        $data = [];
        foreach ($types as $type) {
            $data[$type] = $mappings->get($type, collect());
        }

        return view('laporan.create', compact('data'));
    }

    public function store(Request $request)
    {
        // 1. Validasi dulu (ini benar)
        $request->validate([
            'tanggal'             => 'required|date',
            'shift_id'            => 'required|exists:master_mappings,id',
            'unit_id'             => 'required|exists:master_mappings,id',
            'teknisi_id'          => 'required|exists:master_mappings,id',
            'teknisi_penerima_id' => 'nullable|exists:master_mappings,id', // Validasi
            'status_tiket_id'     => 'required|exists:master_mappings,id',
            'faktor_masalah_id'   => 'required|exists:master_mappings,id',
            'nama_pelapor'        => 'required|string|max:255',
            'masalah'             => 'required|string',
            'tindak_lanjut'       => 'nullable|string',
        ]);

        // 2. Simpan data (JANGAN MASUKKAN STRING VALIDASI KE SINI)
        LaporanHarian::create([
            'tanggal'             => $request->tanggal,
            'nama_pelapor'        => $request->nama_pelapor,
            'masalah'             => $request->masalah,
            'tindak_lanjut'       => $request->tindak_lanjut ?? '-',
            'shift_id'            => $request->shift_id,
            'unit_id'             => $request->unit_id,
            'teknisi_id'          => $request->teknisi_id,

            // PENTING: Gunakan $request->teknisi_penerima_id (nilainya), 
            // bukan rule validasi 'nullable|exists:...'
            'teknisi_penerima_id' => $request->teknisi_penerima_id,

            'status_tiket_id'     => $request->status_tiket_id,
            'faktor_masalah_id'   => $request->faktor_masalah_id,
        ]);

        return redirect('/laporan')->with('success', 'Kegiatan harian IT berhasil disimpan!');
    }

    // 4. MENAMPILKAN HALAMAN EDIT
    public function edit($id)
    {
        $laporan = LaporanHarian::findOrFail($id);
        $mappings = MasterMapping::all()->groupBy('type');

        $types = ['unit', 'shift', 'teknisi', 'status_tiket', 'faktor_masalah'];
        $data = [];
        foreach ($types as $type) {
            $data[$type] = $mappings->get($type, collect());
        }

        return view('laporan.edit', compact('laporan', 'data'));
    }

    // 5. MEMPROSES UPDATE DATA LAPORAN
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'           => 'required|date',
            'shift_id'          => 'required|exists:master_mappings,id',
            'unit_id'           => 'required|exists:master_mappings,id',
            'teknisi_id'        => 'required|exists:master_mappings,id',
            'masalah'           => 'required|string',
            'status_tiket_id'   => 'required|exists:master_mappings,id',
            'faktor_masalah_id' => 'required|exists:master_mappings,id',
            'nama_pelapor'      => 'required|string|max:255',
            'tindak_lanjut'     => 'nullable|string',
        ]);

        $laporan = LaporanHarian::findOrFail($id);

        $updateData = [
            'tanggal'           => $request->tanggal,
            'shift_id'          => $request->shift_id,
            'unit_id'           => $request->unit_id,
            'teknisi_id'        => $request->teknisi_id,
            'status_tiket_id'   => $request->status_tiket_id,
            'faktor_masalah_id' => $request->faktor_masalah_id,
            'masalah'           => $request->masalah,
            'nama_pelapor'      => $request->nama_pelapor,
            'tindak_lanjut'     => $request->tindak_lanjut ?? '-',

            // HANYA update teknisi_penerima_id jika ada inputan dari form
            // Jika form kosong (karena disembunyikan JS), maka nilai lama akan tetap dipertahankan
            'teknisi_penerima_id' => $request->filled('teknisi_penerima_id') ? $request->teknisi_penerima_id : $laporan->teknisi_penerima_id,
        ];

        $laporan->update($updateData);

        return redirect('/laporan')->with('success', 'Catatan log berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $laporan = LaporanHarian::findOrFail($id);
        $laporan->delete();

        return redirect()->back()->with('success', 'Catatan log laporan berhasil dihapus!');
    }

    // MENAMPILKAN HALAMAN OPERAN SHIFT (TIKET YANG BELUM SELESAI)
    public function handover()
    {
        // Ambil semua laporan yang status tiketnya BUKAN 'Selesai' atau 'Solve'
        $tiketMengantung = LaporanHarian::with(['shift', 'unit', 'teknisi', 'statusTiket', 'faktorMasalah'])
            ->whereHas('statusTiket', function ($query) {
                $query->where('name', '!=', 'Selesai')
                    ->where('name', '!=', 'Solve');
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('laporan.handover', compact('tiketMengantung'));
    }

    public function kpi(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $laporans = LaporanHarian::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $kpiMap = [];

        // Logika perhitungan poin KPI
        foreach ($laporans as $item) {
            if ($item->teknisi_id) {
                if ($item->teknisi_penerima_id) {
                    // Jika di-oper, masing-masing dapat 0.5 poin
                    $kpiMap[$item->teknisi_id] = ($kpiMap[$item->teknisi_id] ?? 0) + 0.5;
                    $kpiMap[$item->teknisi_penerima_id] = ($kpiMap[$item->teknisi_penerima_id] ?? 0) + 0.5;
                } else {
                    // Jika selesai mandiri, dapat 1 poin
                    $kpiMap[$item->teknisi_id] = ($kpiMap[$item->teknisi_id] ?? 0) + 1;
                }
            }
        }

        // Ambil data nama teknisi dari MasterMapping
        $teknisiIds = array_keys($kpiMap);
        $teknisiData = MasterMapping::whereIn('id', $teknisiIds)->get()->keyBy('id');

        $kpiTeknisi = collect();
        foreach ($kpiMap as $id => $total) {
            $kpiTeknisi->push((object) [
                'teknisi' => $teknisiData->get($id),
                'skor'    => $total
            ]);
        }

        /** 
         * PERBAIKAN PENGURUTAN:
         * 1. sortByDesc('skor') mengurutkan dari tertinggi ke terendah.
         * 2. values() memastikan index array kembali urut dari 0, 1, 2...
         *    Ini krusial agar $index + 1 di Blade menghasilkan Rank yang benar.
         */
        $kpiTeknisi = $kpiTeknisi->sortByDesc('skor')->values();

        $totalSeluruhCase = $kpiTeknisi->sum('skor');

        return view('laporan.kpi', compact('kpiTeknisi', 'bulan', 'tahun', 'totalSeluruhCase'));
    }

    public function export(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        return Excel::download(new LaporanExport($bulan, $tahun), 'Laporan_Harian_IT_' . $bulan . '_' . $tahun . '.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $allLaporan = LaporanHarian::with(['unit', 'teknisi', 'statusTiket', 'faktorMasalah', 'shift'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $laporanKerusakan = LaporanKerusakan::with(['asset'])
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        // AMBIL DATA REKAP KPI KINERJA TEKNISI PADA PERIODE INI
        // (Sesuaikan query ini dengan logic yang Anda gunakan di controller KPI Anda)
        $kpiTeknisi = LaporanHarian::with('teknisi')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->select('teknisi_id', \Illuminate\Support\Facades\DB::raw('count(*) as total_case, sum(case when tindak_lanjut != "-" and tindak_lanjut is not null then 1.0 else 0.5 end) as skor'))
            ->groupBy('teknisi_id')
            ->orderBy('skor', 'desc')
            ->get();

        $totalSeluruhCase = $kpiTeknisi->sum('skor');

        $bulanName = date('F', mktime(0, 0, 0, $bulan, 1));
        $daysInMonth = Carbon::create($tahun, $bulan)->daysInMonth;

        // Rekapitulasi per kategori / faktor masalah
        $kategoriRekap = $allLaporan->groupBy(function ($item) {
            return $item->faktorMasalah->name ?? 'Lain-lain';
        })->map->count();

        // Statistik & Analisis Kinerja
        $totalKasus = $allLaporan->count();
        $totalKerusakan = $laporanKerusakan->count();
        $totalBiayaKerusakan = $laporanKerusakan->sum('estimasi_biaya');

        $topKategoriCount = $kategoriRekap->max() ?? 0;
        $topKategoriName = $kategoriRekap->search($topKategoriCount) ?? 'Tidak Ada';

        $rencanaTindakLanjut = "Berdasarkan dominasi gangguan pada kategori [{$topKategoriName}] dengan total {$topKategoriCount} kejadian, serta adanya {$totalKerusakan} laporan kerusakan aset dengan estimasi total biaya perbaikan/penggantian sebesar Rp " . number_format($totalBiayaKerusakan, 0, ',', '.') . ", maka rencana tindak lanjut prioritas unit IT adalah melakukan audit hardware berkala, pemeliharaan preventif, serta pengajuan anggaran peremajaan perangkat.";

        $pdf = Pdf::loadView('laporan.pdf_bulanan', compact(
            'allLaporan',
            'laporanKerusakan',
            'kpiTeknisi',
            'totalSeluruhCase',
            'kategoriRekap',
            'bulan',
            'bulanName',
            'tahun',
            'totalKasus',
            'totalKerusakan',
            'totalBiayaKerusakan',
            'topKategoriName',
            'topKategoriCount',
            'rencanaTindakLanjut'
        ));

        return $pdf->download('Laporan_IT_' . $bulanName . '_' . $tahun . '.pdf');
    }
}

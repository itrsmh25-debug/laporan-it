<?php

namespace App\Http\Controllers;

use App\Models\LaporanDowntime;
use App\Models\MasterMapping;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanDowntimeController extends Controller
{
    public function index(Request $request)
    {
        $query = LaporanDowntime::with(['sistemLayanan', 'teknisi', 'statusDowntime'])->latest();

        // Filter berdasarkan bulan & tahun jika ada
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('waktu_mulai', $request->bulan)
                ->whereYear('waktu_mulai', $request->tahun);
        }

        $downtimes = $query->paginate(10);
        return view('laporan-downtime.index', compact('downtimes'));
    }

    public function create()
    {
        $sistemLayanans = MasterMapping::where('type', 'sistem_layanan')->get();
        $teknisis = MasterMapping::where('type', 'teknisi')->get();
        $statuses = MasterMapping::where('type', 'status_tiket')->get();

        $dateCode = date('Ymd');
        $last = LaporanDowntime::whereDate('created_at', today())->latest()->first();
        $counter = $last ? ((int) substr($last->nomor_tiket, -3)) + 1 : 1;
        $nomorTiket = 'DWT-' . $dateCode . '-' . str_pad($counter, 3, '0', STR_PAD_LEFT);

        return view('laporan-downtime.create', compact('sistemLayanans', 'teknisis', 'statuses', 'nomorTiket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sistem_layanan_id' => 'required|exists:master_mappings,id',
            'teknisi_id' => 'required|exists:master_mappings,id',
            'status_id' => 'required|exists:master_mappings,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'nullable|date|after_or_equal:waktu_mulai',
            'penyebab' => 'required|string',
            'tindakan_perbaikan' => 'required|string',
            'nama_pelapor' => 'required|string|max:255',
        ]);

        $data = $request->all();

        // Generate nomor tiket
        $dateCode = date('Ymd');
        $last = LaporanDowntime::whereDate('created_at', today())->latest()->first();
        $counter = $last ? ((int) substr($last->nomor_tiket, -3)) + 1 : 1;
        $data['nomor_tiket'] = 'DWT-' . $dateCode . '-' . str_pad($counter, 3, '0', STR_PAD_LEFT);

        // Hitung durasi dalam menit otomatis jika waktu selesai terisi
        if (!empty($request->waktu_mulai) && !empty($request->waktu_selesai)) {
            $data['durasi_menit'] = Carbon::parse($request->waktu_mulai)->diffInMinutes(Carbon::parse($request->waktu_selesai));
        } else {
            $data['durasi_menit'] = null;
        }
        $data['pelapor'] = $request->nama_pelapor; // Petakan nama_pelapor dari form ke kolom pelapor di database
        LaporanDowntime::create($data);

        return redirect()->route('laporan-downtime.index')->with('success', 'Laporan downtime berhasil ditambahkan!');
    }

    public function edit(LaporanDowntime $laporanDowntime)
    {
        $sistemLayanans = MasterMapping::where('type', 'sistem_layanan')->get();
        $teknisis = MasterMapping::where('type', 'teknisi')->get();
        $statuses = MasterMapping::where('type', 'status_tiket')->get();

        return view('laporan-downtime.edit', compact('laporanDowntime', 'sistemLayanans', 'teknisis', 'statuses'));
    }

    public function update(Request $request, LaporanDowntime $laporanDowntime)
    {
        $request->validate([
            'sistem_layanan_id' => 'required|exists:master_mappings,id',
            'teknisi_id' => 'required|exists:master_mappings,id',
            'status_id' => 'required|exists:master_mappings,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'nullable|date|after_or_equal:waktu_mulai',
            'penyebab' => 'required|string',
            'tindakan_perbaikan' => 'required|string',
            'nama_pelapor' => 'required|string|max:255',
        ]);

        $data = $request->all();

        if (!empty($request->waktu_mulai) && !empty($request->waktu_selesai)) {
            $data['durasi_menit'] = Carbon::parse($request->waktu_mulai)->diffInMinutes(Carbon::parse($request->waktu_selesai));
        } else {
            $data['durasi_menit'] = null;
        }

        $laporanDowntime->update($data);

        return redirect()->route('laporan-downtime.index')->with('success', 'Laporan downtime berhasil diperbarui!');
    }

    public function destroy(LaporanDowntime $laporanDowntime)
    {
        $laporanDowntime->delete();
        return redirect()->route('laporan-downtime.index')->with('success', 'Laporan downtime berhasil dihapus!');
    }
}

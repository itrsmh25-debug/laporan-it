<?php

namespace App\Http\Controllers;

use App\Models\LaporanKerusakan;
use App\Models\Asset; // Asumsi model aset ada di sini
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class LaporanKerusakanController extends Controller
{
    public function index()
    {
        $laporans = LaporanKerusakan::with('asset')->latest()->get();
        return view('laporan-kerusakan.index', compact('laporans'));
    }

    public function create()
    {
        $assets = Asset::all();
        return view('laporan-kerusakan.create', compact('assets'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'asset_id' => 'required',
            'deskripsi_kerusakan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'rekomendasi' => 'required',
            'alasan_rekomendasi' => 'required',
            'estimasi_biaya' => 'required|numeric',
        ]);

        $dataToSave = $request->except('foto');

        // 2. Simpan file ke public/bukti_dukung
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Memindahkan file ke folder public/bukti_dukung
            $file->move(public_path('bukti_dukung'), $filename);

            // Simpan hanya nama filenya saja ke database
            $dataToSave['foto_bukti'] = $filename;
        }

        // 3. Simpan ke database
        LaporanKerusakan::create($dataToSave);

        return redirect()->route('laporan-kerusakan.index')->with('success', 'Laporan berhasil dibuat!');
    }

    public function edit($id)
    {
        $laporan = LaporanKerusakan::findOrFail($id);
        $assets = Asset::all();
        return view('laporan-kerusakan.edit', compact('laporan', 'assets'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanKerusakan::findOrFail($id);

        $request->validate([
            'asset_id' => 'required',
            'deskripsi_kerusakan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'rekomendasi' => 'required',
            'alasan_rekomendasi' => 'required',
            'estimasi_biaya' => 'required|numeric',
        ]);

        $dataToUpdate = $request->except('foto');

        // Cek jika ada upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($laporan->foto_bukti && File::exists(public_path('bukti_dukung/' . $laporan->foto_bukti))) {
                File::delete(public_path('bukti_dukung/' . $laporan->foto_bukti));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bukti_dukung'), $filename);
            $dataToUpdate['foto_bukti'] = $filename;
        }

        $laporan->update($dataToUpdate);

        return redirect()->route('laporan-kerusakan.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $laporan = LaporanKerusakan::findOrFail($id);

        // Hapus file fisik
        if ($laporan->foto_bukti && File::exists(public_path('bukti_dukung/' . $laporan->foto_bukti))) {
            File::delete(public_path('bukti_dukung/' . $laporan->foto_bukti));
        }

        $laporan->delete();

        return redirect()->route('laporan-kerusakan.index')->with('success', 'Laporan berhasil dihapus!');
    }

    public function cetakPdf($id)
    {
        $laporan = LaporanKerusakan::with('asset')->findOrFail($id);

        // Menggunakan Pdf::loadView
        $pdf = Pdf::loadView('laporan-kerusakan.pdf', compact('laporan'));

        // Opsi: set ukuran kertas dan orientasi
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Pengajuan_Aset_' . $laporan->id . '.pdf');
    }
}

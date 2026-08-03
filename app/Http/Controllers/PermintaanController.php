<?php

namespace App\Http\Controllers;

use App\Models\FormPermintaanPerubahan;
use App\Models\LaporanHarian;
use App\Models\MasterMapping;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{

    public function index()
    {
        // Hapus 'shift' jika relasinya belum dibuat di Model FormPermintaanPerubahan
        $permintaans = FormPermintaanPerubahan::with(['unit'])
            ->whereIn('status', ['pending', 'approved'])
            ->latest()
            ->paginate(10);

        $teknisis = MasterMapping::where('type', 'teknisi')->get();
        $units = MasterMapping::where('type', 'unit')->get();

        return view('permintaan.index', compact('permintaans', 'teknisis', 'units'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate(['teknisi_id' => 'required|exists:master_mappings,id']);

        $permintaan = FormPermintaanPerubahan::findOrFail($id);

        // Update status permintaan
        $permintaan->update([
            'status' => 'approved',
            'teknisi_id' => $request->teknisi_id
        ]);

        // Cari ID untuk status "Solve" secara otomatis di master_mappings
        $statusSolve = \App\Models\MasterMapping::where('type', 'status_tiket')
            ->where('name', 'Solve') // Pastikan nama di DB persis "Solve"
            ->first();

        // Pastikan status ketemu, jika tidak gunakan ID default yang aman
        $statusId = $statusSolve ? $statusSolve->id : 2;

        // Insert ke LaporanHarian
        \App\Models\LaporanHarian::create([
            'tanggal'           => date('Y-m-d'),
            'shift_id'          => $permintaan->shift_id, // MENGAMBIL DARI DATA PERMINTAAN
            'unit_id'           => $permintaan->unit_id,
            'teknisi_id'        => $request->teknisi_id,
            'status_tiket_id'   => $statusId,
            'faktor_masalah_id' => $permintaan->jenis_permintaan_id,
            'masalah'           => 'Permintaan: ' . $permintaan->uraian_alasan,
            'nama_pelapor'      => $permintaan->nama_pemohon,
            'tindak_lanjut'     => '-'
        ]);

        return back()->with('success', 'Permintaan telah di-approve dan status diset ke Solve!');
    }

    public function cetakPdf($id)
    {
        $permintaan = FormPermintaanPerubahan::with('jenisPermintaan')->findOrFail($id);

        // Menggunakan ukuran kertas A4
        $pdf = Pdf::loadView('permintaan.pdf', compact('permintaan'))->setPaper('a4', 'portrait');

        return $pdf->stream('Form_Permintaan_' . $permintaan->nama_pemohon . '.pdf');
    }

    public function create()
    {
        // Mengambil data jenis permintaan
        $jenisPermintaan = MasterMapping::where('type', 'jenis_permintaan')->get();

        // PERBAIKAN: Ambil juga data unit untuk dropdown
        $units = MasterMapping::where('type', 'unit')->get();
        $shifts = MasterMapping::where('type', 'shift')->get();

        // Kirim keduanya ke view
        return view('permintaan.create', compact('jenisPermintaan', 'units', 'shifts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon'        => 'required|string|max:255',
            'bagian_unit'         => 'nullable|string|max:255',
            'unit_id'             => 'required|exists:master_mappings,id', // PERBAIKAN: validasi unit_id
            'shift_id' => 'required|exists:master_mappings,id',
            'nip'                 => 'nullable|string|max:50',
            'nomor_ext'           => 'nullable|string|max:20',
            'data_pasien'         => 'nullable|string|max:255',
            'jenis_permintaan_id' => 'required|exists:master_mappings,id',
            'uraian_alasan'       => 'required|string',
            'bukti_dukung'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('bukti_dukung');

        if ($request->hasFile('bukti_dukung')) {
            $file = $request->file('bukti_dukung');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bukti_dukung'), $filename);
            $data['bukti_dukung'] = 'bukti_dukung/' . $filename;
        }

        FormPermintaanPerubahan::create($data);

        return back()->with('success', 'Form permintaan perubahan berhasil dikirim!');
    }

    public function destroy($id)
    {
        $permintaan = FormPermintaanPerubahan::findOrFail($id);

        // Hapus file bukti dukung jika ada di folder public
        if ($permintaan->bukti_dukung && file_exists(public_path($permintaan->bukti_dukung))) {
            unlink(public_path($permintaan->bukti_dukung));
        }

        // Hapus data dari database
        $permintaan->delete();

        return back()->with('success', 'Data permintaan perubahan berhasil dihapus!');
    }
}

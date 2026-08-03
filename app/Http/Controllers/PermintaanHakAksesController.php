<?php

namespace App\Http\Controllers;

use App\Models\PermintaanHakAkses;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PermintaanHakAksesController extends Controller
{
    public function index()
    {
        $data = PermintaanHakAkses::latest()->get();
        return view('hak_akses.index', compact('data'));
    }

    public function create()
    {
        return view('hak_akses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'nik_penduduk'   => 'required|string|max:20',
            'tempat_lahir'   => 'required|string',
            'tanggal_lahir'  => 'required|date',
            'unit'           => 'required|string',
            'lulusan'        => 'required|string',
            'no_str'         => 'required|string',
            'tgl_terbit_str' => 'required|date',
            'no_sip'         => 'nullable|string',
            'tgl_terbit_sip' => 'nullable|date',
            'nip'            => 'nullable|string',
            'hp_whatsapp'    => 'required|string',
            'alamat_ktp'     => 'required|string',
            'pendidikan'     => 'required|string',
            'email'          => 'required|email',
        ]);

        PermintaanHakAkses::create($validated);
        return redirect()->route('hak-akses.index')->with('success', 'Data berhasil dikirim.');
    }

    public function edit($id)
    {
        $item = PermintaanHakAkses::findOrFail($id);
        return view('hak_akses.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = PermintaanHakAkses::findOrFail($id);
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'nik_penduduk'   => 'required|string|max:20',
            'tempat_lahir'   => 'required|string',
            'tanggal_lahir'  => 'required|date',
            'unit'           => 'required|string',
            'lulusan'        => 'required|string',
            'no_str'         => 'required|string',
            'tgl_terbit_str' => 'required|date',
            'no_sip'         => 'nullable|string',
            'tgl_terbit_sip' => 'nullable|date',
            'nip'            => 'nullable|string',
            'hp_whatsapp'    => 'required|string',
            'alamat_ktp'     => 'required|string',
            'pendidikan'     => 'required|string',
            'email'          => 'required|email',
        ]);

        $item->update($validated);
        return redirect()->route('hak-akses.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        PermintaanHakAkses::findOrFail($id)->delete();
        return redirect()->route('hak-akses.index')->with('success', 'Data berhasil dihapus.');
    }

    public function show($id)
    {
        $item = PermintaanHakAkses::findOrFail($id);
        return view('hak_akses.show', compact('item'));
    }

    public function cetakPdf($id)
    {
        $item = PermintaanHakAkses::findOrFail($id);

        // Pastikan view 'hak_akses.pdf' sudah dibuat di folder resources/views/hak_akses/
        $pdf = Pdf::loadView('hak_akses.pdf', compact('item'))->setPaper('a4', 'portrait');

        return $pdf->stream('Permintaan_Hak_Akses_' . $item->nama_lengkap . '.pdf');
    }
}

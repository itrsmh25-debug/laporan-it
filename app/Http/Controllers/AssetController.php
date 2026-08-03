<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\MasterMapping;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    // 1. Menampilkan daftar semua aset
    public function index()
    {
        // Eager loading relasi agar query database cepat
        $assets = Asset::with(['jenisPerangkat', 'kondisi', 'unit'])->orderBy('id', 'desc')->get();
        return view('asset.index', compact('assets'));
    }

    // 2. Menampilkan halaman form tambah aset baru
    public function create()
    {
        $mappings = MasterMapping::all()->groupBy('type');

        // Mengambil kategori parameter yang dibutuhkan di dalam form asset
        // Pastikan nama type di database-mu: 'jenis_perangkat', 'kondisi', dan 'unit'
        $types = ['jenis_perangkat', 'kondisi', 'unit'];
        $data = [];
        foreach ($types as $type) {
            $data[$type] = $mappings->get($type, collect());
        }

        return view('asset.create', compact('data'));
    }

    // 3. Menyimpan data aset baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'kode_aset'          => 'required|string|unique:assets,kode_aset',
            'nama_perangkat'     => 'required|string|max:255',
            'merk'               => 'nullable|string|max:255',
            'spesifikasi'        => 'nullable|string',
            'serial_number'      => 'nullable|string|max:255',
            'ip_address'         => 'nullable|ip', // Memastikan format IP valid jika diisi
            'mac_address'        => 'nullable|string|max:255',
            'jenis_perangkat_id' => 'required|exists:master_mappings,id',
            'kondisi_id'         => 'required|exists:master_mappings,id',
            'unit_id'            => 'required|exists:master_mappings,id',
        ]);

        Asset::create($request->all());

        return redirect('/asset')->with('success', 'Data aset perangkat baru berhasil diinventarisasi!');
    }

    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $mappings = MasterMapping::all()->groupBy('type');

        // Ambil data pendukung dropdown master mapping
        $types = ['jenis_perangkat', 'kondisi', 'unit'];
        $data = [];
        foreach ($types as $type) {
            $data[$type] = $mappings->get($type, collect());
        }

        return view('asset.edit', compact('asset', 'data'));
    }

    // 5. MEMPROSES UPDATE DATA ASET
    public function update(Request $request, $id)
    {
        $asset = Asset::findOrFail($id);

        $request->validate([
            'kode_aset'          => 'required|string|unique:assets,kode_aset,' . $asset->id, // Abaikan pengecekan unik untuk ID aset ini sendiri
            'nama_perangkat'     => 'required|string|max:255',
            'merk'               => 'nullable|string|max:255',
            'spesifikasi'        => 'nullable|string',
            'serial_number'      => 'nullable|string|max:255',
            'ip_address'         => 'nullable|ip',
            'mac_address'        => 'nullable|string|max:255',
            'jenis_perangkat_id' => 'required|exists:master_mappings,id',
            'kondisi_id'         => 'required|exists:master_mappings,id',
            'unit_id'            => 'required|exists:master_mappings,id',
        ]);

        $asset->update($request->all());

        return redirect('/asset')->with('success', 'Data inventaris aset berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->back()->with('success', 'Data inventaris aset berhasil dihapus!');
    }
}

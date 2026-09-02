<?php

namespace App\Http\Controllers;

use App\Models\MasterMapping;
use Illuminate\Http\Request;

class MasterMappingController extends Controller
{
    // Menampilkan halaman master mapping dengan mengelompokkan data berdasarkan type
    public function index()
    {
        $mappings = MasterMapping::all()->groupBy('type');

        // Memastikan key group tetap ada walaupun datanya masih kosong di database
        $types = ['unit', 'shift', 'teknisi', 'status_tiket', 'faktor_masalah', 'jenis_perangkat', 'kondisi', 'jenis_permintaan', 'sistem_layanan'];
        $data = [];
        foreach ($types as $type) {
            $data[$type] = $mappings->get($type, collect());
        }

        return view('master.mapping', compact('data'));
    }

    // Menyimpan parameter baru secara dinamis berdasarkan parameter 'type' dari form/route
    public function store(Request $request, $type)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        MasterMapping::create([
            'type' => $type,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Parameter berhasil ditambahkan!');
    }

    // Menghapus data master mapping
    public function destroy($id)
    {
        $mapping = MasterMapping::findOrFail($id);
        $mapping->delete();

        return redirect()->back()->with('success', 'Parameter berhasil dihapus!');
    }
}

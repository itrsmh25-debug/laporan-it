<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\FormPermintaanPerubahan;
use App\Models\LaporanHarian;
use App\Models\MasterMapping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today()->format('Y-m-d');
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $widget['total_case_hari_ini'] = LaporanHarian::where('tanggal', $hariIni)->count();
        $widget['total_case_bulan_ini'] = LaporanHarian::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->count();

        $widget['status_solve'] = LaporanHarian::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('status_tiket_id', function ($query) {
                $query->select('id')->from('master_mappings')->where('type', 'status_tiket')->where(function ($q) {
                    $q->where('name', 'LIKE', '%solve%')->orWhere('name', 'LIKE', '%selesai%');
                });
            })->count();

        $widget['status_pending'] = LaporanHarian::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('status_tiket_id', function ($query) {
                $query->select('id')->from('master_mappings')->where('type', 'status_tiket')->where('name', 'LIKE', '%pending%');
            })->count();

        $widget['status_opershift'] = LaporanHarian::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('status_tiket_id', function ($query) {
                $query->select('id')->from('master_mappings')->where('type', 'status_tiket')->where('name', 'LIKE', '%opershift%');
            })->count();

        $widget['total_aset'] = Asset::count();

        $widget['aset_good'] = Asset::whereIn('kondisi_id', function ($query) {
            $query->select('id')->from('master_mappings')->where('type', 'kondisi')->where('name', 'LIKE', '%good%');
        })->count();

        $widget['aset_warning'] = Asset::whereIn('kondisi_id', function ($query) {
            $query->select('id')->from('master_mappings')->where('type', 'kondisi')->where('name', 'LIKE', '%warning%');
        })->count();

        $topRuangan = LaporanHarian::select('unit_id', DB::raw('COUNT(id) as total'))
            ->with('unit')
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->groupBy('unit_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $logsHarian = LaporanHarian::with(['unit', 'teknisi', 'statusTiket'])
            ->select('id', 'unit_id', 'masalah', 'teknisi_id', 'status_tiket_id', 'created_at', DB::raw("'harian' as source_type"));


        $recentLogs = LaporanHarian::with(['unit', 'teknisi', 'statusTiket'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('widget', 'topRuangan', 'recentLogs'));
    }
}

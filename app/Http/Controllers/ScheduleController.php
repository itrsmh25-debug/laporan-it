<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\MasterMapping;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        $bulan = $request->get('bulan', date('m'));

        $startDate = Carbon::create($tahun, $bulan, 21)->subMonth()->format('Y-m-d');
        $endDate = Carbon::create($tahun, $bulan, 20)->format('Y-m-d');

        $period = CarbonPeriod::create($startDate, $endDate);
        $teknisiList = MasterMapping::where('type', 'teknisi')->get();

        $schedules = Schedule::whereBetween('date', [$startDate, $endDate])
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->teknisi_id . '_' . $item->date => $item->shift];
            })->toArray();

        return view('schedules.index', compact('teknisiList', 'period', 'schedules', 'tahun', 'bulan'));
    }

    public function create(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        $bulan = $request->get('bulan', date('m'));

        $startDate = Carbon::create($tahun, $bulan, 21);
        $endDate = Carbon::create($tahun, $bulan, 21)->addMonth()->subDay();

        $period = CarbonPeriod::create($startDate, $endDate);
        $teknisiList = MasterMapping::where('type', 'teknisi')->get();

        return view('schedules.create', compact('teknisiList', 'period', 'tahun', 'bulan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedules' => 'required|array'
        ]);

        foreach ($request->schedules as $teknisiId => $dates) {
            foreach ($dates as $date => $shift) {
                if (!empty($shift)) {
                    Schedule::updateOrCreate(
                        ['teknisi_id' => $teknisiId, 'date' => $date],
                        ['shift' => strtoupper($shift)]
                    );
                } else {
                    // Opsional: Hapus jika input dikosongkan
                    Schedule::where(['teknisi_id' => $teknisiId, 'date' => $date])->delete();
                }
            }
        }

        return redirect('/schedules')->with('success', 'Jadwal dinas berhasil diperbarui!');
    }

    public function export(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        $bulan = $request->get('bulan', date('m'));

        $startDate = Carbon::create($tahun, $bulan, 21)->subMonth()->format('Y-m-d');
        $endDate = Carbon::create($tahun, $bulan, 20)->format('Y-m-d');

        $period = CarbonPeriod::create($startDate, $endDate);
        $teknisiList = MasterMapping::where('type', 'teknisi')->get();

        // AMBIL DATA JAM KERJA DI SINI
        $jamKerja = MasterMapping::where('type', 'shift')->get();

        $schedules = Schedule::whereBetween('date', [$startDate, $endDate])
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->teknisi_id . '_' . $item->date => $item->shift];
            })->toArray();

        // TAMBAHKAN $jamKerja KE COMPACT
        return view('schedules.export_pdf', compact('teknisiList', 'period', 'schedules', 'tahun', 'bulan', 'jamKerja'));
    }
}

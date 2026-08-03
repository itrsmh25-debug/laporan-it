@extends('layouts.admin')
@section('title', 'Jadwal Dinas')

@section('content')
    <div class="container-fluid">
        <!-- Tambahan: Header dengan judul dan tombol aksi -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold m-0 text-dark">
                Jadwal Dinas (Periode {{ $period->first()->format('d M') }} - {{ $period->last()->format('d M Y') }})
            </h5>
            <div>
                <a href="/schedules/export?tahun={{ $tahun }}&bulan={{ $bulan }}" target="_blank"
                    class="btn btn-success btn-sm px-3 me-2">
                    <i class='bx bx-printer'></i> Cetak PDF
                </a>
                <a href="/schedules/create?tahun={{ $tahun }}&bulan={{ $bulan }}"
                    class="btn btn-primary btn-sm px-3">
                    <i class='bx bx-plus'></i> Input Jadwal
                </a>
            </div>
        </div>

        <div class="card-custom table-responsive">
            <table class="table table-bordered table-sm text-center align-middle">
                <thead>
                    <tr>
                        <th class="text-start">Teknisi</th>
                        @foreach ($period as $date)
                            @php
                                // Cek apakah hari Minggu (Sun)
                                $isSunday = $date->format('D') == 'Sun';
                            @endphp
                            {{-- Jika Minggu, beri class bg-danger --}}
                            <th style="width: 30px; font-size: 11px;" class="{{ $isSunday ? 'bg-danger text-white' : '' }}">
                                {{ $date->format('d') }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teknisiList as $t)
                        <tr>
                            <td class="text-start fw-bold">{{ $t->name }}</td>
                            @foreach ($period as $date)
                                @php
                                    $key = $t->id . '_' . $date->format('Y-m-d');
                                    $shift = $schedules[$key] ?? '-';
                                    $isSunday = $date->format('D') == 'Sun';

                                    // 1. Tentukan warna berdasarkan SHIFT KHUSUS (Prioritas Tertinggi)
                                    if ($shift == 'C') {
                                        $colorClass = 'bg-success text-white'; // Hijau
                                    } elseif ($shift == 'OC') {
                                        $colorClass = 'bg-warning text-dark'; // Kuning
                                    } elseif ($shift == 'MD') {
                                        $colorClass = 'bg-purple text-white'; // Ungu
                                    }
                                    // 2. Jika hari Minggu ATAU tanggal merah, warnai merah (termasuk untuk shift 'L' atau '-')
                                    elseif ($isSunday) {
                                        $colorClass = 'bg-danger text-white';
                                    }
                                    // 3. Jika bukan hari libur dan bukan shift khusus, tidak ada warna
                                    else {
                                        $colorClass = '';
                                    }
                                @endphp

                                <td class="fw-bold {{ $colorClass }}">
                                    {{ $shift }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

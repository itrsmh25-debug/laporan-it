@extends('layouts.admin')

@section('title', 'Rekap KPI Kinerja Teknisi IT')

@section('content')
    <div class="card-custom bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <div>
                <h5 class="fw-bold m-0 text-primary"><i class='bx bx-line-chart me-2'></i>Rekap KPI Kinerja Teknisi IT</h5>
                <small class="text-muted">
                    Total poin KPI dari semua log kasus (Poin penuh <strong>1.0</strong> jika selesai mandiri, dan dibagi
                    <strong>0.5</strong> jika di-oper).
                </small>
            </div>

            <form action="/laporan-kpi" method="GET" class="d-flex gap-2">
                <select name="bulan" class="form-select form-select-sm">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ sprintf('%02d', $m) }}" {{ $bulan == sprintf('%02d', $m) ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>
                <select name="tahun" class="form-select form-select-sm">
                    @for ($y = date('Y'); $y >= 2024; $y--)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}
                        </option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-primary btn-sm px-3">Filter</button>
            </form>
        </div>

        <div class="alert alert-info py-2 px-3 mb-4 text-dark small" style="background-color: #e3f2fd; border: none;">
            <i class='bx bx-info-circle text-primary me-1'></i> Total poin kinerja seluruh teknisi pada periode ini:
            <strong>{{ number_format($totalSeluruhCase ?? 0, 1) }} Poin</strong>.
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="80" class="text-center">Rank</th>
                        <th>Nama Teknisi IT</th>
                        <th class="text-center">Total Poin KPI</th>
                        <th width="250">Distribusi Beban Kerja</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kpiTeknisi as $index => $kpi)
                        @php
                            $totalCaseSafe = ($totalSeluruhCase ?? 0) > 0 ? $totalSeluruhCase : 1;
                            $persentase = round(($kpi->skor / $totalCaseSafe) * 100);

                            // Tentukan warna badge berdasarkan Index (0 = rank 1, dst)
                            $badgeColor = 'bg-secondary';
                            if ($index == 0) {
                                $badgeColor = 'bg-warning text-dark'; // Rank 1
                            } elseif ($index == 1) {
                                $badgeColor = 'bg-light text-dark border'; // Rank 2
                            } elseif ($index == 2) {
                                $badgeColor = 'bg-dark text-white'; // Rank 3
                            }
                        @endphp
                        <tr>
                            <td class="text-center">
                                <!-- Peringkat yang benar sesuai urutan skor -->
                                <span class="badge {{ $badgeColor }} rounded-circle px-2 py-2"
                                    style="width:35px; height:35px; line-height:20px; font-weight: bold; font-size: 14px;">
                                    {{ $index + 1 }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $kpi->teknisi->name ?? 'Teknisi Tidak Ditemukan' }}</div>
                            </td>
                            <td class="text-center fw-bold text-primary" style="font-size: 16px;">
                                {{ number_format($kpi->skor, 1) }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height: 6px; border-radius:3px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $persentase }}%"></div>
                                    </div>
                                    <span class="fw-bold text-muted small" style="min-width: 35px;">
                                        {{ $persentase }}%
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Tidak ada data KPI pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

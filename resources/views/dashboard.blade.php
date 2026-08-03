@extends('layouts.admin')

@section('title', 'Dashboard IT Master')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card-custom d-flex align-items-center justify-content-between m-0">
                <div>
                    <span class="d-block text-muted mb-1" style="font-size: 13px;">Log Kasus Hari Ini</span>
                    <h3 class="fw-bold mb-0 text-dark">{{ $widget['total_case_hari_ini'] }}</h3>
                    <small class="text-muted" style="font-size: 11px;">Bulan ini:
                        <strong>{{ $widget['total_case_bulan_ini'] }}</strong></small>
                </div>
                <div class="icon-box" style="background: var(--primary-light); color: var(--primary-color);"><i
                        class='bx bx-data'></i></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-custom d-flex align-items-center justify-content-between m-0">
                <div>
                    <span class="d-block text-muted mb-1" style="font-size: 13px;">Total Master Aset</span>
                    <h3 class="fw-bold mb-0 text-primary">{{ $widget['total_aset'] }}</h3>
                    <small class="text-success" style="font-size: 11px;"><i class='bx bx-check-circle'></i>
                        {{ $widget['aset_good'] }} Normal</small>
                </div>
                <div class="icon-box" style="background: #e3f2fd; color: #0d6efd;"><i class='bx bx-laptop'></i></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-custom d-flex align-items-center justify-content-between m-0">
                <div>
                    <span class="d-block text-muted mb-1" style="font-size: 13px;">Outstanding Pending</span>
                    <h3 class="fw-bold mb-0 text-danger">{{ $widget['status_pending'] }}</h3>
                    <small class="text-muted" style="font-size: 11px;">Butuh tindak lanjut segera</small>
                </div>
                <div class="icon-box" style="background: #ffebee; color: #f44336;"><i class='bx bx-time-five'></i></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-custom d-flex align-items-center justify-content-between m-0">
                <div>
                    <span class="d-block text-muted mb-1" style="font-size: 13px;">Operan Shift (PR)</span>
                    <h3 class="fw-bold mb-0 text-warning">{{ $widget['status_opershift'] }}</h3>
                    <small class="text-muted" style="font-size: 11px;">Belum di-handle selesai</small>
                </div>
                <div class="icon-box" style="background: #fff3e0; color: #ff9800;"><i class='bx bx-transfer-alt'></i></div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="card-custom h-100 mb-0">
                <h5 class="fw-bold text-dark mb-2"><i class='bx bx-desktop text-primary me-2'></i>Selamat Datang di Portal
                    SIMRS IT CORE</h5>
                <p class="text-muted mb-0">Gunakan workspace modular ini untuk memonitoring troubleshooting harian,
                    manajemen operan shift teknisi, dan tata kelola inventaris jaringan serta hardware rumah sakit secara
                    real-time.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-custom h-100 mb-0">
                <span class="d-block text-muted mb-2 small fw-bold text-uppercase">Rasio Solusi Bulan Ini</span>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="small"><i class='bx bxs-circle text-success me-1'></i> Solve</span>
                    <span class="fw-bold small">{{ $widget['status_solve'] }} Case</span>
                </div>
                <div class="progress" style="height: 8px; border-radius: 4px;">
                    @php
                        $totalStatus =
                            $widget['status_solve'] + $widget['status_pending'] + $widget['status_opershift'];
                        $pctSolve = $totalStatus > 0 ? ($widget['status_solve'] / $totalStatus) * 100 : 0;
                        $pctPending = $totalStatus > 0 ? ($widget['status_pending'] / $totalStatus) * 100 : 0;
                        $pctOper = $totalStatus > 0 ? ($widget['status_opershift'] / $totalStatus) * 100 : 0;
                    @endphp
                    <div class="progress-bar bg-success" style="width: {{ $pctSolve }}%"></div>
                    <div class="progress-bar bg-danger" style="width: {{ $pctPending }}%"></div>
                    <div class="progress-bar bg-warning" style="width: {{ $pctOper }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card-custom h-100 mb-0">
                <h6 class="fw-bold text-dark mb-3"><i class='bx bx-trending-up text-danger me-2'></i>Top 5 Unit Teraktif
                    (Bulan Ini)</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle m-0">
                        <tbody>
                            @forelse($topRuangan as $index => $ruangan)
                                <tr>
                                    <td width="30"><span
                                            class="badge bg-label-secondary small rounded-circle">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="fw-semibold text-dark small">{{ $ruangan->unit->name ?? 'Unknown Unit' }}
                                    </td>
                                    <td class="text-end"><span
                                            class="badge bg-light text-danger border fw-bold">{{ $ruangan->total }}
                                            Kasus</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted small py-3">Belum ada data komplain
                                        unit.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card-custom h-100 mb-0">
                <h6 class="fw-bold text-dark mb-3"><i class='bx bx-history text-primary me-2'></i>Log Masalah Masuk Terakhir
                </h6>
                <div class="table-responsive">
                    <table class="table table-sm align-middle m-0" style="font-size: 13px;">
                        <thead class="table-light">
                            <tr>
                                <th>Unit</th>
                                <th>Kendala Masalah</th>
                                <th>Teknisi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentLogs as $log)
                                <tr>
                                    <td class="fw-bold">{{ $log->unit->name ?? '-' }}</td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 260px;" title="{{ $log->masalah }}">
                                            {{ $log->masalah }}
                                        </div>
                                    </td>
                                    <td><small class="text-muted">{{ $log->teknisi->name ?? '-' }}</small></td>
                                    <td>
                                        @if ($log->source_type == 'permintaan')
                                            <span class="badge bg-label-primary px-2 py-1"
                                                style="font-size: 10px; color: #0d6efd; background-color: #e7f1ff;">Approved</span>
                                        @else
                                            @php $status = strtoupper($log->statusTiket->name ?? ''); @endphp
                                            @if (str_contains($status, 'SOLVE') || str_contains($status, 'SELESAI'))
                                                <span class="badge bg-label-success px-2 py-1"
                                                    style="font-size: 10px; color: #28a745; background-color: #e8f5e9;">Solve</span>
                                            @elseif(str_contains($status, 'PENDING'))
                                                <span class="badge bg-label-danger px-2 py-1"
                                                    style="font-size: 10px; color: #dc3545; background-color: #fde8e8;">Pending</span>
                                            @else
                                                <span class="badge bg-label-warning px-2 py-1"
                                                    style="font-size: 10px; color: #ffc107; background-color: #fff9db;">Opershift</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">Belum ada aktivitas log terinput.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

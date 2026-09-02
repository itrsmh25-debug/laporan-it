@extends('layouts.admin')

@section('title', 'Daftar Laporan Downtime')

@section('content')
    <div class="card-custom p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold m-0"><i class='bx bx-time-five text-primary me-2'></i>Daftar Laporan Downtime Sistem</h5>

            <div class="d-flex align-items-center gap-2">
                <select id="filterBulan" class="form-select form-select-sm" style="width: 120px;" onchange="filterData()">
                    @foreach (range(1, 12) as $m)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}"
                            {{ request('bulan', date('m')) == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>

                <select id="filterTahun" class="form-select form-select-sm" style="width: 100px;" onchange="filterData()">
                    @foreach (range(date('Y') - 2, date('Y') + 1) as $y)
                        <option value="{{ $y }}" {{ request('tahun', date('Y')) == $y ? 'selected' : '' }}>
                            {{ $y }}</option>
                    @endforeach
                </select>

                <a href="{{ route('laporan-downtime.create') }}" class="btn btn-primary btn-sm">
                    <i class='bx bx-plus'></i> Tambah
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No. Tiket</th>
                        <th>Waktu Mulai / Selesai</th>
                        <th>Unit / Ruangan</th>
                        <th>Teknisi</th>
                        <th>Penyebab & Solusi</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($downtimes as $downtime)
                        <tr>
                            <td><span class="fw-bold text-primary">{{ $downtime->nomor_tiket }}</span></td>
                            <td>
                                <small class="d-block"><strong>Mulai:</strong>
                                    {{ \Carbon\Carbon::parse($downtime->waktu_mulai)->translatedFormat('d M Y H:i') }}</small>
                                <small class="d-block text-muted"><strong>Selesai:</strong>
                                    {{ $downtime->waktu_selesai ? \Carbon\Carbon::parse($downtime->waktu_selesai)->translatedFormat('d M Y H:i') : 'Berlangsung' }}</small>
                                @if ($downtime->durasi_menit)
                                    <span class="badge bg-secondary mt-1">{{ $downtime->durasi_menit }} Menit</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $downtime->unit->name ?? '-' }}</td>
                            <td>{{ $downtime->teknisi->name ?? '-' }}</td>
                            <td>
                                <div class="text-wrap" style="max-width: 250px;">
                                    <strong>Penyebab:</strong> {{ $downtime->penyebab }}
                                </div>
                                <small class="text-success d-block mt-1">
                                    <strong>Perbaikan:</strong> {{ $downtime->tindakan_perbaikan }}
                                </small>
                            </td>
                            <td>
                                @php
                                    $statusName = $downtime->statusDowntime->name ?? 'Open';
                                @endphp
                                @if (in_array(strtolower($statusName), ['selesai', 'resolved', 'closed']))
                                    <span class="badge bg-success px-2 py-1">{{ $statusName }}</span>
                                @else
                                    <span class="badge bg-warning px-2 py-1 text-dark">{{ $statusName }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('laporan-downtime.edit', $downtime->id) }}"
                                        class="btn btn-sm btn-outline-warning">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    <form action="{{ route('laporan-downtime.destroy', $downtime->id) }}" method="POST"
                                        id="form-downtime-{{ $downtime->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-global"
                                            data-form-id="form-downtime-{{ $downtime->id }}"
                                            data-message="Laporan downtime {{ $downtime->nomor_tiket }} akan dihapus secara permanen!">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data laporan downtime.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (method_exists($downtimes, 'links'))
            <div class="d-flex justify-content-end mt-4">
                {{ $downtimes->links() }}
            </div>
        @endif
    </div>

    <script>
        function filterData() {
            const bulan = document.getElementById('filterBulan').value;
            const tahun = document.getElementById('filterTahun').value;
            window.location.href = "{{ route('laporan-downtime.index') }}?bulan=" + bulan + "&tahun=" + tahun;
        }
    </script>
@endsection

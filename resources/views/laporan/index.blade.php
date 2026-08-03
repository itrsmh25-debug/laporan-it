@extends('layouts.admin')

@section('title', 'Daftar Laporan Harian')

@section('content')
<div class="card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold m-0"><i class='bx bx-list-ul text-primary me-2'></i>Daftar Laporan Aktivitas</h5>

        <div class="d-flex align-items-center gap-2">
            <!-- Input Filter Periode -->
            <select id="filterBulan" class="form-select form-select-sm" style="width: 120px;">
                @foreach (range(1, 12) as $m)
                <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" {{ date('m') == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                </option>
                @endforeach
            </select>

            <select id="filterTahun" class="form-select form-select-sm" style="width: 100px;">
                @foreach (range(date('Y') - 2, date('Y') + 1) as $y)
                <option value="{{ $y }}" {{ date('Y') == $y ? 'selected' : '' }}>{{ $y }}
                </option>
                @endforeach
            </select>

            <!-- Tombol Export -->
            <button onclick="exportData('pdf')" class="btn btn-danger btn-sm">
                <i class='bx bxs-file-pdf'></i> PDF
            </button>

            <button onclick="exportData('excel')" class="btn btn-success btn-sm">
                <i class='bx bx-file-export'></i> Excel
            </button>

            <!-- Tombol Tambah -->
            <a href="/laporan/create" class="btn btn-primary btn-sm">
                <i class='bx bx-plus'></i> Tambah
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Unit / Ruangan</th>
                    <th>Teknisi</th>
                    <th>Masalah / Kendala</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporans as $laporan)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($laporan->tanggal)->translatedFormat('d M Y') }}</td>
                    <td class="fw-bold">{{ $laporan->unit->name ?? '-' }}</td>
                    <td>{{ $laporan->teknisi->name ?? '-' }}</td>
                    <td>
                        <div class="text-wrap" style="max-width: 300px;">
                            {{ $laporan->masalah }}
                        </div>
                        @if ($laporan->tindak_lanjut && $laporan->tindak_lanjut !== '-')
                        <small class="text-success d-block mt-1">
                            <strong>Solusi:</strong> {{ $laporan->tindak_lanjut }}
                        </small>
                        @endif
                    </td>

                    <td>
                        <span class="badge bg-info text-dark">{{ $laporan->faktorMasalah->name ?? '-' }}</span>
                    </td>

                    <td>
                        @php
                        $statusName = $laporan->statusTiket->name ?? 'Unknown';
                        @endphp
                        @if (in_array(strtolower($statusName), ['selesai', 'solve', 'solved']))
                        <span class="badge bg-success px-2 py-1">{{ $statusName }}</span>
                        @else
                        <span class="badge bg-warning px-2 py-1 text-dark">{{ $statusName }}</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="/laporan/{{ $laporan->id }}/edit" class="btn btn-sm btn-outline-warning">
                                <i class='bx bx-edit-alt'></i>
                            </a>
                            <form action="/laporan/{{ $laporan->id }}" method="POST"
                                id="form-laporan-{{ $laporan->id }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete-global"
                                    data-form-id="form-laporan-{{ $laporan->id }}"
                                    data-message="Catatan log aktivitas ruangan {{ $laporan->unit->name ?? 'ini' }} akan dihapus secara permanen!">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada riwayat kegiatan log aktivitas harian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    @if (method_exists($laporans, 'links'))
    <div class="d-flex justify-content-end mt-4">
        {{ $laporans->links() }}
    </div>
    @endif
</div>

<!-- Script untuk mengambil filter bulan/tahun saat ini -->
<script>
    function exportData(type) {
        const bulan = document.getElementById('filterBulan').value;
        const tahun = document.getElementById('filterTahun').value;

        console.log("Exporting - Bulan:", bulan, "Tahun:", tahun);

        let url = "";
        if (type === 'pdf') {
            url = "{{ route('laporan.export.pdf') }}?bulan=" + bulan + "&tahun=" + tahun;
        } else {
            url = "{{ route('laporan.export') }}?bulan=" + bulan + "&tahun=" + tahun;
        }

        window.location.href = url;
    }
</script>
@endsection
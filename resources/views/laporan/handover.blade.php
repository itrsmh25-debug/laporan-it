@extends('layouts.admin')

@section('title', 'Papan Operan Shift IT')

@section('content')
    <div class="card-custom bg-white p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div>
                <h5 class="fw-bold m-0 text-danger"><i class='bx bx-transfer-alt me-2'></i>Papan Outstanding Operan Shift</h5>
                <small class="text-muted">Daftar kendala yang belum tuntas dan wajib di-follow up shift ini.</small>
            </div>
            <span class="badge bg-danger px-3 py-2">{{ $tiketMengantung->count() }} Masalah Outstanding</span>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-white">
                    <tr>
                        <th>Tanggal / Shift</th>
                        <th>Unit / Ruangan</th>
                        <th>Kategori</th>
                        <th>Detail Masalah / Kendala</th>
                        <th>Teknisi Bertanggung Jawab</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tiketMengantung as $tiket)
                        <tr class="table-warning">
                            <td>
                                <span
                                    class="fw-bold d-block">{{ \Carbon\Carbon::parse($tiket->tanggal)->translatedFormat('d M Y') }}</span>
                                <small class="badge bg-secondary">{{ $tiket->shift->name ?? '-' }}</small>
                            </td>
                            <td class="fw-bold">{{ $tiket->unit->name ?? '-' }}</td>
                            <td><span class="badge bg-dark">{{ $tiket->faktorMasalah->name ?? '-' }}</span></td>
                            <td>
                                <div class="text-wrap" style="max-width: 300px;">
                                    <strong>Kendala:</strong> {{ $tiket->masalah }}
                                </div>
                                @if ($tiket->tindak_lanjut && $tiket->tindak_lanjut !== '-')
                                    <div class="text-muted small mt-1">
                                        <strong>Progress:</strong> {{ $tiket->tindak_lanjut }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span><i class='bx bx-user me-1'></i>{{ $tiket->teknisi->name ?? '-' }}</span>
                                    @if ($tiket->teknisi_penerima_id)
                                        <small class="text-primary fw-bold">
                                            <i class='bx bx-chevron-right'></i> Lanjut ke:
                                            {{ $tiket->teknisiPenerima->name ?? 'N/A' }}
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-danger px-2 py-1">{{ $tiket->statusTiket->name }}</span>
                            </td>
                            <td class="text-center">
                                <a href="/laporan/{{ $tiket->id }}/edit" class="btn btn-sm btn-primary">
                                    <i class='bx bx-check-circle me-1'></i> Selesaikan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-success py-5">
                                <i class='bx bx-check-shield display-4 d-block mb-2'></i>
                                <span class="fw-bold">Luar Biasa! Tidak ada tiket menggantung dari shift sebelumnya.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

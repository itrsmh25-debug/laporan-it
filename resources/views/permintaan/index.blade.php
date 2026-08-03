@extends('layouts.admin')

@section('title', 'Daftar Permintaan')

@section('content')
<div class="card-custom p-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold text-dark m-0">
            <i class='bx bx-git-pull-request text-primary me-2'></i>Permintaan Perubahan IT
        </h5>
        <span class="badge bg-primary rounded-pill">
            {{ $permintaans->where('status', 'pending')->count() }} Menunggu Approve
        </span>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class='bx bx-check-circle me-1'></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Desktop Table View -->
    <div class="table-responsive d-none d-md-block">
        <table class="table table-hover align-middle border">
            <thead class="table-light">
                <tr>
                    <th>Pemohon</th>
                    <th>Detail Permintaan</th>
                    <th>Bukti</th>
                    <th width="400">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permintaans as $p)
                <tr>
                    <td>
                        <div class="fw-bold text-dark">{{ $p->nama_pemohon }}</div>
                        <small class="text-muted">
                            <i class='bx bx-buildings'></i>
                            {{ $p->unit->name ?? ($p->bagian_unit ?? 'Unit Tidak Ditemukan') }}
                        </small>
                    </td>
                    <td>
                        <div class="text-truncate" style="max-width: 250px;" title="{{ $p->uraian_alasan }}">
                            {{ $p->uraian_alasan }}
                        </div>
                    </td>
                    <td>
                        @if ($p->bukti_dukung)
                        <a href="{{ asset($p->bukti_dukung) }}" target="_blank"
                            class="btn btn-sm btn-outline-info">
                            <i class='bx bx-image'></i> Lihat
                        </a>
                        @else
                        <span class="text-muted small">Tidak ada</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2" style="width: 250px;">
                            @if ($p->status == 'pending')
                            <!-- Form Approve -->
                            <form action="/form-permintaan/approve/{{ $p->id }}" method="POST"
                                class="d-flex align-items-center gap-1 m-0 flex-grow-1">
                                @csrf
                                <select name="teknisi_id" class="form-select form-select-sm" required style="font-size: 0.8rem;">
                                    <option value="">-- Pilih Teknisi --</option>
                                    @foreach ($teknisis as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-success text-nowrap shadow-sm">
                                    <i class='bx bx-check-double'></i> Approve
                                </button>
                            </form>
                            @else
                            <!-- Tombol Cetak PDF (Dibuat memenuhi ruang agar sama rata) -->
                            <a href="/form-permintaan/cetak/{{ $p->id }}" target="_blank"
                                class="btn btn-sm btn-danger shadow-sm flex-grow-1 text-nowrap d-flex align-items-center justify-content-center py-1">
                                <i class='bx bxs-file-pdf me-1'></i> Cetak Dokumen
                            </a>
                            @endif

                            <!-- Tombol Delete -->
                            <form action="{{ route('form-permintaan.destroy', $p->id) }}" method="POST" id="form-permintaan-{{ $p->id }}" class="d-inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete-global px-2"
                                    data-form-id="form-permintaan-{{ $p->id }}"
                                    data-message="Data permintaan perubahan dari {{ $p->nama_pemohon }} akan dihapus secara permanen!"
                                    title="Hapus Data">
                                    <i class='bx bx-trash fs-6'></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Tidak ada data permintaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="d-md-none">
        @forelse ($permintaans as $p)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold text-primary">{{ $p->nama_pemohon }}</span>
                    <span class="badge bg-light text-dark border">{{ $p->unit->name ?? ($p->bagian_unit ?? '-') }}</span>
                </div>
                <p class="small text-muted mb-2">{{ $p->uraian_alasan }}</p>

                <div class="d-grid gap-2">
                    @if ($p->status != 'pending')
                    <a href="/form-permintaan/cetak/{{ $p->id }}" target="_blank" class="btn btn-danger">
                        <i class='bx bxs-file-pdf'></i> Cetak PDF
                    </a>
                    @else
                    <form action="/form-permintaan/approve/{{ $p->id }}" method="POST">
                        @csrf
                        <select name="teknisi_id" class="form-select mb-2" required>
                            <option value="">Pilih Teknisi...</option>
                            @foreach ($teknisis as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success w-100">Approve Permintaan</button>
                    </form>
                    @endif

                    <!-- Tombol Delete Mobile menggunakan SweetAlert Global Layouts -->
                    <form action="{{ route('form-permintaan.destroy', $p->id) }}" method="POST" id="form-permintaan-mobile-{{ $p->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-danger w-100 btn-delete-global"
                            data-form-id="form-permintaan-mobile-{{ $p->id }}"
                            data-message="Data permintaan perubahan dari {{ $p->nama_pemohon }} akan dihapus secara permanen!">
                            <i class='bx bx-trash'></i> Hapus Permintaan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-4 text-muted">Tidak ada data permintaan.</div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    @if (method_exists($permintaans, 'links'))
    <div class="d-flex justify-content-end mt-4">
        {{ $permintaans->links() }}
    </div>
    @endif
</div>

<style>
    .btn-danger {
        background: linear-gradient(45deg, #dc3545, #b02a37);
        border: none;
        transition: 0.3s;
    }

    .btn-danger:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }

    .btn-success {
        background: linear-gradient(45deg, #198754, #157347);
        border: none;
    }

    /* Custom Styling untuk Pagination Laravel Bootstrap 5 */
    .pagination {
        margin-bottom: 0;
        gap: 4px;
    }

    .pagination .page-item .page-link {
        border-radius: 6px;
        color: #495057;
        border: 1px solid #dee2e6;
        padding: 6px 12px;
        font-size: 0.875rem;
        transition: all 0.2s ease-in-out;
    }

    .pagination .page-item .page-link:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
        border-color: #ced4da;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
        box-shadow: 0 2px 4px rgba(13, 110, 253, 0.2);
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
</style>
@endsection
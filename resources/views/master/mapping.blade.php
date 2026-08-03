@extends('layouts.admin')

@section('title', 'Master Mapping Konfigurasi')

@section('content')
    <div class="card-custom">
        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
            <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-3"><i class='bx bx-git-branches fs-3'></i></div>
            <div>
                <h5 class="fw-bold m-0 text-dark">Master Mapping Kebutuhan Data</h5>
                <small class="text-muted">Kelola data parameter pilihan (*options*) secara terpusat untuk Laporan Harian dan
                    Inventaris Aset IT</small>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class='bx bx-check-circle me-1'></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <ul class="nav nav-tabs mb-4" id="masterTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active fw-bold" data-bs-toggle="tab" data-bs-target="#tab-unit" type="button">
                    <i class='bx bx-buildings me-1'></i> Master Unit / Ruangan RS
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold" data-bs-toggle="tab" data-bs-target="#tab-laporan" type="button">
                    <i class='bx bx-file me-1'></i> Parameter Laporan Harian
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold" data-bs-toggle="tab" data-bs-target="#tab-aset" type="button">
                    <i class='bx bx-devices me-1'></i> Parameter Perangkat Aset
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold" data-bs-toggle="tab" data-bs-target="#tab-perubahan" type="button">
                    <i class='bx bx-devices me-1'></i> Form Perubahan
                </button>
            </li>
        </ul>

        <div class="tab-content" id="masterTabsContent">

            <div class="tab-pane fade show active" id="tab-unit">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="p-3 border rounded bg-light">
                            <h6 class="fw-bold text-dark mb-3">Tambah Master Unit</h6>
                            <form action="/master-mapping/unit" method="POST">
                                @csrf
                                <input type="text" class="form-control mb-2" name="name"
                                    placeholder="Contoh: Poli Paru, ICU, Rekam Medis..." required>
                                <button type="submit" class="btn btn-sm btn-primary w-100">Tambah Unit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table class="table border table-sm align-middle">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th>Nama Unit / Ruangan Kerja (Global)</th>
                                        <th width="80" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data['unit'] as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">
                                                <form action="/master-mapping/{{ $item->id }}" method="POST"
                                                    id="form-mapping-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm text-danger p-0 btn-delete-global"
                                                        data-form-id="form-mapping-{{ $item->id }}">
                                                        <i class='bx bx-x-circle fs-5'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-3">Belum ada data unit.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-laporan">
                <div class="row g-4">
                    <div class="col-md-6 border-end">
                        <h6 class="fw-bold text-primary mb-2"><i class='bx bx-time-five me-1'></i> 1. Shift Kerja</h6>
                        <form action="/master-mapping/shift" method="POST" class="input-group input-group-sm mb-2">
                            @csrf
                            <input type="text" class="form-control" name="name"
                                placeholder="Contoh: Shift Pagi (07:00 - 14:00)" required>
                            <button type="submit" class="btn btn-outline-primary">Tambah</button>
                        </form>
                        <div style="max-height: 180px; overflow-y: auto;">
                            <table class="table table-bordered table-sm align-middle">
                                <tbody>
                                    @forelse($data['shift'] as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td width="40" class="text-center">
                                                <form action="/master-mapping/{{ $item->id }}" method="POST"
                                                    id="form-mapping-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm text-danger p-0 btn-delete-global"
                                                        data-form-id="form-mapping-{{ $item->id }}">
                                                        <i class='bx bx-x-circle fs-5'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-2">Data kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary mb-2"><i class='bx bx-user me-1'></i> 2. Teknisi IT</h6>
                        <form action="/master-mapping/teknisi" method="POST" class="input-group input-group-sm mb-2">
                            @csrf
                            <input type="text" class="form-control" name="name" placeholder="Nama Teknisi..."
                                required>
                            <button type="submit" class="btn btn-outline-primary">Tambah</button>
                        </form>
                        <div style="max-height: 180px; overflow-y: auto;">
                            <table class="table table-bordered table-sm align-middle">
                                <tbody>
                                    @forelse($data['teknisi'] as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td width="40" class="text-center">
                                                <form action="/master-mapping/{{ $item->id }}" method="POST"
                                                    id="form-mapping-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm text-danger p-0 btn-delete-global"
                                                        data-form-id="form-mapping-{{ $item->id }}">
                                                        <i class='bx bx-x-circle fs-5'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-2">Data kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6 border-end pt-2">
                        <h6 class="fw-bold text-primary mb-2"><i class='bx bx-shield-quarter me-1'></i> 3. Status Akhir
                            Tiket</h6>
                        <form action="/master-mapping/status_tiket" method="POST"
                            class="input-group input-group-sm mb-2">
                            @csrf
                            <input type="text" class="form-control" name="name"
                                placeholder="Contoh: Selesai, Pending, Escalated" required>
                            <button type="submit" class="btn btn-outline-primary">Tambah</button>
                        </form>
                        <div style="max-height: 180px; overflow-y: auto;">
                            <table class="table table-bordered table-sm align-middle">
                                <tbody>
                                    @forelse($data['status_tiket'] as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td width="40" class="text-center">
                                                <form action="/master-mapping/{{ $item->id }}" method="POST"
                                                    id="form-mapping-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm text-danger p-0 btn-delete-global"
                                                        data-form-id="form-mapping-{{ $item->id }}">
                                                        <i class='bx bx-x-circle fs-5'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-2">Data kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6 pt-2">
                        <h6 class="fw-bold text-primary mb-2"><i class='bx bx-git-branch me-1'></i> 4. Faktor Masalah /
                            Kategori</h6>
                        <form action="/master-mapping/faktor_masalah" method="POST"
                            class="input-group input-group-sm mb-2">
                            @csrf
                            <input type="text" class="form-control" name="name"
                                placeholder="Contoh: SIMRS, Jaringan, Hardware" required>
                            <button type="submit" class="btn btn-outline-primary">Tambah</button>
                        </form>
                        <div style="max-height: 180px; overflow-y: auto;">
                            <table class="table table-bordered table-sm align-middle">
                                <tbody>
                                    @forelse($data['faktor_masalah'] as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td width="40" class="text-center">
                                                <form action="/master-mapping/{{ $item->id }}" method="POST"
                                                    id="form-mapping-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm text-danger p-0 btn-delete-global"
                                                        data-form-id="form-mapping-{{ $item->id }}">
                                                        <i class='bx bx-x-circle fs-5'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-2">Data kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-aset">
                <div class="row g-4">
                    <div class="col-md-6 border-end">
                        <h6 class="fw-bold text-success mb-2"><i class='bx bx-desktop me-1'></i> 1. Jenis Perangkat IT
                        </h6>
                        <form action="/master-mapping/jenis_perangkat" method="POST"
                            class="input-group input-group-sm mb-2">
                            @csrf
                            <input type="text" class="form-control" name="name"
                                placeholder="Contoh: CPU, Printer, CCTV" required>
                            <button type="submit" class="btn btn-outline-success">Tambah</button>
                        </form>
                        <div style="max-height: 180px; overflow-y: auto;">
                            <table class="table table-bordered table-sm align-middle">
                                <tbody>
                                    @forelse($data['jenis_perangkat'] as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td width="40" class="text-center">
                                                <form action="/master-mapping/{{ $item->id }}" method="POST"
                                                    id="form-mapping-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm text-danger p-0 btn-delete-global"
                                                        data-form-id="form-mapping-{{ $item->id }}">
                                                        <i class='bx bx-x-circle fs-5'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-2">Data kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="fw-bold text-success mb-2"><i class='bx bx-wrench me-1'></i> 2. Kondisi Perangkat</h6>
                        <form action="/master-mapping/kondisi" method="POST" class="input-group input-group-sm mb-2">
                            @csrf
                            <input type="text" class="form-control" name="name"
                                placeholder="Contoh: GOOD - Normal, DAMAGED - Rusak" required>
                            <button type="submit" class="btn btn-outline-success">Tambah</button>
                        </form>
                        <div style="max-height: 180px; overflow-y: auto;">
                            <table class="table table-bordered table-sm align-middle">
                                <tbody>
                                    @forelse($data['kondisi'] as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td width="40" class="text-center">
                                                <form action="/master-mapping/{{ $item->id }}" method="POST"
                                                    id="form-mapping-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm text-danger p-0 btn-delete-global"
                                                        data-form-id="form-mapping-{{ $item->id }}">
                                                        <i class='bx bx-x-circle fs-5'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-2">Data kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-perubahan">
                <div class="row g-4">
                    <div class="col-md-6 border-end">
                        <h6 class="fw-bold text-success mb-2"><i class='bx bx-desktop me-1'></i> 1. Jenis Permintaan
                        </h6>
                        <form action="/master-mapping/jenis_permintaan" method="POST"
                            class="input-group input-group-sm mb-2">
                            @csrf
                            <input type="text" class="form-control" name="name"
                                placeholder="Contoh: Hapus CPPT, Hapus Eval, Buka Regis" required>
                            <button type="submit" class="btn btn-outline-success">Tambah</button>
                        </form>
                        <div style="max-height: 180px; overflow-y: auto;">
                            <table class="table table-bordered table-sm align-middle">
                                <tbody>
                                    @forelse($data['jenis_permintaan'] as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td width="40" class="text-center">
                                                <form action="/master-mapping/{{ $item->id }}" method="POST"
                                                    id="form-mapping-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm text-danger p-0 btn-delete-global"
                                                        data-form-id="form-mapping-{{ $item->id }}">
                                                        <i class='bx bx-x-circle fs-5'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-2">Data kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

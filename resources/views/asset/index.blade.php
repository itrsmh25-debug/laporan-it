@extends('layouts.admin')

@section('title', 'Daftar Master Inventaris Aset')

@section('content')
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold m-0" style="color: var(--text-heading);"><i class='bx bx-box text-primary me-2'></i>Daftar
                Master Inventaris Aset Perangkat</h5>
            <a href="/asset/create" class="btn btn-primary btn-sm px-3"
                style="background-color: var(--primary-color); border:none;"><i class='bx bx-plus'></i> Registrasi
                Perangkat</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class='bx bx-check-circle me-1'></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode Aset</th>
                        <th>Lokasi Unit</th>
                        <th>Jenis</th>
                        <th>Merek / Model</th>
                        <th>Serial Number</th>
                        <th>IP / MAC Address</th>
                        <th>Kondisi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assets as $asset)
                        <tr>
                            <td class="fw-bold text-primary">{{ $asset->kode_aset }}</td>
                            <td>{{ $asset->unit->name ?? '-' }}</td>
                            <td>{{ $asset->jenisPerangkat->name ?? '-' }}</td>
                            <td>
                                {{ $asset->merk }}
                                @if ($asset->spesifikasi)
                                    <small class="text-muted d-block" style="font-size: 11px;">Spec:
                                        {{ $asset->spesifikasi }}</small>
                                @endif
                            </td>
                            <td><code class="text-dark">{{ $asset->serial_number ?? '-' }}</code></td>
                            <td>
                                @if ($asset->ip_address)
                                    <code>{{ $asset->ip_address }}</code>
                                @endif
                                @if ($asset->mac_address)
                                    <small class="text-muted d-block" style="font-size: 11px;">MAC:
                                        {{ $asset->mac_address }}</small>
                                @endif
                                @if (!$asset->ip_address && !$asset->mac_address)
                                    -
                                @endif
                            </td>
                            <td>
                                @if (str_contains(strtoupper($asset->kondisi->name ?? ''), 'GOOD'))
                                    <span class="badge badge-success px-2 py-1">{{ $asset->kondisi->name }}</span>
                                @else
                                    <span
                                        class="badge badge-warning px-2 py-1 text-dark">{{ $asset->kondisi->name }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="/asset/{{ $asset->id }}/edit" class="btn btn-sm btn-outline-warning"><i
                                            class='bx bx-edit-alt'></i></a>

                                    <form action="/asset/{{ $asset->id }}" method="POST"
                                        id="form-asset-{{ $asset->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-global"
                                            data-form-id="form-asset-{{ $asset->id }}"
                                            data-message="Data aset {{ $asset->nama_perangkat }} akan dihapus permanen dari inventaris!">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada perangkat IT yang terregistrasi
                                dalam sistem inventaris.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

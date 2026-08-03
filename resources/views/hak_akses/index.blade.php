@extends('layouts.admin')

@section('content')
    <div class="card-custom p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold text-dark m-0">
                <i class='bx bx-id-card text-primary me-2'></i>Daftar Permintaan Hak Akses
            </h5>
            <a href="{{ route('hak-akses.create') }}" class="btn btn-primary">
                <i class='bx bx-plus me-1'></i> Tambah Permintaan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="table-light">
                    <tr>
                        <th>Pemohon</th>
                        <th>Detail (Unit/Pendidikan)</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $item->nama_lengkap }}</div>
                                <small class="text-muted">NIP: {{ $item->nip }}</small>
                            </td>
                            <td>
                                <div>{{ $item->unit }}</div>
                                <small class="text-muted">{{ $item->pendidikan }}</small>
                            </td>
                            <td>
                                <div>{{ $item->email }}</div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('hak-akses.show', $item->id) }}"
                                        class="btn btn-sm btn-info text-white">Detail</a>
                                    <a href="{{ route('hak-akses.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('hak-akses.export', $item->id) }}" target="_blank"
                                        class="btn btn-sm btn-danger">PDF</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

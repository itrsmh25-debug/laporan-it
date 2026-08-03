@extends('layouts.admin')

@section('title', 'Daftar Laporan Kerusakan')

@section('content')
    <div class="container-fluid">
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0"><i class='bx bx-wrench text-danger me-2'></i>Laporan Kerusakan</h5>
                <a href="/laporan-kerusakan/create" class="btn btn-primary btn-sm"><i class='bx bx-plus'></i> Buat Laporan</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Aset</th>
                            <th>Rekomendasi</th>
                            <th>Biaya</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $item)
                            <tr>
                                <td class="fw-bold">{{ $item->asset->nama_perangkat }}</td>
                                <td>
                                    <span
                                        class="badge {{ $item->rekomendasi == 'beli_baru' ? 'bg-danger' : 'bg-warning text-dark' }}">
                                        {{ strtoupper(str_replace('_', ' ', $item->rekomendasi)) }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($item->estimasi_biaya, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="/laporan-kerusakan/{{ $item->id }}/pdf" target="_blank"
                                            class="btn btn-sm btn-outline-primary"><i class='bx bx-printer'></i></a>
                                        <a href="{{ route('laporan-kerusakan.edit', $item->id) }}"
                                            class="btn btn-sm btn-outline-warning"><i class='bx bx-edit'></i></a>

                                        <form action="{{ route('laporan-kerusakan.destroy', $item->id) }}" method="POST"
                                            id="del-{{ $item->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete-global"
                                                data-form-id="del-{{ $item->id }}">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

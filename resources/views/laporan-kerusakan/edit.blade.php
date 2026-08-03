@extends('layouts.admin')

@section('title', 'Edit Laporan Kerusakan')

@section('content')
    <div class="container-fluid">
        <div class="card-custom p-4">
            <h4 class="fw-bold mb-4" style="color: #2b3a4a;">
                <i class='bx bx-edit text-warning me-2'></i>Edit Laporan Kerusakan
            </h4>

            <form action="{{ route('laporan-kerusakan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 form-group-custom mb-3">
                        <label>Pilih Aset Perangkat</label>
                        <select class="form-select form-custom-input" name="asset_id" required>
                            @foreach ($assets as $a)
                                <option value="{{ $a->id }}" {{ $laporan->asset_id == $a->id ? 'selected' : '' }}>
                                    {{ $a->kode_aset }} - {{ $a->nama_perangkat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group-custom mb-3">
                        <label>Rekomendasi Tindakan</label>
                        <select class="form-select form-custom-input" name="rekomendasi" required>
                            <option value="service" {{ $laporan->rekomendasi == 'service' ? 'selected' : '' }}>Service /
                                Perbaikan</option>
                            <option value="beli_baru" {{ $laporan->rekomendasi == 'beli_baru' ? 'selected' : '' }}>Beli Baru
                                / Penggantian</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group-custom mb-3">
                        <label>Deskripsi Kerusakan</label>
                        <textarea name="deskripsi_kerusakan" class="form-control form-custom-input" rows="2" required>{{ $laporan->deskripsi_kerusakan }}</textarea>
                    </div>
                    <div class="col-md-6 form-group-custom mb-3">
                        <label>Ganti Foto Bukti (Opsional)</label>
                        <input type="file" name="foto" class="form-control form-custom-input">
                        <small class="text-muted">Foto saat ini: {{ $laporan->foto_bukti }}</small>
                    </div>
                    <div class="col-md-6 form-group-custom mb-3">
                        <label>Estimasi Biaya (Rp)</label>
                        <input type="number" name="estimasi_biaya" class="form-control form-custom-input"
                            value="{{ $laporan->estimasi_biaya }}" required>
                    </div>
                    <div class="col-md-12 form-group-custom mb-3">
                        <label>Alasan Rekomendasi</label>
                        <textarea name="alasan_rekomendasi" class="form-control form-custom-input" rows="2" required>{{ $laporan->alasan_rekomendasi }}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <a href="/laporan-kerusakan" class="btn btn-light border px-4">Batal</a>
                    <button type="submit" class="btn btn-warning px-4 text-white">Update Laporan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

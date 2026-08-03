@extends('layouts.admin')

@section('title', 'Buat Laporan Kerusakan')

@section('content')
    <div class="card-custom p-4">
        <h4 class="fw-bold mb-4" style="color: #2b3a4a;">
            <i class='bx bx-file text-primary me-2'></i>Form Laporan Kerusakan Aset
        </h4>

        <form action="/laporan-kerusakan" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label>Pilih Aset Perangkat</label>
                    <select class="form-select form-custom-input" name="asset_id" required>
                        <option value="">-- Pilih Aset --</option>
                        @foreach ($assets as $asset)
                            <option value="{{ $asset->id }}">{{ $asset->kode_aset }} - {{ $asset->nama_perangkat }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group-custom">
                    <label>Rekomendasi Tindakan</label>
                    <select class="form-select form-custom-input" name="rekomendasi" required>
                        <option value="service">Service / Perbaikan</option>
                        <option value="beli_baru">Beli Baru / Penggantian</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group-custom">
                    <label>Deskripsi Kerusakan</label>
                    <textarea class="form-control form-custom-input" name="deskripsi_kerusakan" rows="2"
                        placeholder="Jelaskan detail kerusakannya..." required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label>Estimasi Biaya (Rp)</label>
                    <input type="number" class="form-control form-custom-input" name="estimasi_biaya"
                        placeholder="Contoh: 500000" required>
                </div>
                <div class="col-md-6 form-group-custom">
                    <label>Bukti Foto Kerusakan</label>
                    <input type="file" class="form-control form-custom-input" name="foto" accept="image/*" required>
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group-custom">
                    <label>Alasan Rekomendasi</label>
                    <textarea class="form-control form-custom-input" name="alasan_rekomendasi" rows="2"
                        placeholder="Alasan mengapa disarankan Service atau Beli Baru..." required></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 border-top pt-3">
                <a href="/laporan-kerusakan" class="btn btn-light border px-4">Batal</a>
                <button type="submit" class="btn btn-primary px-4">Simpan Laporan</button>
            </div>
        </form>
    </div>
@endsection

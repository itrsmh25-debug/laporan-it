@extends('layouts.admin')

@section('title', 'Edit Laporan Downtime')

@section('content')
    <div class="card-custom p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold m-0"><i class='bx bx-edit text-primary me-2'></i>Edit Laporan Downtime:
                {{ $laporanDowntime->nomor_tiket }}</h5>
            <a href="{{ route('laporan-downtime.index') }}" class="btn btn-secondary btn-sm"><i class='bx bx-arrow-back'></i>
                Kembali</a>
        </div>

        <form action="{{ route('laporan-downtime.update', $laporanDowntime->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nomor Tiket</label>
                    <input type="text" class="form-control" value="{{ $laporanDowntime->nomor_tiket }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Unit / Ruangan Terdampak</label>
                    <select name="unit_id" class="form-select @error('unit_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Unit --</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}"
                                {{ old('unit_id', $laporanDowntime->unit_id) == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}</option>
                        @endforeach
                    </select>
                    @error('unit_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Waktu Mulai</label>
                    <input type="datetime-local" name="waktu_mulai"
                        class="form-control @error('waktu_mulai') is-invalid @enderror"
                        value="{{ old('waktu_mulai', $laporanDowntime->waktu_mulai ? $laporanDowntime->waktu_mulai->format('Y-m-d\TH:i') : '') }}"
                        required>
                    @error('waktu_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Waktu Selesai (Opsional)</label>
                    <input type="datetime-local" name="waktu_selesai"
                        class="form-control @error('waktu_selesai') is-invalid @enderror"
                        value="{{ old('waktu_selesai', $laporanDowntime->waktu_selesai ? $laporanDowntime->waktu_selesai->format('Y-m-d\TH:i') : '') }}">
                    @error('waktu_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Teknisi Penanggung Jawab</label>
                    <select name="teknisi_id" class="form-select @error('teknisi_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Teknisi --</option>
                        @foreach ($teknisis as $teknisi)
                            <option value="{{ $teknisi->id }}"
                                {{ old('teknisi_id', $laporanDowntime->teknisi_id) == $teknisi->id ? 'selected' : '' }}>
                                {{ $teknisi->name }}</option>
                        @endforeach
                    </select>
                    @error('teknisi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status Downtime</label>
                    <select name="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}"
                                {{ old('status_id', $laporanDowntime->status_id) == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error('status_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Nama Pelapor</label>
                    <input type="text" name="nama_pelapor"
                        class="form-control @error('nama_pelapor') is-invalid @enderror"
                        value="{{ old('nama_pelapor', $laporanDowntime->nama_pelapor) }}" required>
                    @error('nama_pelapor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Penyebab Masalah</label>
                    <textarea name="penyebab" class="form-control @error('penyebab') is-invalid @enderror" rows="3" required>{{ old('penyebab', $laporanDowntime->penyebab) }}</textarea>
                    @error('penyebab')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tindakan Perbaikan / Solusi</label>
                    <textarea name="tindakan_perbaikan" class="form-control @error('tindakan_perbaikan') is-invalid @enderror"
                        rows="3" required>{{ old('tindakan_perbaikan', $laporanDowntime->tindakan_perbaikan) }}</textarea>
                    @error('tindakan_perbaikan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4">Perbarui Laporan</button>
            </div>
        </form>
    </div>
@endsection

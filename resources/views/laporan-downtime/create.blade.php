@extends('layouts.admin')

@section('title', 'Tambah Laporan Downtime')

@section('content')
    <div class="card-custom p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold m-0"><i class='bx bx-plus-circle text-primary me-2'></i>Tambah Laporan Downtime</h5>
            <a href="{{ route('laporan-downtime.index') }}" class="btn btn-secondary btn-sm"><i class='bx bx-arrow-back'></i>
                Kembali</a>
        </div>

        {{-- Alert jika ada validasi error secara umum --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class='bx bx-error-circle me-1'></i> <strong>Terjadi Kesalahan!</strong> Mohon periksa kembali form di
                bawah ini.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('laporan-downtime.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nomor Tiket</label>
                    <input type="text" class="form-control" value="{{ $nomorTiket }}" readonly>
                </div>

                <!-- Sistem / Layanan IT Terdampak -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Sistem / Layanan IT Terdampak <span
                            class="text-danger">*</span></label>
                    <select name="sistem_layanan_id" class="form-select @error('sistem_layanan_id') is-invalid @enderror"
                        required>
                        <option value="">-- Pilih Sistem / Layanan --</option>
                        @foreach ($sistemLayanans as $sistem)
                            <option value="{{ $sistem->id }}"
                                {{ old('sistem_layanan_id') == $sistem->id ? 'selected' : '' }}>
                                {{ $sistem->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('sistem_layanan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Waktu Mulai -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Waktu Mulai <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="waktu_mulai"
                        class="form-control @error('waktu_mulai') is-invalid @enderror" value="{{ old('waktu_mulai') }}"
                        required>
                    @error('waktu_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Waktu Selesai -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Waktu Selesai (Opsional)</label>
                    <input type="datetime-local" name="waktu_selesai"
                        class="form-control @error('waktu_selesai') is-invalid @enderror"
                        value="{{ old('waktu_selesai') }}">
                    @error('waktu_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Teknisi Penanggung Jawab -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Teknisi Penanggung Jawab <span class="text-danger">*</span></label>
                    <select name="teknisi_id" class="form-select @error('teknisi_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Teknisi --</option>
                        @foreach ($teknisis as $teknisi)
                            <option value="{{ $teknisi->id }}" {{ old('teknisi_id') == $teknisi->id ? 'selected' : '' }}>
                                {{ $teknisi->name }}</option>
                        @endforeach
                    </select>
                    @error('teknisi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status Downtime -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status Downtime <span class="text-danger">*</span></label>
                    <select name="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error('status_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Pelapor -->
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Nama Pelapor <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pelapor"
                        class="form-control @error('nama_pelapor') is-invalid @enderror" value="{{ old('nama_pelapor') }}"
                        placeholder="Nama staff yang melaporkan" required>
                    @error('nama_pelapor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Penyebab Masalah -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Penyebab Masalah <span class="text-danger">*</span></label>
                    <textarea name="penyebab" class="form-control @error('penyebab') is-invalid @enderror" rows="3"
                        placeholder="Deskripsikan akar masalah..." required>{{ old('penyebab') }}</textarea>
                    @error('penyebab')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tindakan Perbaikan -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tindakan Perbaikan / Solusi <span class="text-danger">*</span></label>
                    <textarea name="tindakan_perbaikan" class="form-control @error('tindakan_perbaikan') is-invalid @enderror"
                        rows="3" placeholder="Deskripsikan tindakan penyelesaian..." required>{{ old('tindakan_perbaikan') }}</textarea>
                    @error('tindakan_perbaikan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4">Simpan Laporan</button>
            </div>
        </form>
    </div>
@endsection

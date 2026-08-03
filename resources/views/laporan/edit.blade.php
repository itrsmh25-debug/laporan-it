@extends('layouts.admin')

@section('title', 'Edit Laporan Harian')

@section('content')
    <div class="card-custom p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <h5 class="fw-bold m-0 text-dark"><i class='bx bx-edit text-warning me-2'></i>Edit Kegiatan Harian IT</h5>
            <a href="/laporan" class="btn btn-outline-secondary btn-sm px-3">Kembali</a>
        </div>

        <form action="/laporan/{{ $laporan->id }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            <!-- Tanggal -->
            <div class="row">
                <div class="col-12 form-group-custom">
                    <label><i class='bx bx-calendar text-muted'></i> Tanggal Kegiatan Log</label>
                    <input type="date" class="form-control form-custom-input fw-bold text-dark" name="tanggal"
                        value="{{ $laporan->tanggal }}" required>
                </div>
            </div>

            <!-- Shift & Unit -->
            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-time-five text-muted'></i> Shift Kerja</label>
                    <select class="form-select form-custom-input" name="shift_id" required>
                        @foreach ($data['shift'] as $item)
                            <option value="{{ $item->id }}" {{ $laporan->shift_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-buildings text-muted'></i> Unit / Ruangan</label>
                    <select class="form-select form-custom-input" name="unit_id" required>
                        @foreach ($data['unit'] as $item)
                            <option value="{{ $item->id }}" {{ $laporan->unit_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Teknisi & Kategori -->
            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-user-voice text-muted'></i> Teknisi IT Bertugas</label>
                    <select class="form-select form-custom-input" name="teknisi_id" required>
                        @foreach ($data['teknisi'] as $item)
                            <option value="{{ $item->id }}" {{ $laporan->teknisi_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-git-branch text-muted'></i> Faktor Masalah / Kategori</label>
                    <select class="form-select form-custom-input" name="faktor_masalah_id" required>
                        @foreach ($data['faktor_masalah'] as $item)
                            <option value="{{ $item->id }}"
                                {{ $laporan->faktor_masalah_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Masalah -->
            <div class="row">
                <div class="col-12 form-group-custom">
                    <label><i class='bx bx-error-circle text-muted'></i> Masalah / Kegiatan Kendala</label>
                    <textarea class="form-control form-custom-input" name="masalah" rows="4" required>{{ $laporan->masalah }}</textarea>
                </div>
            </div>

            <!-- STATUS & TEKNISI PENERIMA (SELALU TAMPIL) -->
            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-shield-quarter text-muted'></i> Status Akhir Tiket</label>
                    <select class="form-select form-custom-input" name="status_tiket_id" required>
                        @foreach ($data['status_tiket'] as $item)
                            <option value="{{ $item->id }}"
                                {{ $laporan->status_tiket_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-transfer-alt text-muted'></i> Teknisi Penerima (Jika ada operan)</label>
                    <select class="form-select form-custom-input" name="teknisi_penerima_id">
                        <option value="">-- Pilih Teknisi Penerima --</option>
                        @foreach ($data['teknisi'] as $item)
                            <option value="{{ $item->id }}"
                                {{ $laporan->teknisi_penerima_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Pelapor & Tindak Lanjut -->
            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-user text-muted'></i> Nama Pelapor Staf</label>
                    <input type="text" class="form-control form-custom-input" name="nama_pelapor"
                        value="{{ $laporan->nama_pelapor }}" required>
                </div>
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-edit-alt text-muted'></i> Keterangan Tindak Lanjut</label>
                    <input type="text" class="form-control form-custom-input" name="tindak_lanjut"
                        value="{{ $laporan->tindak_lanjut }}">
                </div>
            </div>

            <button type="submit" class="btn btn-warning w-100 mt-3 p-2 fw-bold text-dark" style="border:none;">
                Perbarui Catatan Log
            </button>
        </form>
    </div>
<script>
    document.getElementById('status_tiket').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const statusName = selectedOption.getAttribute('data-name');
        const fieldPenerima = document.getElementById('field-teknisi-penerima');

        if (statusName && (statusName.includes('oper') || statusName.includes('shift'))) {
            fieldPenerima.style.display = 'block';
        } else {
            fieldPenerima.style.display = 'none';
        }
    });
</script>
@endsection

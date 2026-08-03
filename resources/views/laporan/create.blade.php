@extends('layouts.admin')

@section('title', 'Buat Laporan Baru')

@section('content')
    <div class="card-custom p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <h5 class="fw-bold m-0 text-dark"><i class='bx bx-edit-alt text-primary me-2'></i>Input Kegiatan Harian IT</h5>
            <a href="/laporan" class="btn btn-outline-secondary btn-sm px-3">Kembali</a>
        </div>

        <form action="/laporan/store" method="POST">
            @csrf

            <div class="row">
                <div class="col-12 form-group-custom">
                    <label><i class='bx bx-calendar text-muted'></i> Tanggal Kegiatan Log</label>
                    <input type="date" class="form-control form-custom-input fw-bold text-dark" name="tanggal"
                        value="{{ date('Y-m-d') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-time-five text-muted'></i> Shift Kerja</label>
                    <select class="form-select form-custom-input" name="shift_id" required>
                        <option value="">-- Pilih Shift Kerja --</option>
                        @foreach ($data['shift'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-buildings text-muted'></i> Unit / Ruangan</label>
                    <select class="form-select form-custom-input" name="unit_id" required>
                        <option value="">-- Pilih Unit / Ruangan --</option>
                        @foreach ($data['unit'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-user-voice text-muted'></i> Teknisi IT Bertugas</label>
                    <select class="form-select form-custom-input" name="teknisi_id" required>
                        <option value="">-- Pilih Teknisi --</option>
                        @foreach ($data['teknisi'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-git-branch text-muted'></i> Faktor Masalah / Kategori</label>
                    <select class="form-select form-custom-input" name="faktor_masalah_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($data['faktor_masalah'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group-custom">
                    <label><i class='bx bx-error-circle text-muted'></i> Masalah / Kegiatan Kendala</label>
                    <textarea class="form-control form-custom-input" name="masalah" rows="4"
                        placeholder="Detail troubleshooting secara rinci..." required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-shield-quarter text-muted'></i> Status Akhir Tiket</label>
                    <select class="form-select form-custom-input" name="status_tiket_id" id="status_tiket" required>
                        <option value="">-- Pilih Status --</option>
                        @foreach ($data['status_tiket'] as $item)
                            <option value="{{ $item->id }}" data-name="{{ strtolower($item->name) }}">
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group-custom" id="field-teknisi-penerima" style="display: none;">
                    <label><i class='bx bx-transfer-alt text-muted'></i> Teknisi Penerima (Oper Shift)</label>
                    <select class="form-select form-custom-input" name="teknisi_penerima_id" id="teknisi_penerima_id">
                        <option value="">-- Pilih Teknisi Penerima --</option>
                        @foreach ($data['teknisi'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-user text-muted'></i> Nama Pelapor Staf</label>
                    <input type="text" class="form-control form-custom-input" name="nama_pelapor"
                        placeholder="Nama staf ruangan" required>
                </div>
                <div class="col-md-6 form-group-custom">
                    <label><i class='bx bx-edit-alt text-muted'></i> Keterangan Tindak Lanjut</label>
                    <input type="text" class="form-control form-custom-input" name="tindak_lanjut"
                        placeholder="Tindakan yang diambil (opsional)">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3 p-2 fw-bold"
                style="background-color: var(--primary-color); border:none;">Simpan Catatan Log</button>
        </form>
    </div>

    <script>
        document.getElementById('status_tiket').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const statusName = selectedOption.getAttribute('data-name');
            const fieldPenerima = document.getElementById('field-teknisi-penerima');
            const selectPenerima = document.getElementById('teknisi_penerima_id');

            // Cek apakah mengandung kata "oper" atau "shift"
            if (statusName && (statusName.includes('oper') || statusName.includes('shift'))) {
                fieldPenerima.style.display = 'block';
                selectPenerima.setAttribute('required', 'required');
            } else {
                fieldPenerima.style.display = 'none';
                selectPenerima.removeAttribute('required');
                selectPenerima.value = '';
            }
        });
    </script>
@endsection

@extends('layouts.admin')

@section('title', 'Registrasi Aset Baru')

@section('content')
    <div class="card-custom p-4">
        <h4 class="fw-bold mb-4" style="color: #2b3a4a;"><i class='bx bx-plus-circle text-primary me-2'></i>Registrasi
            Parameter Aset Perangkat</h4>

        <form action="/asset/store" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 form-group-custom">
                    <label>Kode Inventaris Aset</label>
                    <input type="text" class="form-control form-custom-input fw-bold text-uppercase" name="kode_aset"
                        placeholder="Contoh: AST-IT-001" required>
                </div>
                <div class="col-md-8 form-group-custom">
                    <label>Nama Identifikasi Perangkat</label>
                    <input type="text" class="form-control form-custom-input" name="nama_perangkat"
                        placeholder="Contoh: PC Kasir Rawat Inap / Printer Cetak Gelang" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label>Nama Unit / Ruangan Lokasi</label>
                    <select class="form-select form-custom-input" name="unit_id" required>
                        <option value="">-- Pilih Unit Penempatan --</option>
                        @foreach ($data['unit'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group-custom">
                    <label>Jenis Perangkat IT</label>
                    <select class="form-select form-custom-input" name="jenis_perangkat_id" required>
                        <option value="">-- Pilih Jenis Perangkat --</option>
                        @foreach ($data['jenis_perangkat'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label>Merek / Model / Tipe Aset</label>
                    <input type="text" class="form-control form-custom-input" name="merk"
                        placeholder="Contoh: Epson L3210 / Lenovo IdeaCentre" required>
                </div>
                <div class="col-md-6 form-group-custom">
                    <label>Serial Number (S/N)</label>
                    <input type="text" class="form-control form-custom-input" name="serial_number"
                        placeholder="Contoh: SN-12345XXXX (Tulis '-' jika tidak ada)">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label>MAC Address</label>
                    <input type="text" class="form-control form-custom-input" name="mac_address"
                        placeholder="Contoh: AA:BB:CC:DD:EE:FF (Opsional)">
                </div>
                <div class="col-md-6 form-group-custom">
                    <label>IP Address</label>
                    <input type="text" class="form-control form-custom-input" name="ip_address"
                        placeholder="Contoh: 192.168.x.x (Opsional)">
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group-custom">
                    <label>Spesifikasi Hardware Singkat</label>
                    <input type="text" class="form-control form-custom-input" name="spesifikasi"
                        placeholder="Contoh: Core i3, RAM 8GB, SSD 256GB (Opsional)">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 form-group-custom">
                    <label class="text-danger fw-bold">Kondisi Perangkat Saat Ini</label>
                    <select class="form-select form-custom-input" name="kondisi_id" required>
                        <option value="">-- Pilih Kondisi Perangkat --</option>
                        @foreach ($data['kondisi'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 border-top pt-3">
                <a href="/asset" class="btn btn-light border px-4">Batal</a>
                <button type="submit" class="btn btn-primary px-4" style="background-color: #0d6efd; border:none;">Simpan
                    Data Perangkat</button>
            </div>
        </form>
    </div>
@endsection

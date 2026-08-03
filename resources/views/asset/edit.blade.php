@extends('layouts.admin')

@section('title', 'Edit Aset Perangkat')

@section('content')
    <div class="card-custom p-4">
        <h4 class="fw-bold mb-4" style="color: #2b3a4a;"><i class='bx bx-edit text-warning me-2'></i>Edit Parameter Aset
            Perangkat</h4>

        <form action="/asset/{{ $asset->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4 form-group-custom">
                    <label>Kode Inventaris Aset</label>
                    <input type="text" class="form-control form-custom-input fw-bold text-uppercase" name="kode_aset"
                        value="{{ $asset->kode_aset }}" required>
                </div>
                <div class="col-md-8 form-group-custom">
                    <label>Nama Identifikasi Perangkat</label>
                    <input type="text" class="form-control form-custom-input" name="nama_perangkat"
                        value="{{ $asset->nama_perangkat }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label>Nama Unit / Ruangan Lokasi</label>
                    <select class="form-select form-custom-input" name="unit_id" required>
                        @foreach ($data['unit'] as $item)
                            <option value="{{ $item->id }}" {{ $asset->unit_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group-custom">
                    <label>Jenis Perangkat IT</label>
                    <select class="form-select form-custom-input" name="jenis_perangkat_id" required>
                        @foreach ($data['jenis_perangkat'] as $item)
                            <option value="{{ $item->id }}"
                                {{ $asset->jenis_perangkat_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label>Merek / Model / Tipe Aset</label>
                    <input type="text" class="form-control form-custom-input" name="merk" value="{{ $asset->merk }}"
                        required>
                </div>
                <div class="col-md-6 form-group-custom">
                    <label>Serial Number (S/N)</label>
                    <input type="text" class="form-control form-custom-input" name="serial_number"
                        value="{{ $asset->serial_number }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group-custom">
                    <label>MAC Address</label>
                    <input type="text" class="form-control form-custom-input" name="mac_address"
                        value="{{ $asset->mac_address }}">
                </div>
                <div class="col-md-6 form-group-custom">
                    <label>IP Address</label>
                    <input type="text" class="form-control form-custom-input" name="ip_address"
                        value="{{ $asset->ip_address }}">
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group-custom">
                    <label>Spesifikasi Hardware Singkat</label>
                    <input type="text" class="form-control form-custom-input" name="spesifikasi"
                        value="{{ $asset->spesifikasi }}">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 form-group-custom">
                    <label class="text-danger fw-bold">Kondisi Perangkat Saat Ini</label>
                    <select class="form-select form-custom-input" name="kondisi_id" required>
                        @foreach ($data['kondisi'] as $item)
                            <option value="{{ $item->id }}" {{ $asset->kondisi_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 border-top pt-3">
                <a href="/asset" class="btn btn-light border px-4">Batal</a>
                <button type="submit" class="btn btn-warning px-4 text-dark fw-bold" style="border:none;">Perbarui Data
                    Perangkat</button>
            </div>
        </form>
    </div>
@endsection

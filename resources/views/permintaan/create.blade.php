<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Permintaan Perubahan</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logoit.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-card {
            max-width: 700px;
            margin: 2rem auto;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: #fff;
        }

        .header-section {
            border-bottom: 1px solid #eee;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .icon-box {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 15px;
            border-radius: 50%;
            font-size: 24px;
        }

        .info-box {
            background: #f0f7ff;
            border: 1px solid #d1e7ff;
            color: #084298;
            padding: 15px;
            border-radius: 6px;
            margin: 20px;
            font-size: 0.9rem;
        }

        .upload-area {
            border: 2px dashed #ccc;
            padding: 40px;
            text-align: center;
            border-radius: 8px;
            color: #666;
            cursor: pointer;
        }

        .btn-submit {
            background-color: #008744;
            color: white;
        }
    </style>
</head>

<body class="bg-light">

    <div class="form-card shadow-sm">
        <div class="header-section">
            <div class="d-flex align-items-center">
                <div class="icon-box me-3">🧪</div>
                <div>
                    <h4 class="fw-bold mb-0">Form Permintaan Perubahan</h4>
                    <small class="text-muted">Kategori Pelaporan IT: <span class="text-success fw-bold">Sistem / Nuha</span></small>
                </div>
            </div>
            <small class="text-muted">Format: Form Permintaan Perubahan RSMH.docx</small>
        </div>

        <form action="/form-permintaan/store" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf

            {{-- ALERT NOTIFIKASI BERHASIL SIMPAN --}}
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- ALERT UTAMA KETIKA ADA INPUT YANG GAGAL / VALIDASI GAGAL --}}
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                <strong>Gagal!</strong> Terdapat beberapa kesalahan atau format input yang tidak sesuai. Silakan periksa kembali form di bawah.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="info-box">
                <strong>Informasi Pemohon</strong><br>
                Silakan isi identitas unit atau pemohon dengan lengkap. Kolom dengan tanda bintang (<span class="text-danger">*</span>) wajib diisi.
            </div>

            <div class="row px-3">
                {{-- Shift Kerja --}}
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Pilih Shift Kerja <span class="text-danger">*</span></label>
                    <select name="shift_id" class="form-select @error('shift_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Shift --</option>
                        @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}" {{ old('shift_id') == $shift->id ? 'selected' : '' }}>
                            {{ $shift->name }}
                        </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Pagi (07:00-14:00), Siang (14:00-21:00), Malam (21:00-07:00)</small>
                    @error('shift_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama Pemohon --}}
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Nama Pemohon <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pemohon" class="form-control @error('nama_pemohon') is-invalid @enderror" value="{{ old('nama_pemohon') }}" required>
                    @error('nama_pemohon')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bagian / Unit --}}
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Bagian / Unit <span class="text-danger">*</span></label>
                    <select name="unit_id" class="form-select @error('unit_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Unit --</option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('unit_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NIP --}}
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">NIP (Nomor Induk Pegawai)</label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}">
                    @error('nip')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nomor EXT / Telepon Internal --}}
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Nomor EXT / Telepon Internal</label>
                    <input type="text" name="nomor_ext" class="form-control @error('nomor_ext') is-invalid @enderror" placeholder="Contoh: 104" value="{{ old('nomor_ext') }}">
                    @error('nomor_ext')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- No. RM Pasien & Nama Pasien --}}
            <div class="px-3 mb-3">
                <label class="fw-bold">No. RM Pasien & Nama Pasien <small class="text-muted fw-normal">(Kosongkan jika tidak terkait data pasien)</small></label>
                <input type="text" name="data_pasien" class="form-control @error('data_pasien') is-invalid @enderror" placeholder="Contoh: 00-12-34-56 / Tn. Ahmad" value="{{ old('data_pasien') }}">
                @error('data_pasien')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis Permintaan --}}
            <div class="px-3 mb-3">
                <label class="fw-bold">Jenis Permintaan <span class="text-danger">*</span></label>
                <select name="jenis_permintaan_id" class="form-select @error('jenis_permintaan_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Jenis Permintaan --</option>
                    @foreach ($jenisPermintaan as $item)
                    <option value="{{ $item->id }}" {{ old('jenis_permintaan_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>
                @error('jenis_permintaan_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Uraian Alasan Perubahan --}}
            <div class="px-3 mb-3">
                <label class="fw-bold">Uraian Alasan Perubahan <span class="text-danger">*</span></label>
                <textarea name="uraian_alasan" class="form-control @error('uraian_alasan') is-invalid @enderror" rows="4" placeholder="Jelaskan secara detail perubahan data/sistem yang diinginkan beserta alasannya..." required>{{ old('uraian_alasan') }}</textarea>
                @error('uraian_alasan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Upload Screenshot / Bukti Dukung --}}
            <div class="px-3 mb-3">
                <label class="fw-bold">Upload Screenshot / Bukti Dukung <small class="text-muted fw-normal">(Opsional, Maks: 2MB, Format: jpeg, png, jpg)</small></label>
                <div class="upload-area mt-2 @error('bukti_dukung') border-danger @enderror" onclick="document.getElementById('fileInput').click()">
                    🖼️<br><strong>Pilih file gambar</strong><br><small>PNG, JPG, JPEG maks 2MB</small>
                    <input type="file" name="bukti_dukung" id="fileInput" class="d-none">
                </div>
                @error('bukti_dukung')
                <div class="text-danger mt-1" style="font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end px-3 mt-4">
                <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                <button type="submit" class="btn btn-submit px-4">Kirim Request Ke IT</button>
            </div>
        </form>
    </div>

    <!-- Script Bootstrap JS (diperlukan untuk tombol close alert) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
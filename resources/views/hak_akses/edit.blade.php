<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Permintaan Hak Akses</title>
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
        }

        .icon-box {
            background: #fff3e0;
            color: #e65100;
            padding: 15px;
            border-radius: 50%;
            font-size: 24px;
            margin-right: 15px;
        }

        .info-box {
            background: #fff8e1;
            border: 1px solid #ffe0b2;
            color: #663c00;
            padding: 15px;
            border-radius: 6px;
            margin: 20px;
            font-size: 0.9rem;
        }

        .btn-submit {
            background-color: #e65100;
            color: white;
        }
    </style>
</head>

<body class="bg-light">

    <div class="form-card shadow-sm">
        <div class="header-section">
            <div class="d-flex align-items-center">
                <img src="{{ asset('image/logo-nuha.png') }}" alt="Logo" style="width: 60px; margin-right: 15px;">
                <div>
                    <h4 class="fw-bold mb-0">Edit Permintaan Hak Akses</h4>
                    <small class="text-muted">ID Permintaan: #{{ $item->id }}</small>
                </div>
            </div>
        </div>

        <form action="{{ route('hak-akses.update', $item->id) }}" method="POST" class="p-4">
            @csrf
            @method('PUT')

            <div class="info-box">
                <strong>Edit Data Personal</strong><br>
                Silakan perbarui informasi yang diperlukan.
            </div>

            <!-- Identitas Utama -->
            <div class="row px-3">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control"
                        value="{{ old('nama_lengkap', $item->nama_lengkap) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">NIK Penduduk <span class="text-danger">*</span></label>
                    <input type="text" name="nik_penduduk" class="form-control"
                        value="{{ old('nik_penduduk', $item->nik_penduduk) }}" required>
                </div>
            </div>

            <div class="row px-3">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control"
                        value="{{ old('tempat_lahir', $item->tempat_lahir) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control"
                        value="{{ old('tanggal_lahir', $item->tanggal_lahir ? $item->tanggal_lahir->format('Y-m-d') : '') }}"
                        required>
                </div>
            </div>

            <div class="row px-3">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Unit / Bagian <span class="text-danger">*</span></label>
                    <input type="text" name="unit" class="form-control" value="{{ old('unit', $item->unit) }}"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Pendidikan <span class="text-danger">*</span></label>
                    <input type="text" name="pendidikan" class="form-control"
                        value="{{ old('pendidikan', $item->pendidikan) }}" required>
                </div>
            </div>

            <div class="row px-3">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Lulusan <span class="text-danger">*</span></label>
                    <input type="text" name="lulusan" class="form-control"
                        value="{{ old('lulusan', $item->lulusan) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $item->email) }}"
                        required>
                </div>
            </div>

            <!-- STR, SIP, NIP -->
            <div class="row px-3">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">No. STR <span class="text-danger">*</span></label>
                    <input type="text" name="no_str" class="form-control"
                        value="{{ old('no_str', $item->no_str) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tgl Terbit STR <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_terbit_str" class="form-control"
                        value="{{ old('tgl_terbit_str', $item->tgl_terbit_str ? $item->tgl_terbit_str->format('Y-m-d') : '') }}"
                        required>
                </div>
            </div>

            <div class="row px-3">
                <div class="col-md-4 mb-3">
                    <label class="fw-bold">No. SIP</label>
                    <input type="text" name="no_sip" class="form-control"
                        value="{{ old('no_sip', $item->no_sip) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="fw-bold">Tgl Terbit SIP</label>
                    <input type="date" name="tgl_terbit_sip" class="form-control"
                        value="{{ old('tgl_terbit_sip', $item->tgl_terbit_sip ? $item->tgl_terbit_sip->format('Y-m-d') : '') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="fw-bold">NIP</label>
                    <input type="text" name="nip" class="form-control" value="{{ old('nip', $item->nip) }}">
                </div>
            </div>

            <div class="px-3 mb-3">
                <label class="fw-bold">HP / WhatsApp <span class="text-danger">*</span></label>
                <input type="text" name="hp_whatsapp" class="form-control"
                    value="{{ old('hp_whatsapp', $item->hp_whatsapp) }}" required>
            </div>

            <div class="px-3 mb-3">
                <label class="fw-bold">Alamat KTP <span class="text-danger">*</span></label>
                <textarea name="alamat_ktp" class="form-control" rows="2" required>{{ old('alamat_ktp', $item->alamat_ktp) }}</textarea>
            </div>

            <div class="d-flex justify-content-end px-3 mt-4">
                <a href="{{ route('hak-akses.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-submit px-4">Update Permintaan</button>
            </div>
        </form>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Permintaan Hak Akses</title>
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
            background: #e8f5e9;
            color: #2e7d32;
            padding: 15px;
            border-radius: 50%;
            font-size: 24px;
            margin-right: 15px;
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

        .btn-submit {
            background-color: #008744;
            color: white;
        }
    </style>
</head>

<body class="bg-light">

    <div class="form-card shadow-sm">
        <!-- Bagian Header yang diperbarui -->
        <div class="header-section">
            <div class="d-flex align-items-center">
                <!-- Tambahkan gambar logo di sini -->
                <img src="{{ asset('image/logo-nuha.png') }}" alt="Logo Nuha"
                    style="width: 60px; height: auto; margin-right: 15px;">
                <div>
                    <h4 class="fw-bold mb-0">Form Permintaan Hak Akses</h4>
                    <small class="text-muted">Kategori: <span class="text-success fw-bold">Administrasi
                            IT</span></small>
                </div>
            </div>
        </div>

        <form action="{{ route('hak-akses.store') }}" method="POST" class="p-4">
            @csrf

            {{-- Notifikasi berhasil di simpan --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Notifikasi gagal di simpan --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="info-box">
                <strong>Data Personal</strong><br>
                Silakan isi identitas diri dengan lengkap sesuai dengan KTP/STR/SIP.
            </div>

            <!-- Identitas Utama -->
            <div class="row px-3">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">NIK Penduduk <span class="text-danger">*</span></label>
                    <input type="text" name="nik_penduduk" class="form-control" required>
                </div>
            </div>

            <div class="row px-3">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
            </div>

            <!-- Pendidikan & Unit -->
            <div class="row px-3">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Unit / Bagian <span class="text-danger">*</span></label>
                    <input type="text" name="unit" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Pendidikan <span class="text-danger">*</span></label>
                    <input type="text" name="pendidikan" class="form-control" required>
                </div>
            </div>

            <div class="row px-3">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Lulusan <span class="text-danger">*</span></label>
                    <input type="text" name="lulusan" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>

            <!-- STR, SIP, NIP -->
            <div class="row px-3">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">No. STR <span class="text-danger">*</span></label>
                    <input type="text" name="no_str" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Tgl Terbit STR <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_terbit_str" class="form-control" required>
                </div>
            </div>

            <div class="row px-3">
                <div class="col-md-4 mb-3">
                    <label class="fw-bold">No. SIP <span class="text-danger">*</span></label>
                    <input type="text" name="no_sip" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="fw-bold">Tgl Terbit SIP <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_terbit_sip" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="fw-bold">NIP <span class="text-danger">*</span></label>
                    <input type="text" name="nip" class="form-control" required>
                </div>
            </div>

            <!-- Kontak & Alamat -->
            <div class="px-3 mb-3">
                <label class="fw-bold">HP / WhatsApp <span class="text-danger">*</span></label>
                <input type="text" name="hp_whatsapp" class="form-control" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="px-3 mb-3">
                <label class="fw-bold">Alamat KTP <span class="text-danger">*</span></label>
                <textarea name="alamat_ktp" class="form-control" rows="2" required></textarea>
            </div>

            <div class="d-flex justify-content-end px-3 mt-4">
                <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                <button type="submit" class="btn btn-submit px-4">Kirim Permintaan</button>
            </div>
        </form>
    </div>

</body>

</html>

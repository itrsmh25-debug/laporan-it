@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="form-card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h4 class="fw-bold m-0"><i class='bx bx-id-card'></i> Detail Permintaan Hak Akses</h4>
                <a href="{{ route('hak-akses.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Lengkap:</strong><br>{{ $item->nama_lengkap }}</p>
                    <p><strong>NIK:</strong><br>{{ $item->nik_penduduk }}</p>
                    <p><strong>Unit:</strong><br>{{ $item->unit }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Email:</strong><br>{{ $item->email }}</p>
                    <p><strong>Pendidikan/Lulusan:</strong><br>{{ $item->pendidikan }} / {{ $item->lulusan }}</p>
                    <p><strong>HP/WhatsApp:</strong><br>{{ $item->hp_whatsapp }}</p>
                </div>
            </div>

            <div class="border-top pt-3 mt-3">
                <p><strong>No. STR:</strong> {{ $item->no_str }} (Tgl Terbit: {{ $item->tgl_terbit_str->format('d-m-Y') }})
                </p>
                <p><strong>No. SIP:</strong> {{ $item->no_sip ?? '-' }} (Tgl Terbit:
                    {{ $item->tgl_terbit_sip ? $item->tgl_terbit_sip->format('d-m-Y') : '-' }})</p>
                <p><strong>Alamat KTP:</strong><br>{{ $item->alamat_ktp }}</p>
            </div>
        </div>
    </div>
@endsection

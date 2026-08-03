@extends('layouts.admin')
@section('content')
    <div class="card-custom bg-white p-4">
        <h5 class="fw-bold mb-4">Workspace Laporan Bulanan</h5>
        <form action="{{ route('laporan.preview') }}" method="POST" target="_blank">
            @csrf
            <input type="hidden" name="bulan" value="{{ $bulan }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <div class="tab-content border p-3 bg-light">
                <div class="tab-pane fade show active" id="tab-bab5">
                    <label>Koordinator IT</label>
                    <input type="text" name="nama_koordinator" class="form-control mb-3"
                        value="Muhamad Fikri Romadhon, S.Kom.">
                    <label>Narasi Evaluasi</label>
                    <textarea name="bab2_evaluasi" class="form-control" rows="5">Berdasarkan evaluasi bulan {{ $bulan }}, sistem berjalan optimal dengan total {{ $totalCase }} kasus.</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">Preview & Cetak</button>
        </form>
    </div>
@endsection

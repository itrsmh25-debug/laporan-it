@extends('layouts.admin')
@section('title', 'Input Jadwal')

@section('content')
    <div class="container-fluid">
        <form action="/schedules/store" method="POST">
            @csrf
            <div class="card-custom table-responsive">
                <h5 class="mb-3">Form Input Jadwal Massal</h5>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Teknisi</th>
                            @foreach ($period as $date)
                                <th style="min-width: 40px;">{{ $date->format('d') }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teknisiList as $t)
                            <tr>
                                <td class="fw-bold">{{ $t->name }}</td>
                                @foreach ($period as $date)
                                    <td>
                                        <input type="text"
                                            name="schedules[{{ $t->id }}][{{ $date->format('Y-m-d') }}]"
                                            class="form-control form-control-sm text-center" maxlength="2"
                                            style="width:40px;">
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mt-3">Simpan Semua Jadwal</button>
            </div>
        </form>
    </div>
@endsection

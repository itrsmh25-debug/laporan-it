@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="card-custom">
            <h5>Tambah User Baru</h5>
            <form action="/users/store" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4"><input type="text" name="name" class="form-control form-custom-input"
                            placeholder="Nama Lengkap" required></div>
                    <div class="col-md-3"><input type="email" name="email" class="form-control form-custom-input"
                            placeholder="Email" required></div>
                    <div class="col-md-3"><input type="password" name="password" class="form-control form-custom-input"
                            placeholder="Password" required></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-primary w-100">Simpan</button></div>
                </div>
            </form>
        </div>

        <div class="card-custom">
            <h5>Daftar User</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form id="delete-form-{{ $user->id }}" action="/users/{{ $user->id }}"
                                    method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete-global"
                                        data-form-id="delete-form-{{ $user->id }}">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

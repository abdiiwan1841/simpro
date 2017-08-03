@extends('layouts.app')

@section('title')
    Lihat Profil
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Lihat Profil</div>

        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>E-Mail</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $user->alamat }}</td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td>{{ $user->telepon }}</td>
                </tr>
                {{--<tr>--}}
                    {{--<th>Hak Akses</th>--}}
                    {{--<td>{{ $user->jabatan->nama_jabatan }}</td>--}}
                {{--</tr>--}}
            </table>
            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-warning">Ubah Profil</a>
            <a href="{{ route('user.update_password', ['id' => $user->id]) }}" class="btn btn-default pull-right">Ubah Password</a>
        </div>
    </div>
@endsection
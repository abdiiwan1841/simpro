@extends('layouts.app')

@section('title')
    Ubah Profil
@endsection

@section('navbar')
    @if(\Illuminate\Support\Facades\Auth::user()->jabatan_id == '1')
        <li><a href="{{ route('user.manajemen') }}">Manajemen User</a></li>
    @endif
    <li><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Ubah Profil</div>

        <div class="panel-body">
            {{ Form::model($user, ['method' => 'PATCH', 'route' => ['kadiv.update', $user->id]]) }}

            <div class="form-group">
                {{ Form::label('name', 'Nama', ['class' => 'control-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'E-Mail', ['class' => 'control-label']) }}
                {{ Form::text('email', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('alamat', 'Alamat', ['class' => 'control-label']) }}
                {{ Form::text('alamat', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('telepon', 'Alamat', ['class' => 'control-label']) }}
                {{ Form::text('telepon', null, ['class' => 'form-control']) }}
            </div>

            {{ Form::submit('Simpan Perubahan', ['class' => 'btn btn-success']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
@extends('layouts.pegawai')

@section('title')
    Home
    @endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard – Pegawai</div>

        <div class="panel-body">
            You are logged in!<br><br>
            <a href="{{ route('proyek.index') }}" class="btn btn-default btn-block">View Project</a>
        </div>
    </div>

@endsection

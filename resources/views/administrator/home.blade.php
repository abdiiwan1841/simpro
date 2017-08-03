@extends('layouts.administrator')

@section('title')
    Home
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard – Administrator</div>

        <div class="panel-body">
            You are logged in!<br><br>
            <a href="{{ route('user.create') }}" class="btn btn-default btn-block">Register User</a><br>
            <a href="{{ route('proyek.index') }}" class="btn btn-info btn-block">Lihat Proyek</a>
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('title')
    {{ $deskripsi->nama_kegiatan }}
@endsection

@section('content')
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>{{ $deskripsi->nama_kegiatan }}</h3>
                <hr>
                <h5>Deskripsi Proyek:</h5>
                <p>{{ $deskripsi->deskripsi_kegiatan }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>Kepala Proyek</th>
                        <td>{{ $deskripsi->name }}</td>
                    </tr>
                    <tr>
                        <th>Kode Proyek</th>
                        <td>{{ $kode }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td>{{ date('d F, Y', strtotime($deskripsi->tanggal_mulai)) }}</td>
                    </tr>
                    <tr>
                        <th>Target Selesai</th>
                        <td>{{ date('d F, Y', strtotime($deskripsi->tanggal_target_selesai)) }}</td>
                    </tr>
                    @if($deskripsi->tanggal_realisasi != '0000-00-00')
                        <tr>
                            <th>Tanggal Realisasi</th>
                            <td>{{ date('d F, Y', strtotime($deskripsi->tanggal_realisasi)) }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#progress"><span class="glyphicon glyphicon-stats"></span> Progress</a></li>
                    <li><a data-toggle="tab" href="#anggota"><span class="glyphicon glyphicon-user"></span> PIC</a></li>
                    <li><a data-toggle="tab" href="#upload"><span class="glyphicon glyphicon-upload"></span> Upload</a></li>
                    <li><a data-toggle="tab" href="#download"><span class="glyphicon glyphicon-paperclip"></span> Dokumen</a></li>
                </ul>

                <div class="tab-content">
                    <div id="progress" class="tab-pane fade in active">

                        <h3>Status Aktivitas</h3>
                        <br>
                        <div class="col-lg-3">
                            <div class="panel-heading" style="background-color: #00C4FB; color: white">
                                To-Do
                            </div>
                            <br>
                            @foreach($barus as $baru)
                                <div class="panel panel-default">

                                    <div class="panel-body left-border-blue">
                                        {{ $baru->nama_tugas }}
                                        <br>
                                        <br>
                                        <ul class="list-unstyled">
                                            <li class="pull-right"><a href="{{ route('proyek_tugas.kerjakan', $baru->id) }}" data-toggle="tooltip" title="Kerjakan"><span class="glyphicon glyphicon-arrow-right"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-footer left-border-blue clearfix">
                                        <li class="dropdown list-unstyled pull-right"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-option-horizontal"></span></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="{{ route('proyek_tugas.destroy', $baru->id) }}" onclick="return confirm('Hapus tugas?')">Hapus</a></li>
                                            </ul>
                                        </li>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-3">
                            <div class="panel-heading" style="background-color: #A62CA6; color: white">
                                In-Progress
                            </div>
                            <br>
                            @foreach($ongoings as $ongoing)
                                <div class="panel panel-default">
                                    <div class="panel-body left-border-purple">
                                        {{ $ongoing->nama_tugas }}
                                        <br>
                                        <br>
                                        <ul class="list-unstyled">
                                            <li class="pull-right"><a href="{{ route('proyek_tugas.pindah_kanan', $ongoing->id) }}" data-toggle="tooltip" title="Pindah ke Request Selesai"><span class="glyphicon glyphicon-ok" style="padding-left: 5px"></span> </a></li>
                                            <li class="pull-left"><a href="{{ route('proyek_tugas.pindah_kiri', $ongoing->id) }}" data-toggle="tooltip" title="Kembalikan ke To Do"><span class="glyphicon glyphicon-ban-circle"></span> </a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-footer left-border-purple clearfix">
                                        <li class="dropdown list-unstyled pull-right"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-option-horizontal"></span></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="{{ route('proyek_tugas.destroy', $ongoing->id) }}" onclick="return confirm('Hapus tugas?')">Hapus</a></li>
                                            </ul>
                                        </li>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-3">
                            <div class="panel-heading" style="background-color: #FDAA00; color: white">
                                Request Selesai
                            </div>
                            <br>
                            @foreach($requests as $request)
                                <div class="panel panel-default">
                                    <div class="panel-body left-border-orange">
                                        {{ $request->nama_tugas }}
                                        <br>
                                        <br>
                                        <ul class="list-unstyled">
                                            <li class="pull-right"><a href="{{ route('proyek_tugas.pindah_kanan', $request->id) }}" data-toggle="tooltip" title="Setujui Selesai"><span class="glyphicon glyphicon-ok" style="padding-left: 5px"></span> </a></li>
                                            <li class="pull-left"><a href="{{ route('proyek_tugas.pindah_kiri', $request->id) }}" data-toggle="tooltip" title="Tolak"><span class="glyphicon glyphicon-ban-circle"></span> </a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-footer left-border-orange clearfix">
                                        <li class="dropdown list-unstyled pull-right"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-option-horizontal"></span></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="{{ route('proyek_tugas.destroy', $request->id) }}" onclick="return confirm('Hapus tugas?')">Hapus</a></li>
                                            </ul>
                                        </li>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-3">
                            <div class="panel-heading" style="background-color: #75D900; color: white">
                                Selesai
                            </div>
                            <br>
                            @foreach($selesais as $selesai)
                                <div class="panel panel-default">
                                    <div class="panel-body left-border-green">
                                        {{ $selesai->nama_tugas }}
                                        <br>
                                        <br>
                                        <ul class="list-unstyled">
                                            <li class="pull-left"><a href="{{ route('proyek_tugas.pindah_kiri', $selesai->id) }}" data-toggle="tooltip" title="Kembalikan ke Request Selesai" onclick="return confirm('Kembalikan ke In-Progress?')"><span class="glyphicon glyphicon-ban-circle"></span> </a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-footer left-border-green clearfix">
                                        <li class="dropdown list-unstyled pull-right"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-option-horizontal"></span></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="{{ route('proyek_tugas.destroy', $selesai->id) }}" onclick="return confirm('Hapus tugas?')">Hapus</a></li>
                                            </ul>
                                        </li>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="anggota" class="tab-pane fade">
                        <br>
                        <h3>PIC</h3>
                        <br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>E-Mail</th>
                                <th>Telepon</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($anggotas as $anggota)
                                <tr>
                                    <td>{{ $anggota->id }}</td>
                                    <td>{{ $anggota->name }}</td>
                                    <td>{{ $anggota->email }}</td>
                                    <td>{{ $anggota->telepon }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $anggotas->links() }}
                    </div>

                    <div id="upload" class="tab-pane fade">
                        <br>
                        <h3>Upload File</h3>
                        <br>
                        {{ Form::open(['route' => 'dokumen.store', 'files' => 'true']) }}

                        <div class="form-group hidden">
                            {{ Form::text('kode_proyek', $kode, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('nama_dokumen', 'Nama Dokumen', ['class' => 'control-label']) }}
                            {{ Form::text('nama_dokumen', null, ['class' => 'form-control']) }}
                        </div>

                        <br>

                        <div class="form-group">
                            {{ Form::label(null, 'Pilih Dokumen', ['class' => 'control-label']) }}
                            {{ Form::file('dokumen') }}
                        </div>

                        <br>

                        {{ Form::submit('Upload', ['class' => 'btn btn-default']) }}
                        {{ Form::close() }}
                    </div>

                    <div id="download" class="tab-pane fade">
                        <br>
                        <h3>Dokumen</h3>
                        <br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Dokumen</th>
                                <th>Uploader</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dokumens as $dokumen)
                                <tr>
                                    <td>{{ date('d F, Y', strtotime($dokumen->created_at)) }}</td>
                                    <td>{{ $dokumen->nama_dokumen }}</td>
                                    <td>{{ $dokumen->name }}</td>
                                    <td>
                                        <a onclick="return confirm('Hapus dokumen dari proyek?')" href="{{ route('dokumen.destroy', [$dokumen->id, $kode]) }}" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="{{ route('dokumen.download', [$dokumen->id, $kode]) }}" class="btn btn-default pull-right"><span class="glyphicon glyphicon-save-file"></span> Download</a>
                                    </td>
                                </tr>
                            @endforeach
                            {{ $dokumens->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection()
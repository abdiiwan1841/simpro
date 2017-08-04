@extends('layouts.app')

@section('title')
    Proyek - Progress
@endsection

@section('content')
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>{{ $deskripsi->nama_proyek }}</h3>
                <hr>
                <h5>Deskripsi Proyek:</h5>
                <p>{{ $deskripsi->deskripsi_proyek }}</p>
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
                <h3><span class="glyphicon glyphicon-stats"></span> Perkembangan Proyek:</h3>
                @if($progress > 70)
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="{{ $progress }}"
                             aria-valuemin="0" aria-valuemax="100" style="width:{{ $progress }}%">
                            {{ $progress }}%
                        </div>
                    </div>
                @elseif(($progress > 30) && ($progress < 71))
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="{{ $progress }}"
                             aria-valuemin="0" aria-valuemax="100" style="width:{{ $progress }}%">
                            {{ $progress }}%
                        </div>
                    </div>
                @else
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="{{ $progress }}"
                             aria-valuemin="0" aria-valuemax="100" style="width:{{ $progress }}%">
                            {{ $progress }}%
                        </div>
                    </div>
                @endif

                <br>

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#progress"><span class="glyphicon glyphicon-stats"></span> Progress</a></li>
                    <li><a data-toggle="tab" href="#anggota"><span class="glyphicon glyphicon-user"></span> Anggota Proyek</a></li>
                    <li><a data-toggle="tab" href="#upload"><span class="glyphicon glyphicon-upload"></span> Upload</a></li>
                    <li><a data-toggle="tab" href="#download"><span class="glyphicon glyphicon-paperclip"></span> Dokumen</a></li>
                </ul>

                <div class="tab-content">
                    <div id="progress" class="tab-pane fade in active">
                        <br>
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#progress_baru"><span class="glyphicon glyphicon-plus"></span> Progress Baru</button>
                        <div id="progress_baru" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    {{ Form::open(['route' => 'proyek_progress.store']) }}
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Progress Proyek</h4>
                                    </div>
                                    <div class="modal-body">


                                        <div class="form-group{{ $errors->has('kode_proyek') ? ' has-error' : '' }} hidden">
                                            <label for="kode_proyek" class="col-md-4 control-label">Kode Proyek</label>

                                            <div class="col-md-6">
                                                <input id="kode_proyek" type="text" class="form-control" name="kode_proyek" value="{{ $kode }}" required>

                                                @if ($errors->has('kode_proyek'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('kode_proyek') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('kegiatan', 'Kegiatan', ['class' => 'control-label']) }}
                                            {{ Form::text('kegiatan', null, ['class' => 'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('keterangan', 'Keterangan', ['class' => 'control-label']) }}
                                            {{ Form::textarea('keterangan', null, ['class' => 'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('progress', 'Progress', ['class' => 'control-label']) }}
                                            {{ Form::text('progress', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{ Form::submit('Masukkan Progress', ['class' => 'btn btn-primary']) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h3>Update Terbaru</h3>
                        <br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Pegawai</th>
                                <th>Kegiatan</th>
                                <th>Progress</th>
                                <th>Ubah Presentase Progress</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($proyeks as $proyek)
                                @if($proyek->progress > '70')
                                    <tr class="success">
                                        <td>{{ date('d F, Y', strtotime($proyek->created_at)) }}</td>
                                        <td>{{ $proyek->name }}</td>
                                        <td>{{ $proyek->kegiatan }}</td>
                                        <td>{{ $proyek->progress }}%</td>
                                        <td>
                                            <a href="{{ route('proyek_progress.edit', ['id' => $proyek->id]) }}" class="btn btn-warning pull-right"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                                        </td>
                                    </tr>
                                @elseif(($proyek->progress > 30) && ($proyek->progress < 70))
                                    <tr class="warning">
                                        <td>{{ date('d F, Y', strtotime($proyek->created_at)) }}</td>
                                        <td>{{ $proyek->name }}</td>
                                        <td>{{ $proyek->kegiatan }}</td>
                                        <td>{{ $proyek->progress }}%</td>
                                        <td>
                                            <a href="{{ route('proyek_progress.edit', ['id' => $proyek->id]) }}" class="btn btn-warning pull-right"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                                        </td>
                                    </tr>
                                @else
                                    <tr class="danger">
                                        <td>{{ date('d F, Y', strtotime($proyek->created_at)) }}</td>
                                        <td>{{ $proyek->name }}</td>
                                        <td>{{ $proyek->kegiatan }}</td>
                                        <td>{{ $proyek->progress }}%</td>
                                        <td>
                                            <a href="{{ route('proyek_progress.edit', ['id' => $proyek->id]) }}" class="btn btn-warning pull-right"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                        {{ $proyeks->links() }}
                    </div>
                    <div id="anggota" class="tab-pane fade">
                        <br>
                        <h3>Anggota Proyek</h3>
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
                                    @if($dokumen->id_pegawai == \Illuminate\Support\Facades\Auth::id())
                                        <td>
                                            <a onclick="return confirm('Hapus dokumen dari proyek?')" href="{{ route('dokumen.destroy', [$dokumen->id, $kode]) }}" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-trash"></span></a>
                                            <a href="{{ route('dokumen.download', [$dokumen->id, $kode]) }}" class="btn btn-default pull-right"><span class="glyphicon glyphicon-save-file"></span> Download</a>
                                        </td>
                                        @else
                                        <td>
                                            <a class="disabled btn btn-danger pull-right" data-toggle="tooltip" title="Anda bukan pemilik dokumen ini"><span class="glyphicon glyphicon-trash"></span></a>
                                            <a href="{{ route('dokumen.download', [$dokumen->id, $kode]) }}" class="btn btn-default pull-right"><span class="glyphicon glyphicon-save-file"></span> Download</a>
                                        </td>
                                    @endif

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
    @endsection
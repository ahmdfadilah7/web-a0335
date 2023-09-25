@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Daftar Dosen Pembimbing</h2>
    <div class="row align-items-center">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif ($message = Session::get('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    There were some problems with your input. <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Auth::user()->role->title=='Koordinator')
                <a href="#" data-toggle="modal" data-target="#inputData" type="button" class="btn btn-primary mb-4"><i class="fa fa-plus"></i> Tambah Dosen Pembimbing</a>
            @endif
            <div class="table table-responsive">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Kuota</th>
                            <th>Prodi</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dosenpembimbing as $no => $value)
                            @php
                                $pengajuan = \App\Models\Pengajuanpembimbing::where('mahasiswa_id', Auth::user()->id)->where('dosen_id', $value->user_id);
                            @endphp
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $value->nim }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->kuota }}</td>
                            <td>{{ $value->title }}</td>
                            <td>
                                @if ($pengajuan->count() > 0)
                                    @if ($pengajuan->first()->status==0)
                                        <span class="badge badge-warning">Pengajuan</span>
                                    @elseif ($pengajuan->first()->status==1)
                                        <span class="badge badge-success">Diterima</span>
                                    @else
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                @endif
                                @if ($value->kuota == '0')
                                    <span class="badge badge-primary">Kuota Sudah Penuh</span>
                                @else
                                    @if (Auth::user()->role->title=='Mahasiswa')
                                        @if ($pengajuan->count() <= 0)
                                            {!! Form::open(['method' => 'post', 'route' => ['dosenpembimbing.pengajuan']]) !!}
                                                <input type="hidden" name="dosen_id" value="{{ $value->user_id }}">
                                                <button type="submit" class="btn btn-primary btn-sm">Ajukan</button>
                                            {!! Form::close() !!}
                                        @endif
                                    @endif
                                @endif
                                @if (Auth::user()->role->title=='Koordinator')
                                <button type="button" class="btn btn-danger btn-sm deleteData" value="{{ $value->id }}"><i class="dw dw-delete-3"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('dosenpembimbing.partials.modal')
@include('dosenpembimbing.partials.deleteModal')

@endsection

@include('layouts.partials.js')

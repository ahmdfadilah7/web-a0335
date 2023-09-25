@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Dokumen Tugas Akhir</h2>
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
            <div class="table table-responsive">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>File</th>
                            <th>Ekstensi</th>
                            <th>Prodi</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumen as $no => $value)
                            @php
                                $image = explode('.', $value->file);
                                $text = explode('/', $value->file);
                            @endphp
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $value->nim }}</td>
                            <td>{{ $value->nama_mahasiswa }}</td>
                            <td>{{ $text[1] }}</td>
                            <td>
                                @if ($image[1]=='pdf')
                                    <img src="{{ url('/images/icon-pdf.png') }}" style="width:50px;">
                                @elseif ($image[1]=='doc' || $image[1]=='docx')
                                    <img src="{{ url('/images/icon-word.png') }}" style="width:50px;">
                                @endif
                            </td>
                            <td>{{ $value->prodi }}</td>
                            <td>
                                <a href="{{ url($value->file) }}" target="_blank" class="btn btn-success btn-sm" title="Cetak"><i class="dw dw-print"></i></a>
                                <button type="button" class="btn btn-danger btn-sm deleteData" value="{{ $value->id }}"><i class="dw dw-delete-3"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('dokumen.partials.deleteModaltugas')

@endsection

@include('layouts.partials.js')

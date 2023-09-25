@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="card-box pd-20">
    @if(Request::segment(2)=='nilaita_2')
        <h2 class="h4 mb-20">Penilaian TA 2</h2>
    @else
        <h2 class="h4 mb-20">Penilaian TA 1</h2>
    @endif
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
                    <p>{{ $errors }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Auth::user()->role->title=='Koordinator')
                @if(Request::segment(2)=='nilaita_2')
                    <a
                        href="{{ route('penilaian.nilai_ta2') }}"
                        class="btn btn-primary"
                    >
                        <i class="micon ion ion-plus"></i>
                    </a>
                @else                    
                    <a
                        href="{{ route('penilaian.nilai') }}"
                        class="btn btn-primary"
                    >
                        <i class="micon ion ion-plus"></i>
                    </a>
                @endif
            @endif
            @if(Request::segment(2)=='nilaita_2')
                <a href="{{ route('penilaian.exportta_2') }}" class="btn btn-success"><i class="fa fa-download"></i> Export Excel</a>
                <a href="{{ route('penilaian.exportpdfta_2') }}" class="btn btn-danger"><i class="fa fa-download"></i> Export PDF</a>
            @else
                <a href="{{ route('penilaian.exportta_1') }}" class="btn btn-success"><i class="fa fa-download"></i> Export Excel</a>
                <a href="{{ route('penilaian.exportpdfta_1') }}" class="btn btn-danger"><i class="fa fa-download"></i> Export PDF</a>
            @endif
            <div class="table table-responsive mt-4">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Judul</th>
                            @if(Request::segment(2)=='nilaita_2')
                                <th>Nilai Pra Sidang</th>
                                <th>Nilai Sidang</th>                                
                            @else
                                <th>Nilai Seminar Proposal</th>
                                <th>Nilai Seminar</th>
                            @endif
                            <th>Nilai Pembimbing</th>
                            <th>Nilai Administrasi</th>
                            <th>Total</th>
                            <th>Grade</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penilaian as $no => $value)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>
                                    {{ $value->mahasiswa }}
                                </td>
                                <td>
                                    {{ $value->prodi }}
                                </td>
                                <td>
                                    {{ $value->tugas }}
                                </td>
                                <td>
                                    {{ $value->nilai_1 }}
                                </td>
                                <td>
                                    {{ $value->nilai_2 }}
                                </td>
                                <td>
                                    {{ $value->nilai_3 }}
                                </td>
                                <td>
                                    {{ $value->nilai_4 }}
                                </td>
                                <td>
                                    {{ $value->total_nilai }}
                                </td>
                                <td>
                                    {{ $value->grade }}
                                </td>
                                <td>
                                    @if(Request::segment(2)=='nilaita_2')
                                        <a href="{{ route('penilaian.detailnilai_ta2', $value->id) }}" class="btn btn-info btn-sm"><i class="dw dw-eye"></i></a>
                                    @else
                                        <a href="{{ route('penilaian.detailnilai', $value->id) }}" class="btn btn-info btn-sm"><i class="dw dw-eye"></i></a>
                                    @endif
                                    @if (Auth::user()->role->title=='Koordinator')
                                        <button type="button" class="btn btn-danger btn-sm deleteData" title="Hapus" value="{{ $value->id }}"><i class="dw dw-delete-3"></i></button>
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

@include('penilaian.partials.modal')
@include('penilaian.partials.deleteModal')

@endsection



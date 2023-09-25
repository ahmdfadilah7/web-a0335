@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Dokumen Tugas Akhir</h2>
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="table table-responsive">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tugasakhir</th>
                            <th>File</th>
                            <th>Tahun</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumen as $no => $value)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->nama_kelompok }}</td>
                            <td>{{ $value->tugasakhir->file }}</td>
                            <td>{{ date('Y', strtotime($value->tugasakhir->created_at)) }}</td>
                            <td>
                                <a href="{{ url($value->tugasakhir->file) }}" target="_blank" class="btn btn-outline-info btn-sm" title="Lihat"><i class="dw dw-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@include('layouts.partials.js')

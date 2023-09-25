@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Artefak Tugas Akhir</h2>
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="table table-responsive">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>Tugas</th>
                            <th>Dokumen</th>
                            <th>Kelompok</th>
                            <th>Tahun</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($artefak as $no => $value)
                            @php
                               $file = explode('/',$value->tugasakhir->file);
                            @endphp
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $value->judul }}</td>
                            <td>{{ $file[1] }}</td>
                            <td>
                                {{ $value->kelompok->name }}
                            </td>
                            <td>{{ $value->tahun }}</td>
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

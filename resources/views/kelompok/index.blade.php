@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Daftar Kelompok</h2>
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
            <a href="#" data-toggle="modal" data-target="#inputData" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kelompok</a>
            <div class="table table-responsive mt-4">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>Nama Kelompok</th>
                            <th>Prodi</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelompok as $no => $value)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->title }}</td>
                            <td>
                                <a href="{{ route('kelompok.show', $value->id) }}" class="btn btn-primary btn-sm">Anggota Kelompok</a>
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

@include('kelompok.partials.deleteModal')
@include('kelompok.partials.modal')

@endsection

@include('layouts.partials.js')

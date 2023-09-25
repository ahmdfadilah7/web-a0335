@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

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
            <a
                href="#"
                data-toggle="modal"
                data-target="#bd-example-modal-lg"
                type="button"
                class="btn btn-primary"
            >
                <i class="micon ion ion-plus"></i>
            </a>
            <div class="table table-responsive mt-4">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>Tugas</th>
                            <th>File</th>
                            <th>Ekstensi</th>
                            <th>Kelompok</th>
                            <th>Status</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugasakhir as $no => $value)
                            @if ($value->file <> '')
                                @php
                                    $image = explode('.', $value->file);
                                    $text = explode('/', $value->file);
                                @endphp
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $value->judul }}</td>
                                    <td>{{ $text[1] }}</td>
                                    <td>
                                        @if ($image[1]=='pdf')
                                            <img src="{{ url('/images/icon-pdf.png') }}" style="width:50px;">
                                        @elseif ($image[1]=='doc' || $image[1]=='docx')
                                            <img src="{{ url('/images/icon-word.png') }}" style="width:50px;">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $value->kelompok->name }}
                                    </td>
                                    <td>
                                        @if ($value->kirim == 1)
                                            <span class="badge badge-success">Terkirim</span>
                                        @else
                                            <span class="badge badge-warning">Belum dikirim</span>
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open(['method' => 'post', 'route' => ['dokumen.kirimtugasakhir']]) !!}
                                            <input type="hidden" name="tugasakhir_id" value="{{ $value->id }}">
                                            <input type="hidden" name="user_id" value="{{ $value->user_id }}">
                                            <input type="hidden" name="prodi_id" value="{{ Auth::user()->prodi_id }}">
                                            <button type="submit" class="btn btn-success btn-sm mb-2" title="Mencetak Dokumen ke BAAK"><i class="icon-copy dw dw-print"></i></button>
                                        {!! Form::close() !!}
                                        @if ($value->kirim != 1)
                                            <button type="button" class="btn btn-info btn-sm kirimData mb-2" value="{{ $value->id }}" title="Kirim"><i class="fa fa-paper-plane"></i></button>
                                        @endif
                                        @if (Auth::user()->role->title=='Mahasiswa')
                                            {!! Form::open(['method' => 'PUT', 'route' => ['tugasakhir.update',$value->id]]) !!}
                                                @csrf
                                                <input type="hidden" name="status" value="0">
                                                <button type="submit" class="btn btn-primary btn-sm mb-2" title="Simpan ke Artefak"><span class="icon-copy ti-save"></span></button>
                                            {!! Form::close() !!}
                                        @endif
                                        <button type="button" class="btn btn-danger btn-sm deleteData" value="{{ $value->id }}"><i class="dw dw-delete-3"></i></button>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>Tidak ada file</td>
                                    <td>
                                        Tidak ada file
                                    </td>
                                    <td>
                                        {{-- <a href="" class="btn btn-danger btn-sm"><i class="dw dw-delete-3"></i></a> --}}
                                        <button type="button" class="btn btn-danger btn-sm deleteData" value="{{ $value->id }}"><i class="dw dw-delete-3"></i></button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if (Auth::user()->anggotakelompok->count() != null)
    @include('tugasakhir.partials.modal')
@endif
@include('tugasakhir.partials.kirimModal')
@include('tugasakhir.partials.deleteModal')

@endsection

@section('script')
    <script>
        $('.kirimData').click(function (e) {
            e.preventDefault();

            var id = $(this).val();
            $('#idtugasakhir').val(id);
            $('#kirimmodal').modal('show');
        });
    </script>
@endsection

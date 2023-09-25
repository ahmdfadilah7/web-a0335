@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Daftar Pembimbing</h2>
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
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Prodi</th>
                            <th>Status</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembimbing as $no => $value)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $value->nim }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ date('d/m/Y', strtotime($value->created_at)) }}</td>
                            <td>{{ $value->title }}</td>
                            <td>
                                @if ($value->status==0)
                                    <span class="badge badge-warning">Pengajuan</span>
                                @elseif ($value->status==1)
                                    <span class="badge badge-success">Diterima</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-info btn-sm viewData mb-2"
                                    data-toggle="modal"
                                    data-url="{{ route('pembimbing.show', $value->id) }}"
                                    data-target="#viewmodal"
                                    title="Detail"
                                >
                                    <i class="fa fa-eye"></i>
                                </button>
                                @if ($value->status==0)
                                    {!! Form::open(['method' => 'post', 'route' => ['pembimbing.store']]) !!}
                                    @csrf
                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-success btn-sm mb-2" title="Terima"><i class="icon-copy bi bi-check-circle"></i></button>
                                    {!! Form::close() !!}

                                    {!! Form::open(['method' => 'post', 'route' => ['pembimbing.store']]) !!}
                                    @csrf
                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-danger btn-sm mb-2" title="Tolak"><i class="icon-copy bi bi-x-octagon"></i></button>
                                    {!! Form::close() !!}

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

@include('pembimbing.partials.viewModal')

@endsection

@include('layouts.partials.js')

@section('script')
    <script>
        $('.viewData').click(function (e) {
            e.preventDefault();

            var url = $(this).data('url');
            var icon = "circle";
            $.get(url, function(data){
                $('#viewmodal').modal('show');
                $('#nama').val(data.name);
                $('#nim').val(data.nim);
                $('#prodi').val(data.title);
            })
        });
    </script>
@endsection

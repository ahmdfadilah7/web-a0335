@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Tugas</h2>
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
            @if (Request::segment(2) != 'selesai')
                <a
                    href="#"
                    data-toggle="modal"
                    data-target="#bd-example-modal-lg"
                    type="button"
                    class="btn btn-primary"
                >
                    <i class="micon ion ion-plus"></i>
                </a>
            @endif
            <div class="table table-responsive mt-4">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>Judul</th>
                            <th>Deadline</th>
                            <th>Prodi</th>
                            <th>Koordinator</th>
                            <th>Status</th>
                            @if (Request::segment(2) != 'selesai')
                                <th class="datatable-nosort">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas as $no => $value)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $value->judul }}</td>
                                <td>
                                    {{ date('d M Y', strtotime($value->deadline)) }}
                                </td>
                                <td>
                                    {{ $value->title }}
                                </td>
                                <td>
                                    {{ $value->name }}
                                </td>
                                <td>
                                    @if ($value->status==0)
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-warning">Belum Selesai</span>
                                    @endif
                                </td>
                                @if (Request::segment(2) != 'selesai')
                                    <td>
                                        @if ($value->status==1)
                                            <button
                                                type="button"
                                                class="btn btn-primary btn-sm editData"
                                                title="Edit"
                                                data-toggle="modal"
                                                data-url="{{ route('tugas.edit', $value->id) }}"
                                                data-target="#editmodal"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-success btn-sm saveData" title="Tugas Selesai" value="{{ $value->id }}"><i class="dw dw-bookmark"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm deleteData" title="Hapus" value="{{ $value->id }}"><i class="dw dw-delete-3"></i></button>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('tugas.partials.modal')
@include('tugas.partials.saveModal')
@include('tugas.partials.editModal')
@include('tugas.partials.deleteModal')

@endsection

@section('script')
<script>
    $('.saveData').click(function (e) {
        e.preventDefault();

        var data_id = $(this).val();
        $('#save_id').val(data_id);
        $('#savemodal').modal('show');
    });

    $('.editData').click(function (e) {
        e.preventDefault();

        var url = $(this).data('url');
        $.get(url, function(data){
            $('#editmodal').modal('show');
            $('#tugasid').val(data.id);
            $('#judul').val(data.judul);
            $('#deadline').val(data.deadline);
        })
    });
</script>
@endsection


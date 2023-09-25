@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<style>
    .pagination li {
        float: left;
        /* list-style-type: none; */
        margin: 5px;
        /* font-size: 12px; */
    }
</style>

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Pengumuman</h2>
    <div class="row">
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
            @if (Auth::user()->role->title=='Koordinator' || Auth::user()->role->title=='Baak')
                <a href="#" data-toggle="modal" data-target="#inputData" type="button" class="btn btn-primary btn-sm mb-4"><i class="micon ion ion-plus"></i> Tambah Pengumuman</a>
            @endif

            @foreach ($pengumuman as $value)
                <div class="row pt-3 mb-3" style="border: 1px solid #1D69DB; border-radius: 10px; margin-left:5px; margin-right:5px;">
                    <div class="col-md-10">
                        <div style="display:flex;">
                            <div class="pl-3">
                                @if ($value->role=='Baak')
                                    <h2 class="h5">{{ $value->title.' - '.$value->name }}</h2>
                                @else
                                    <h2 class="h5">{{ $value->title.' - '.$value->name.' - '.$value->role }}</h2>
                                @endif
                                @if($value->link_jadwal != '' || $value->link_jadwal != null)
                                    <p class="font-12 mb-2">
                                        <a href="{{ $value->link_jadwal }}" target="_blank" class="text-blue">{{ $value->link_jadwal }}</a> <- Open
                                    </p>
                                @endif
                                @if($value->file_jadwal != '' || $value->file_jadwal != null)
                                    <p class="font-12 mb-2">
                                        <a href="{{ url($value->file_jadwal) }}" class="text-blue">{{ Str::substr($value->file_jadwal, 5) }}</a> <- Download
                                    </p>
                                @endif
                                <p class="font-12">
                                    {{ $value->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->role->title=='Koordinator')
                        <div class="col-md-2 text-right">
                            <button
                                type="button"
                                class="btn btn-primary btn-sm mb-2 editData"
                                data-toggle="modal"
                                data-url="{{ route('pengumuman.edit', $value->id) }}"
                                data-target="#editmodal"
                            >
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm deleteData" value="{{ $value->id }}"><i class="dw dw-delete-3"></i></button>
                        </div>
                    @elseif (Auth::user()->role->title=='Baak')
                        <div class="col-md-2 text-right">
                            <button type="button" class="btn btn-danger btn-sm deleteData" value="{{ $value->id }}"><i class="dw dw-delete-3"></i></button>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="pagination">
                {{ $pengumuman->links('pengumuman.partials.pagination') }}
            </div>
        </div>
    </div>
</div>

@include('pengumuman.partials.deleteModal')
@include('pengumuman.partials.editModal')
@include('pengumuman.partials.modal')

@endsection

@include('layouts.partials.js')

@section('script')
<script>
    $('.editData').click(function (e) {
        e.preventDefault();

        var url = $(this).data('url');
        $.get(url, function(data){
            $('#editmodal').modal('show');
            $('#pengumumanid').val(data.id);
            $('#title').val(data.title);
            $('#description').val(data.description);
        })
    });
</script>
@endsection

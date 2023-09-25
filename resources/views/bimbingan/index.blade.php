@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Bimbingan</h2>
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
            @if (Auth::user()->role->title=='Mahasiswa')
                <a href="#" data-toggle="modal" data-target="#inputData" type="button" class="btn btn-primary mb-4"><i class="fa fa-plus"></i> Pengajuan Bimbingan</a>
            @endif
            <div class="table table-responsive">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>
                                @if (Auth::user()->role->title=='Mahasiswa')
                                    Nama Pembimbing
                                @else
                                    Nama Mahasiswa
                                @endif
                            </th>
                            <th>Waktu</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bimbingan as $no => $value)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->waktu }}</td>
                                <td>{{ date('d M Y', strtotime($value->tanggal)) }}</td>
                                <td>
                                    @if (strlen($value->keterangan) > 29)
                                        {{ substr($value->keterangan,0, 30).'...' }}
                                    @else
                                        {{ $value->keterangan }}
                                    @endif
                                </td>
                                <td>
                                    @if ($value->status==0)
                                        <span class="badge badge-warning">Proses</span>
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
                                        data-url="{{ route('bimbingan.show', $value->id) }}"
                                        data-target="#viewmodal"
                                    >
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    @if(Auth::user()->role->title=='Mahasiswa')
                                        <button type="button" class="btn btn-danger btn-sm deleteData mb-2" value="{{ $value->id }}"><i class="dw dw-delete-3"></i></button>
                                    @elseif (Auth::user()->role->title=='Dosen')
                                        @if ($value->status==0)
                                            {!! Form::open(['method' => 'post', 'route' => ['bimbingan.pengajuan']]) !!}
                                                <input type="hidden" name="id" value="{{ $value->id }}">
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="btn btn-success btn-sm mb-2" title="Terima"><i class="icon-copy bi bi-check-circle"></i></button>
                                            {!! Form::close() !!}

                                            <button type="button" class="btn btn-danger btn-sm tolakData" value="{{ $value->id }}" title="Tolak"><i class="icon-copy bi bi-x-octagon"></i></button>
                                        @endif
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

@include('bimbingan.partials.deleteModal')
@include('bimbingan.partials.viewModal')
@include('bimbingan.partials.tolakModal')
@include('bimbingan.partials.modal')

@endsection

@include('layouts.partials.js')

@section('script')
    <script>
        $('.viewData').click(function (e) {
            e.preventDefault();

            var url = $(this).data('url');
            var icon = "circle";
            var tanggal
            $.get(url, function(data){
                const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                const d = new Date(data.tanggal);

                var day = d.getDate();
                var month = months[d.getMonth()];
                var year = d.getFullYear();
                $('#viewmodal').modal('show');
                $('#nama').text(data.name);
                $('#pukul').html("<strong>Pukul :</strong> "+ data.waktu);
                $('#tanggal').text(day+ ' ' + ' ' + month + ' ' + year);
                $('#keterangan').text(data.keterangan);
                if(data.status==0){
                    $('#status').html('<span class="badge badge-warning">Proses</span>');
                    $('#alasan').html('');
                } else if(data.status==1) {
                    $('#status').html('<span class="badge badge-success">Diterima</span>');
                    $('#alasan').html('');
                } else {
                    $('#status').html('<span class="badge badge-danger">Ditolak</span>');
                    $('#alasan').html("<p><strong>Alasan Ditolak</strong></p> <p>"+ data.alasan +"</p>");
                }
                $('.event-icon').html("<i class='fa fa-"+ icon +"'></i>");
            })
        });
    </script>
@endsection

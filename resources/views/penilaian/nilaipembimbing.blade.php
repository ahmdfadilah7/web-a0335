@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="card-box pd-20">
    @if(Request::segment(2)=='nilaipembimbingta_1')
        <h2 class="h4 mb-20">Nilai Pembimbing TA 1</h2>
    @elseif(Request::segment(2)=='nilaipembimbingta_2')
        <h2 class="h4 mb-20">Nilai Pembimbing TA 2</h2>        
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
                data-target="#add_sempro"
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
                            <th>Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Judul</th>
                            <th>Nilai 1</th>
                            <th>Nilai 2</th>
                            <th>Nilai 3</th>
                            <th>Nilai 4</th>
                            <th>Nilai 5</th>
                            @if(Request::segment(2)=='nilaipembimbingta_2')
                                <th>Nilai 6</th>
                                <th>Nilai 7</th>
                            @endif
                            <th>Total Nilai</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaipembimbing as $no => $row)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $row->mahasiswa_name }}</td>
                                <td>{{ $row->prodi }}</td>
                                <td>{{ $row->judul }}</td>
                                <td>{{ $row->nilai_1 }}</td>
                                <td>{{ $row->nilai_2 }}</td>
                                <td>{{ $row->nilai_3 }}</td>
                                <td>{{ $row->nilai_4 }}</td>
                                <td>{{ $row->nilai_5 }}</td>
                                @if(Request::segment(2)=='nilaipembimbingta_2')
                                    <td>{{ $row->nilai_6 }}</td>
                                    <td>{{ $row->nilai_7 }}</td>
                                @endif
                                <td>{{ $row->total_nilai }}</td>
                                <td>
                                    @if(Auth::user()->role->title=='Dosen')                                        
                                        <button
                                            type="button"
                                            class="btn btn-info btn-sm editData"
                                            data-toggle="modal"
                                            data-url="{{ route('penilaian.editpembimbing', $row->id) }}"
                                            data-target="#edit_pembimbing"
                                            title="Edit"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-danger btn-sm deleteData" title="Hapus" value="{{ $row->id }}"><i class="dw dw-delete-3"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('penilaian.partials.addnilaipembimbing')
@include('penilaian.partials.editnilaipembimbing')
@include('penilaian.partials.deletenilaipembimbing')

@endsection

@section('script')
    <script>
        $('.editData').click(function (e) {
            e.preventDefault();

            var url = $(this).data('url');
            var icon = "circle";
            console.log(url)
            $.get(url, function(data){
                $('#edit_pembimbing').modal('show');
                $('#pembimbingID').val(data.id);                
                $('#mahasiswa').val(data.mahasiswa);                
                $('#judul').val(data.judul);
                $('#nilai_1').val(data.nilai_1);                
                $('#nilai_2').val(data.nilai_2);                
                $('#nilai_3').val(data.nilai_3);                
                $('#nilai_4').val(data.nilai_4);                
                $('#nilai_5').val(data.nilai_5);                
                $('#nilai_6').val(data.nilai_6);                
                $('#nilai_7').val(data.nilai_7);                
            })
        });
    </script>
@endsection

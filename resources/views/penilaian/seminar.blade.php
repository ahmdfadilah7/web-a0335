@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Nilai Seminar TA 1</h2>
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
                            <th>Total Nilai</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($seminar as $no => $row)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $row->mahasiswa_name }}</td>
                                <td>{{ $row->prodi }}</td>
                                <td>{{ $row->judul }}</td>
                                <td>{{ $row->nilai_1 }}</td>
                                <td>{{ $row->nilai_2 }}</td>
                                <td>{{ $row->nilai_3 }}</td>
                                <td>{{ $row->nilai_4 }}</td>
                                <td>{{ $row->total_nilai }}</td>
                                <td>
                                    @if(Auth::user()->role->title=='Dosen')                                        
                                        <button
                                            type="button"
                                            class="btn btn-info btn-sm editData"
                                            data-toggle="modal"
                                            data-url="{{ route('penilaian.editseminar', $row->id) }}"
                                            data-target="#edit_sempro"
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

@include('penilaian.partials.addseminar')
@include('penilaian.partials.editseminar')
@include('penilaian.partials.deleteseminar')

@endsection

@section('script')
    <script>
        $('.editData').click(function (e) {
            e.preventDefault();

            var url = $(this).data('url');
            var icon = "circle";
            console.log(url)
            $.get(url, function(data){
                $('#edit_seminar').modal('show');
                $('#seminarID').val(data.id);                
                $('#mahasiswa').val(data.mahasiswa);                
                $('#judul').val(data.judul);
                $('#nilai_1').val(data.nilai_1);                
                $('#nilai_2').val(data.nilai_2);                
                $('#nilai_3').val(data.nilai_3);                
                $('#nilai_4').val(data.nilai_4);                
            })
        });
    </script>
@endsection


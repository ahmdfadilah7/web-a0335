@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="card-box pd-20">
    @if(Request::segment(2)=='nilaiadmta_1')
        <h2 class="h4 mb-20">Nilai Administrasi TA 1</h2>
    @elseif(Request::segment(2)=='nilaiadmta_2')
        <h2 class="h4 mb-20">Nilai Administrasi TA 2</h2>        
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
                            @if(Request::segment(2)=='nilaiadmta_1')
                                <th>Nilai SemPro</th>
                                <th>Nilai Seminar</th>
                            @else
                                <th>Nilai Prasidang</th>
                                <th>Nilai Sidang</th>
                            @endif
                            <th>Total Nilai</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiadm as $no => $row)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $row->mahasiswa_name }}</td>
                                <td>{{ $row->prodi }}</td>
                                <td>{{ $row->judul }}</td>
                                <td>{{ $row->nilai_1 }}</td>
                                <td>{{ $row->nilai_2 }}</td>
                                <td>{{ $row->total_nilai }}</td>
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-info btn-sm editData"
                                        data-toggle="modal"
                                        data-url="{{ route('penilaian.editnilaiadm', $row->id) }}"
                                        data-target="#edit_nilaiadm"
                                        title="Edit"
                                    >
                                        <i class="fa fa-edit"></i>
                                    </button>
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

@include('penilaian.partials.addnilaiadm')
@include('penilaian.partials.editnilaiadm')
@include('penilaian.partials.deletenilaiadm')

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $('#mahasiswaId').on('change', function() {
                var mahasiswaID = document.getElementById('mahasiswaId').value;
                @if (Request::segment(2)=='nilaiadmta_2')
                    var url = '{{ url('penilaian/getadmta2') }}/' + mahasiswaID;
                @else
                    var url = '{{ url('penilaian/getadm') }}/' + mahasiswaID;
                @endif
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data.pengajuanjudul_id != null) {

                            document.getElementById('pengajuanjudulId').value = data.pengajuanjudul_id;
                            document.getElementById('pengajuanjudulname').value = data.pengajuanjudul_name;
                            document.getElementById('nilai_1').value = data.nilai_sempro;
                            document.getElementById('nilai_2').value = data.nilai_seminar;
                        } else {
                            document.getElementById('pengajuanjudulId').value = "";
                            document.getElementById('nilai_1').value = "";
                            document.getElementById('nilai_2').value = "";
                        }
                    }
                });
            });

            $('.editData').click(function (e) {
                e.preventDefault();

                var url = $(this).data('url');
                var icon = "circle";
                console.log(url)
                $.get(url, function(data){
                    $('#edit_nilaiadm').modal('show');
                    $('#nilaiadmID').val(data.id);                
                    $('#mahasiswa').val(data.mahasiswa);                
                    $('#judul').val(data.judul);
                    $('#submit_dokumen_1').val(data.submit_dokumen_1);
                    $('#schedule_1').val(data.schedule_1);
                    $('#reschedule_1').val(data.reschedule_1);
                    $('#ulang_1').val(data.ulang_1);
                    $('#submit_dokumen_2').val(data.submit_dokumen_2);
                    $('#schedule_2').val(data.schedule_2);
                    $('#reschedule_2').val(data.reschedule_2);
                    $('#ulang_2').val(data.ulang_2);
                    $('#nilai_1').val(data.nilai_1);                
                    $('#nilai_2').val(data.nilai_2);                
                    $('#persentase').val(data.persentase);                
                    $('#persentase_2').val(data.persentase_2);
                })
            });
        })
    </script>

@endsection


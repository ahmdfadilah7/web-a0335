@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
    <div class="card-box pd-20">
        <h2 class="h4 mb-20">Penilaian</h2>
        <div class="row align-items-center">
            <div class="col-md-12">
                @if (Session::get('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p>{{ $errors }}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Mahasiswa</label>
                            <input type="hidden" name="mahasiswa" id="mahasiswaId" class="form-control" value="{{ $mahasiswa->id }}" readonly>
                            <input type="text" name="mahasiswa" class="form-control" value="{{ $mahasiswa->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="hidden" name="judul" id="judulId" class="form-control" value="{{ $judul->id }}" readonly>                            
                            <input type="text" name="judul" class="form-control" value="{{ $judul->judul }}" readonly>                            
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="table table-responsive">

                            {{-- Nilai Seminar Proposal --}}
                            <div class="mt-5">
                                @include('penilaian.partials.nilaisempro')
                            </div>
                            {{-- Nilai Seminar Proposal --}}
    
                            {{-- Nilai Seminar --}}
                            <div class="mt-5">
                                @include('penilaian.partials.nilaiseminar')
                            </div>
                            {{-- Nilai Seminar --}}
    
                            {{-- Nilai Pembimbing --}}
                            <div class="mt-5">
                                @include('penilaian.partials.nilaipembimbing')
                            </div>
                            {{-- Nilai Pembimbing --}}
    
                            {{-- Nilai Pembimbing --}}
                            <div class="mt-5">
                                @include('penilaian.partials.nilaiadm')
                            </div>
                            {{-- Nilai Pembimbing --}}
    
                            <div class="mt-5 mb-4">
                                <table class="table-bordered table-striped" style="width: 100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th colspan="2">Nilai Tugas Akhir TA 1</th>
                                        </tr>
                                        <tr>
                                            <th>Nilai</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>
                                                @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                                    Pra Sidang
                                                @else
                                                    Seminar Proposal
                                                @endif
                                            </td>
                                            <td><span>{{ $penilaian->nilai_1 }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                                    Sidang
                                                @else
                                                    Seminar
                                                @endif
                                            </td>
                                            <td><span>{{ $penilaian->nilai_2 }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Pembimbing</td>
                                            <td><span>{{ $penilaian->nilai_3 }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Administrasi</td>
                                            <td><span>{{ $penilaian->nilai_4 }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td><span>{{ $penilaian->total_nilai }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Grade</td>
                                            <td><span>{{ $penilaian->grade }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
    
                        </div>
                    </div>
                        
                    <div class="col-md-12">
                        @if(Request::segment(2)=='detailnilai_ta2')
                            <a href="{{ route('penilaian.nilaita_2') }}" class="btn btn-warning">KEMBALI</a>
                        @else
                            <a href="{{ route('penilaian.index') }}" class="btn btn-warning">KEMBALI</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            
            var mahasiswaID = document.getElementById('mahasiswaId').value;
            var judulID = document.getElementById('judulId').value;
            @if (Request::segment(2)=='detailnilai_ta2')
                var url = '{{ url('penilaian/getnilai_ta2') }}/'+mahasiswaID+"/"+judulID;
            @else
                var url = '{{ url('penilaian/getnilai') }}/'+mahasiswaID+"/"+judulID;
            @endif
            $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data.pengajuan != null) {

                            // Menampilkan data nilai Sempro dari Pembimbing 1
                            $('#dosenname_1').html(data.sempropembimbing[0].dosen_name);
                            $('#p1_nilaisempro_1').html(data.sempropembimbing[0].nilai_1);
                            $('#p1_nilaisempro_2').html(data.sempropembimbing[0].nilai_2);
                            $('#p1_nilaisempro_3').html(data.sempropembimbing[0].nilai_3);
                            $('#p1_nilaisempro_4').html(data.sempropembimbing[0].nilai_4);
                            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                $('#p1_nilaisempro_5').html(data.sempropembimbing[0].nilai_5)                                    
                            @endif
                            document.getElementById('p1_totalnilaisempro').value = data
                                .sempropembimbing[0].total_nilai;

                            // Menampilkan data nilai Sempro dari Pembimbing 2
                            if (data.sempropembimbing[1] != null) {
                                document.getElementById("sempropembimbing2").style.display = 'table-row'  
                                $('#dosenname_2').html(data.sempropembimbing[1].dosen_name)
                                $('#p2_nilaisempro_1').html(data.sempropembimbing[1].nilai_1)
                                $('#p2_nilaisempro_2').html(data.sempropembimbing[1].nilai_2)
                                $('#p2_nilaisempro_3').html(data.sempropembimbing[1].nilai_3)
                                $('#p2_nilaisempro_4').html(data.sempropembimbing[1].nilai_4)
                                @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                    $('#p2_nilaisempro_5').html(data.sempropembimbing[1].nilai_5)                                    
                                @endif
                                document.getElementById('p2_totalnilaisempro').value = data
                                    .sempropembimbing[1].total_nilai
                            } else {
                                document.getElementById("sempropembimbing2").style.display = 'none'
                                $('#dosenname_2').html('0')
                                $('#p2_nilaisempro_1').html('0')
                                $('#p2_nilaisempro_2').html('0')
                                $('#p2_nilaisempro_3').html('0')
                                $('#p2_nilaisempro_4').html('0')
                                @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                    $('#p2_nilaisempro_5').html('0')                                    
                                @endif
                                document.getElementById('p2_totalnilaisempro').value = '0'
                            }

                            // Menampilkan data nilai Sempro dari Penguji 1
                            $('#pengujiname_1').html(data.sempropenguji[0].dosen_name)
                            $('#pg1_nilaisempro_1').html(data.sempropenguji[0].nilai_1);
                            $('#pg1_nilaisempro_2').html(data.sempropenguji[0].nilai_2);
                            $('#pg1_nilaisempro_3').html(data.sempropenguji[0].nilai_3);
                            $('#pg1_nilaisempro_4').html(data.sempropenguji[0].nilai_4);
                            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                $('#pg1_nilaisempro_5').html(data.sempropenguji[0].nilai_5)                                    
                            @endif
                            document.getElementById('pg1_totalnilaisempro').value = data
                                .sempropenguji[0].total_nilai

                            // Menampilkan data nilai Sempro dari Penguji 2
                            if (data.sempropenguji[1] != null) {   
                                document.getElementById("sempropenguji2").style.display = 'table-row'                               
                                $('#pengujiname_2').html(data.sempropenguji[1].dosen_name)
                                $('#pg2_nilaisempro_1').html(data.sempropenguji[1].nilai_1)
                                $('#pg2_nilaisempro_2').html(data.sempropenguji[1].nilai_2)
                                $('#pg2_nilaisempro_3').html(data.sempropenguji[1].nilai_3)
                                $('#pg2_nilaisempro_4').html(data.sempropenguji[1].nilai_4)
                                @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                    $('#pg2_nilaisempro_5').html(data.sempropenguji[1].nilai_5)                                    
                                @endif
                                document.getElementById('pg2_totalnilaisempro').value = data
                                    .sempropenguji[1].total_nilai
                            } else {
                                document.getElementById("sempropenguji2").style.display = 'none'
                                $('#pengujiname_2').html('0')
                                $('#pg2_nilaisempro_1').html('0')
                                $('#pg2_nilaisempro_2').html('0')
                                $('#pg2_nilaisempro_3').html('0')
                                $('#pg2_nilaisempro_4').html('0')
                                @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                    $('#pg2_nilaisempro_5').html('0')                                    
                                @endif
                                document.getElementById('pg2_totalnilaisempro').value = '0'
                            }

                            // Menampilkan data nilai Sempro dari Pembimbing 1
                            $('#pembimbingseminarname_1').html(data.seminarpembimbing[0].dosen_name)
                            $('#p1_nilaiseminar_1').html(data.seminarpembimbing[0].nilai_1)
                            $('#p1_nilaiseminar_2').html(data.seminarpembimbing[0].nilai_2)
                            $('#p1_nilaiseminar_3').html(data.seminarpembimbing[0].nilai_3)
                            $('#p1_nilaiseminar_4').html(data.seminarpembimbing[0].nilai_4)
                            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                $('#p1_nilaiseminar_5').html(data.seminarpembimbing[0].nilai_5)                                    
                            @endif
                            document.getElementById('p1_totalnilaiseminar').value = data
                                .seminarpembimbing[0].total_nilai

                            // Menampilkan data nilai Seminar dari Pembimbing 2
                            if (data.seminarpembimbing[1] != null) {   
                                document.getElementById("seminarpembimbing2").style.display = 'table-row'  
                                $('#pembimbingseminarname_2').html(data.seminarpembimbing[1].dosen_name)
                                $('#p2_nilaiseminar_1').html(data.seminarpembimbing[1].nilai_1)
                                $('#p2_nilaiseminar_2').html(data.seminarpembimbing[1].nilai_2)
                                $('#p2_nilaiseminar_3').html(data.seminarpembimbing[1].nilai_3)
                                $('#p2_nilaiseminar_4').html(data.seminarpembimbing[1].nilai_4)
                                @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                    $('#p2_nilaiseminar_5').html(data.seminarpembimbing[1].nilai_5)                                    
                                @endif
                                document.getElementById('p2_totalnilaiseminar').value = data
                                    .seminarpembimbing[1].total_nilai
                            } else {
                                document.getElementById("seminarpembimbing2").style.display = 'none'    
                                $('#pembimbingseminarname_2').html('0')
                                $('#p2_nilaiseminar_1').html('0')
                                $('#p2_nilaiseminar_2').html('0')
                                $('#p2_nilaiseminar_3').html('0')
                                $('#p2_nilaiseminar_4').html('0')
                                @if(Request::segment(2)=='nilai_ta2')
                                    $('#p2_nilaiseminar_5').html('0')                                    
                                @endif
                                document.getElementById('p2_totalnilaiseminar').value = '0'
                            }

                            // Menampilkan data nilai Seminar dari Penguji 1
                            $('#pengujiseminarname_1').html(data.seminarpenguji[0].dosen_name)
                            $('#pg1_nilaiseminar_1').html(data.seminarpenguji[0].nilai_1)
                            $('#pg1_nilaiseminar_2').html(data.seminarpenguji[0].nilai_2)
                            $('#pg1_nilaiseminar_3').html(data.seminarpenguji[0].nilai_3)
                            $('#pg1_nilaiseminar_4').html(data.seminarpenguji[0].nilai_4)
                            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                $('#pg1_nilaiseminar_5').html(data.seminarpenguji[0].nilai_5)                                    
                            @endif                            
                            document.getElementById('pg1_totalnilaiseminar').value = data
                                .seminarpenguji[0].total_nilai

                            // Menampilkan data nilai Seminar dari Penguji 2
                            if (data.seminarpenguji[1] != null) {
                                document.getElementById("seminarpenguji2").style.display = 'table-row'
                                $('#pengujiseminarname_2').html(data.seminarpenguji[1].dosen_name)
                                $('#pg2_nilaiseminar_1').html(data.seminarpenguji[1].nilai_1)
                                $('#pg2_nilaiseminar_2').html(data.seminarpenguji[1].nilai_2)
                                $('#pg2_nilaiseminar_3').html(data.seminarpenguji[1].nilai_3)
                                $('#pg2_nilaiseminar_4').html(data.seminarpenguji[1].nilai_4)
                                @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                    $('#pg2_nilaiseminar_5').html(data.seminarpenguji[1].nilai_5)                                    
                                @endif                            
                                document.getElementById('pg2_totalnilaiseminar').value = data
                                    .seminarpenguji[1].total_nilai
                            } else {
                                document.getElementById("seminarpenguji2").style.display = 'none'
                                $('#pengujiseminarname_2').html('0')
                                $('#pg2_nilaiseminar_1').html('0')
                                $('#pg2_nilaiseminar_2').html('0')
                                $('#pg2_nilaiseminar_3').html('0')
                                $('#pg2_nilaiseminar_4').html('0')
                                @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                    $('#pg2_nilaiseminar_5').html('0')                                    
                                @endif                            
                                document.getElementById('pg2_totalnilaiseminar').value = '0'
                            }

                            // Menampilkan data nilai Pembimbing dari Pembimbing 1
                            $('#nilaipembimbingname_1').html(data.nilaipembimbing[0].dosen_name)
                            $('#p1_nilaipembimbing_1').html(data.nilaipembimbing[0].nilai_1)
                            $('#p1_nilaipembimbing_2').html(data.nilaipembimbing[0].nilai_2)
                            $('#p1_nilaipembimbing_3').html(data.nilaipembimbing[0].nilai_3)
                            $('#p1_nilaipembimbing_4').html(data.nilaipembimbing[0].nilai_4)
                            $('#p1_nilaipembimbing_5').html(data.nilaipembimbing[0].nilai_5)                            
                            @if (Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                $('#p1_nilaipembimbing_6').html(data.nilaipembimbing[0].nilai_6)
                                $('#p1_nilaipembimbing_7').html(data.nilaipembimbing[0].nilai_7)
                            @endif
                            document.getElementById('p1_totalnilaipembimbing').value = data
                                .nilaipembimbing[0].total_nilai

                            // Menampilkan data nilai Pembimbing dari Pembimbing 2
                            if (data.nilaipembimbing[1] != null) {
                                document.getElementById("nilaipembimbing2").style.display = 'table-row'
                                $('#nilaipembimbingname_2').html(data.nilaipembimbing[1].dosen_name)
                                $('#p2_nilaipembimbing_1').html(data.nilaipembimbing[1].nilai_1)
                                $('#p2_nilaipembimbing_2').html(data.nilaipembimbing[1].nilai_2)
                                $('#p2_nilaipembimbing_3').html(data.nilaipembimbing[1].nilai_3)
                                $('#p2_nilaipembimbing_4').html(data.nilaipembimbing[1].nilai_4)
                                $('#p2_nilaipembimbing_5').html(data.nilaipembimbing[1].nilai_5)                            
                                @if (Request::segment(2)=='nilai_ta2'  || Request::segment(2)=='detailnilai_ta2')
                                    $('#p2_nilaipembimbing_6').html(data.nilaipembimbing[1].nilai_6)
                                    $('#p2_nilaipembimbing_7').html(data.nilaipembimbing[1].nilai_7)
                                @endif
                                document.getElementById('p2_totalnilaipembimbing').value = data
                                    .nilaipembimbing[1].total_nilai
                            } else {
                                document.getElementById("nilaipembimbing2").style.display = 'none'
                                $('#nilaipembimbingname_2').html('0')
                                $('#p2_nilaipembimbing_1').html('0')
                                $('#p2_nilaipembimbing_2').html('0')
                                $('#p2_nilaipembimbing_3').html('0')
                                $('#p2_nilaipembimbing_4').html('0')
                                $('#p2_nilaipembimbing_5').html('0')                            
                                @if (Request::segment(2)=='nilai_ta2'  || Request::segment(2)=='detailnilai_ta2')
                                    $('#p2_nilaipembimbing_6').html('0')
                                    $('#p2_nilaipembimbing_7').html('0')
                                @endif
                                document.getElementById('p2_totalnilaipembimbing').value = '0'
                            }

                            // Menampilkan data nilai Administrator TA 1 dari Koordinator
                            $('#nilaiadmname_1').html(data.nilaiadm[0].dosen_name)
                            $('#p1_submit_dokumen_1').html(data.nilaiadm[0].submit_dokumen_1)
                            $('#p1_schedule_1').html(data.nilaiadm[0].schedule_1)
                            $('#p1_reschedule_1').html(data.nilaiadm[0].reschedule_1)
                            $('#p1_ulang_1').html(data.nilaiadm[0].ulang_1)
                            $('#p1_nilaiadm_1').html(data.nilaiadm[0].nilai_1)
                            $('#p1_persentase_1').html(data.nilaiadm[0].persentase)
                            var totalnilaiadm_1 = parseInt(data.nilaiadm[0].nilai_1)*parseInt(data.nilaiadm[0].persentase)/100
                            document.getElementById('p1_totalnilaiadm_1').value = totalnilaiadm_1

                            $('#nilaiadmname_2').html(data.nilaiadm[0].dosen_name)
                            $('#p1_submit_dokumen_2').html(data.nilaiadm[0].submit_dokumen_2)
                            $('#p1_schedule_2').html(data.nilaiadm[0].schedule_2)
                            $('#p1_reschedule_2').html(data.nilaiadm[0].reschedule_2)
                            $('#p1_ulang_2').html(data.nilaiadm[0].ulang_2)
                            $('#p1_nilaiadm_2').html(data.nilaiadm[0].nilai_2)
                            $('#p1_persentase_2').html(data.nilaiadm[0].persentase_2)
                            var totalnilaiadm_2 = parseInt(data.nilaiadm[0].nilai_2)*parseInt(data.nilaiadm[0].persentase_2)/100
                            document.getElementById('p1_totalnilaiadm_2').value = totalnilaiadm_2
                            
                            document.getElementById('p1_totalnilaiadm').value = (parseInt(totalnilaiadm_2)+parseInt(totalnilaiadm_1))/2
                        } else {

                            // Menampilkan data nilai Sempro dari Pembimbing 1
                            $('#dosenname_1').html('');
                            $('#p1_nilaisempro_1').html('');
                            $('#p1_nilaisempro_2').html('');
                            $('#p1_nilaisempro_3').html('');
                            $('#p1_nilaisempro_4').html('');
                            document.getElementById('p1_totalnilaisempro').value = ''

                            // Menampilkan data nilai Sempro dari Pembimbing 2
                            document.getElementById("sempropembimbing2").style.display = 'table-row'  
                            $('#dosenname_2').html('')
                            $('#p2_nilaisempro_1').html('')
                            $('#p2_nilaisempro_2').html('')
                            $('#p2_nilaisempro_3').html('')
                            $('#p2_nilaisempro_4').html('')
                            document.getElementById('p2_totalnilaisempro').value = ''
                            

                            // Menampilkan data nilai Sempro dari Penguji 1
                            $('#pengujiname_1').html('')
                            $('#pg1_nilaisempro_1').html('');
                            $('#pg1_nilaisempro_2').html('');
                            $('#pg1_nilaisempro_3').html('');
                            $('#pg1_nilaisempro_4').html('');
                            document.getElementById('pg1_totalnilaisempro').value = ''

                            // Menampilkan data nilai Sempro dari Penguji 2
                            document.getElementById("sempropenguji2").style.display = 'table-row'                               
                            $('#pengujiname_2').html('')
                            $('#pg2_nilaisempro_1').html('')
                            $('#pg2_nilaisempro_2').html('')
                            $('#pg2_nilaisempro_3').html('')
                            $('#pg2_nilaisempro_4').html('')
                            document.getElementById('pg2_totalnilaisempro').value = ''

                            // Menampilkan data nilai Sempro dari Pembimbing 1
                            $('#pembimbingseminarname_1').html('')
                            $('#p1_nilaiseminar_1').html('')
                            $('#p1_nilaiseminar_2').html('')
                            $('#p1_nilaiseminar_3').html('')
                            $('#p1_nilaiseminar_4').html('')
                            document.getElementById('p1_totalnilaiseminar').value = ''

                            // Menampilkan data nilai Seminar dari Pembimbing 2
                            document.getElementById("seminarpembimbing2").style.display = 'table-row'  
                            $('#pembimbingseminarname_2').html('')
                            $('#p2_nilaiseminar_1').html('')
                            $('#p2_nilaiseminar_2').html('')
                            $('#p2_nilaiseminar_3').html('')
                            $('#p2_nilaiseminar_4').html('')
                            document.getElementById('p2_totalnilaiseminar').value = ''

                            // Menampilkan data nilai Seminar dari Penguji 1
                            $('#pengujiseminarname_1').html('')
                            $('#pg1_nilaiseminar_1').html('')
                            $('#pg1_nilaiseminar_2').html('')
                            $('#pg1_nilaiseminar_3').html('')
                            $('#pg1_nilaiseminar_4').html('')                            
                            document.getElementById('pg1_totalnilaiseminar').value = ''

                            // Menampilkan data nilai Seminar dari Penguji 2
                            document.getElementById("seminarpenguji2").style.display = 'table-row'
                            $('#pengujiseminarname_2').html('')
                            $('#pg2_nilaiseminar_1').html('')
                            $('#pg2_nilaiseminar_2').html('')
                            $('#pg2_nilaiseminar_3').html('')
                            $('#pg2_nilaiseminar_4').html('')                            
                            document.getElementById('pg2_totalnilaiseminar').value = ''

                            // Menampilkan data nilai Pembimbing dari Pembimbing 1
                            $('#nilaipembimbingname_1').html('')
                            $('#p1_nilaipembimbing_1').html('')
                            $('#p1_nilaipembimbing_2').html('')
                            $('#p1_nilaipembimbing_3').html('')
                            $('#p1_nilaipembimbing_4').html('')
                            $('#p1_nilaipembimbing_5').html('')                            
                            @if (Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                                $('#p1_nilaipembimbing_6').html('')
                                $('#p1_nilaipembimbing_7').html('')
                            @endif
                            document.getElementById('p1_totalnilaipembimbing').value = ''

                            // Menampilkan data nilai Pembimbing dari Pembimbing 2
                            document.getElementById("nilaipembimbing2").style.display = 'table-row'
                            $('#nilaipembimbingname_2').html('')
                            $('#p2_nilaipembimbing_1').html('')
                            $('#p2_nilaipembimbing_2').html('')
                            $('#p2_nilaipembimbing_3').html('')
                            $('#p2_nilaipembimbing_4').html('')
                            $('#p2_nilaipembimbing_5').html('')                            
                            @if (Request::segment(2)=='nilai_ta2'  || Request::segment(2)=='detailnilai_ta2')
                                $('#p2_nilaipembimbing_6').html('')
                                $('#p2_nilaipembimbing_7').html('')
                            @endif
                            document.getElementById('p2_totalnilaipembimbing').value = ''                            

                            // Menampilkan data nilai Administrator TA 1 dari Koordinator
                            $('#nilaiadmname_1').html('')
                            $('#p1_submit_dokumen_1').html('')
                            $('#p1_schedule_1').html('')
                            $('#p1_reschedule_1').html('')
                            $('#p1_ulang_1').html('')
                            $('#p1_nilaiadm_1').html('')
                            $('#p1_persentase_1').html('')
                            // var totalnilaiadm_1 = parseInt(data.nilaiadm[0].nilai_1)*parseInt(data.nilaiadm[0].persentase)/100
                            document.getElementById('p1_totalnilaiadm_1').value = ''

                            $('#nilaiadmname_2').html('')
                            $('#p1_submit_dokumen_2').html('')
                            $('#p1_schedule_2').html('')
                            $('#p1_reschedule_2').html('')
                            $('#p1_ulang_2').html('')
                            $('#p1_nilaiadm_2').html('')
                            $('#p1_persentase_2').html('')
                            // var totalnilaiadm_2 = parseInt(data.nilaiadm[0].nilai_2)*parseInt(data.nilaiadm[0].persentase_2)/100
                            document.getElementById('p1_totalnilaiadm_2').value = ''
                            
                            document.getElementById('p1_totalnilaiadm').value = ''
                        }
                    }
                });
        });
    </script>
@endsection

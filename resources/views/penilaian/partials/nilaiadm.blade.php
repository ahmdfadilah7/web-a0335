<table class="table table-bordered table-striped" style="width:100%;">
    <thead class="text-center">
        <tr>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                @php
                    $judul_1 = 'Pra Sidang';
                    $judul_2 = 'Sidang';
                @endphp
                <th colspan="8">Nilai Administrasi TA 2</th>
            @else
                @php
                    $judul_1 = 'SemPro';
                    $judul_2 = 'Seminar';
                @endphp
                <th colspan="8">Nilai Administrasi TA 1</th>
            @endif
        </tr>
        <tr>
            <th></th>
            <th>Dokumen</th>
            <th>On Schedule</th>
            <th>Re Schedule</th>
            <th>Ulang</th>
            <th>Nilai</th>
            <th>%</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <tr>
            <td>{{ $judul_1 }}</td>
            <td><span id="p1_submit_dokumen_1"></span></td>
            <td><span id="p1_schedule_1"></span></td>
            <td><span id="p1_reschedule_1"></span></td>
            <td><span id="p1_ulang_1"></span></td>
            <td><span id="p1_nilaiadm_1"></span></td>
            <td><span id="p1_persentase_1"></span></td>
            <td><input type="text" style="width: 70px;" name="p1_totalnilaiadm_1" id="p1_totalnilaiadm_1" class="form-control" readonly></td>
        </tr>
        <tr>
            <td>{{ $judul_2 }}</td>
            <td><span id="p1_submit_dokumen_2"></span></td>
            <td><span id="p1_schedule_2"></span></td>
            <td><span id="p1_reschedule_2"></span></td>
            <td><span id="p1_ulang_2"></span></td>
            <td><span id="p1_nilaiadm_2"></span></td>
            <td><span id="p1_persentase_2"></span></td>
            <td><input type="text" style="width: 70px;" name="p1_totalnilaiadm_2" id="p1_totalnilaiadm_2" class="form-control" readonly></td>
        </tr>
        <tr>
            <td colspan="7">Total</td>
            <td><input type="text" style="width: 70px;" name="p1_totalnilaiadm" id="p1_totalnilaiadm" class="form-control" readonly></td>
        </tr>
    </tbody>
</table>

{{-- @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')    
    <h5>Nilai Administrasi TA 2</h5>
    @php
        $judul_1 = 'Pra Sidang';
        $judul_2 = 'Sidang';
    @endphp
@else
    @php
        $judul_1 = 'SemPro';
        $judul_2 = 'Seminar';
    @endphp
    <h5>Nilai Administrasi TA 1</h5>
@endif
<label for="" class="badge bg-primary text-white">Koordinator <span id="nilaiadmname_1"></span></label>
<div class="row">
    <div class="col-md-12">
        <h6 class="text-center">{{ $judul_1 }}</h6>
    </div>
    <div class="form-group col-sm-12 col-md-4 text-center">
        <label for="">Submit dokumen H-2</label>
        <input type="text" name="p1_submit_dokumen_1" id="p1_submit_dokumen_1" class="form-control" readonly>
    </div>
    <div class="form-group col-sm-12 col-md-4 text-center">
        <label for="">{{ $judul_1 }} on schedule</label>
        <input type="text" name="p1_schedule_1" id="p1_schedule_1" class="form-control" readonly>
    </div>
    <div class="form-group col-sm-12 col-md-4 text-center">
        <label for="">{{ $judul_1 }} Ulang</label>
        <input type="text" name="p1_ulang_1" id="p1_ulang_1" class="form-control" readonly>
    </div>
    <div class="form-group col-sm-12 text-center">
        <label for="">Nilai 1</label>
        <input type="text" id="p1_nilaiadm_1" class="form-control" readonly>
    </div>
    <div class="col-md-12">
        <h6 class="text-center">{{ $judul_2 }}</h6>
    </div>
    <div class="form-group col-sm-12 col-md-4 text-center">
        <label for="">Submit dokumen H-2</label>
        <input type="text" name="p1_submit_dokumen_2" id="p1_submit_dokumen_2" class="form-control" readonly>
    </div>
    <div class="form-group col-sm-12 col-md-4 text-center">
        <label for="">{{ $judul_2 }} on schedule</label>
        <input type="text" name="p1_schedule_2" id="p1_schedule_2" class="form-control" readonly>
    </div>
    <div class="form-group col-sm-12 col-md-4 text-center">
        <label for="">{{ $judul_2 }} Ulang</label>
        <input type="text" name="p1_ulang_2" id="p1_ulang_2" class="form-control" readonly>
    </div>
    <div class="form-group col-sm-12 text-center">
        <label for="">Nilai 2</label>
        <input type="text" id="p1_nilaiadm_2" class="form-control" readonly>
    </div>    
    <div class="form-group col-sm-12 col-md-4 text-center">
        <label for="">Persentase (%)</label>
        <input type="text" name="p1_persentase" id="p1_persentase" class="form-control" readonly>
    </div>
    <div class="form-group col-sm-12 col-md-8 text-center">
        <label for="">Total Nilai</label>
        <input type="text" name="p1_totalnilaiadm" id="p1_totalnilaiadm" class="form-control" readonly>
    </div>
</div>

 --}}

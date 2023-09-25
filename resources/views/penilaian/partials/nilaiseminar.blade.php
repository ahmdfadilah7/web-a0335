<table class="table table-bordered table-striped">
    <thead class="text-center">
        <tr>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <th colspan="6">Nilai Sidang TA 2</th>
            @else
                <th colspan="6">Nilai Seminar TA 1</th>
            @endif
        </tr>
        <tr>
            <th></th>
            <th>N1</th>
            <th>N2</th>
            <th>N3</th>
            <th>N4</th>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <th>N5</th>
            @endif
            <th width="100px">Total</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <tr>
            <td>Pembimbing 1 <i>(<span id="pembimbingseminarname_1"></span>)</i></td>
            <td><span id="p1_nilaiseminar_1"></span></td>
            <td><span id="p1_nilaiseminar_2"></span></td>
            <td><span id="p1_nilaiseminar_3"></span></td>
            <td><span id="p1_nilaiseminar_4"></span></td>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <td><span id="p1_nilaiseminar_5"></span></td>
            @endif
            <td><input type="text" name="p1_totalnilaiseminar" id="p1_totalnilaiseminar" class="form-control" readonly></td>
        </tr>
        <tr id="seminarpembimbing2">
            <td>Pembimbing 2 <i>(<span id="pembimbingseminarname_2"></span>)</i></td>
            <td><span id="p2_nilaiseminar_1"></span></td>
            <td><span id="p2_nilaiseminar_2"></span></td>
            <td><span id="p2_nilaiseminar_3"></span></td>
            <td><span id="p2_nilaiseminar_4"></span></td>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <td><span id="p2_nilaiseminar_5"></span></td>
            @endif
            <td><input type="text" name="p2_totalnilaiseminar" id="p2_totalnilaiseminar" class="form-control" readonly></td>
        </tr>
        <tr>
            <td>Penguji 1 <i>(<span id="pengujiseminarname_1"></span>)</i></td>
            <td><span id="pg1_nilaiseminar_1"></span></td>
            <td><span id="pg1_nilaiseminar_2"></span></td>
            <td><span id="pg1_nilaiseminar_3"></span></td>
            <td><span id="pg1_nilaiseminar_4"></span></td>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <td><span id="pg1_nilaiseminar_5"></span></td>
            @endif
            <td><input type="text" name="pg1_totalnilaiseminar" id="pg1_totalnilaiseminar" class="form-control" readonly></td>
        </tr>
        <tr id="seminarpenguji2">
            <td>Penguji 2 <i>(<span id="pengujiseminarname_2"></span>)</i></td>
            <td><span id="pg2_nilaiseminar_1"></span></td>
            <td><span id="pg2_nilaiseminar_2"></span></td>
            <td><span id="pg2_nilaiseminar_3"></span></td>
            <td><span id="pg2_nilaiseminar_4"></span></td>   
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <td><span id="pg2_nilaiseminar_5"></span></td>
            @endif         
            <td><input type="text" name="pg2_totalnilaiseminar" id="pg2_totalnilaiseminar" class="form-control" readonly></td>
        </tr>
    </tbody>
</table>
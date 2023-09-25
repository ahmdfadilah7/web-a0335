<table class="table table-bordered table-striped">
    <thead class="text-center">
        <tr>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <th colspan="7">Nilai Pembimbing TA 2</th>
            @else
                <th colspan="7">Nilai Pembimbing TA 1</th>
            @endif
        </tr>
        <tr>
            <th></th>
            <th>N1</th>
            <th>N2</th>
            <th>N3</th>
            <th>N4</th>
            <th>N5</th>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <th>N6</th>
                <th>N7</th>
            @endif
            <th width="100px">Total</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <tr>
            <td>Pembimbing 1 <i>(<span id="nilaipembimbingname_1"></span>)</i></td>
            <td><span id="p1_nilaipembimbing_1"></span></td>
            <td><span id="p1_nilaipembimbing_2"></span></td>
            <td><span id="p1_nilaipembimbing_3"></span></td>
            <td><span id="p1_nilaipembimbing_4"></span></td>
            <td><span id="p1_nilaipembimbing_5"></span></td>    
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <td><span id="p1_nilaipembimbing_6"></span></td>    
                <td><span id="p1_nilaipembimbing_7"></span></td>    
            @endif        
            <td><input type="text" name="p1_totalnilaipembimbing" id="p1_totalnilaipembimbing" class="form-control" readonly></td>
        </tr>
        <tr id="nilaipembimbing2">
            <td>Pembimbing 2 <i>(<span id="nilaipembimbingname_2"></span>)</i></td>
            <td><span id="p2_nilaipembimbing_1"></span></td>
            <td><span id="p2_nilaipembimbing_2"></span></td>
            <td><span id="p2_nilaipembimbing_3"></span></td>
            <td><span id="p2_nilaipembimbing_4"></span></td>
            <td><span id="p2_nilaipembimbing_5"></span></td>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <td><span id="p2_nilaipembimbing_6"></span></td>    
                <td><span id="p2_nilaipembimbing_7"></span></td>    
            @endif   
            <td><input type="text" name="p2_totalnilaipembimbing" id="p2_totalnilaipembimbing" class="form-control" readonly></td>
        </tr>
    </tbody>
</table>
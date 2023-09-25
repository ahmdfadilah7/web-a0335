{{-- @if(Request::segment(2)=='nilai_ta2')
    <h5>Nilai Pra Sidang TA 2</h5>
@else
    <h5>Nilai Seminar Proposal TA 1</h5>
@endif --}}

<table class="table table-striped table-bordered" style="width: 100%">
    <thead class="text-center">
        <tr>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <th colspan="6" class="text-center">Nilai Pra Sidang TA 2</th>
            @else
                <th colspan="6" class="text-center">Nilai Seminar Proposal TA 1</th>
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
            <td>Pembimbing 1 <i>(<span id="dosenname_1"></span>)</i></td>
            <td>
                <span id="p1_nilaisempro_1"></span>
            </td>
            <td>
                <span id="p1_nilaisempro_2"></span>
            </td>
            <td>
                <span id="p1_nilaisempro_3"></span>
            </td>
            <td>
                <span id="p1_nilaisempro_4"></span>
            </td>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <td>
                    <span id="p1_nilaisempro_5"></span>
                </td>
            @endif
            <td>
                <input type="text" name="p1_totalnilaisempro" id="p1_totalnilaisempro" class="form-control" readonly>
            </td>
        </tr>
        <tr id="sempropembimbing2">
            <td>Pembimbing 2 <i>(<span id="dosenname_2"></span>)</i></td>
            <td>
                <span id="p2_nilaisempro_1"></span>
            </td>
            <td>
                <span id="p2_nilaisempro_2"></span>
            </td>
            <td>
                <span id="p2_nilaisempro_3"></span>
            </td>
            <td>
                <span id="p2_nilaisempro_4"></span>
            </td>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <td>
                    <span id="p2_nilaisempro_5"></span>
                </td>
            @endif
            <td>
                <input type="text" name="p2_totalnilaisempro" id="p2_totalnilaisempro" class="form-control" readonly>
            </td>
        </tr>
        <tr>
            <td>Penguji 1 <i>(<span id="pengujiname_1"></span>)</i></td>
            <td>
                <span id="pg1_nilaisempro_1"></span>
            </td>
            <td>
                <span id="pg1_nilaisempro_2"></span>
            </td>
            <td>
                <span id="pg1_nilaisempro_3"></span>
            </td>
            <td>
                <span id="pg1_nilaisempro_4"></span>
            </td>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <td>
                    <span id="pg1_nilaisempro_5"></span>
                </td>
            @endif
            <td>
                <input type="text" name="pg1_totalnilaisempro" id="pg1_totalnilaisempro" class="form-control" readonly>
            </td>
        </tr>
        <tr id="sempropenguji2">
            <td>Penguji 2 <i>(<span id="pengujiname_2"></span>)</i></td>
            <td>
                <span id="pg2_nilaisempro_1"></span>
            </td>
            <td>
                <span id="pg2_nilaisempro_2"></span>
            </td>
            <td>
                <span id="pg2_nilaisempro_3"></span>
            </td>
            <td>
                <span id="pg2_nilaisempro_4"></span>
            </td>
            @if(Request::segment(2)=='nilai_ta2' || Request::segment(2)=='detailnilai_ta2')
                <td>
                    <span id="pg2_nilaisempro_5"></span>
                </td>
            @endif
            <td>
                <input type="text" name="pg2_totalnilaisempro" id="pg2_totalnilaisempro" class="form-control" readonly>
            </td>
        </tr>
    </tbody>
</table>
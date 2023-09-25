<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            @if(Request::segment(2)=='nilaipembimbingta_1')
                {!! Form::open(['method' => 'post', 'route' => ['penilaian.deletenilaipembimbingta_1']]) !!}
            @elseif(Request::segment(2)=='nilaipembimbingta_2')
                {!! Form::open(['method' => 'post', 'route' => ['penilaian.deletenilaipembimbingta_2']]) !!}
            @endif
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">
                    <input type="hidden" name="id" id="data_id">
                    Apakah kamu ingin menghapus nilai seminar proposal ini?
                </h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                            data-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                        NO
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-danger border-radius-100 btn-block confirmation-btn">
                            <i class="fa fa-check"></i>
                        </button>
                        YES
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

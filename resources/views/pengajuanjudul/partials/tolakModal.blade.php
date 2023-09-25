<div class="modal fade" id="tolakmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {!! Form::open(['method' => 'post', 'route' => ['pengajuanjudul.pengajuan']]) !!}
            @csrf
            <div class="modal-body font-18">
                <input type="hidden" name="id" id="idtolak">
                <input type="hidden" name="status" value="2">
                <div class="form-group">
                    <label for="">Alasan</label>
                    <textarea name="alasan" class="form-control" rows="3"></textarea>
                </div>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            TIDAK
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-check"></i>
                            IYA
                        </button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

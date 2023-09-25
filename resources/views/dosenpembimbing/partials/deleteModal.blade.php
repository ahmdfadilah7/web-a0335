<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {!! Form::open(['method' => 'post', 'route' => ['dosenpembimbing.delete']]) !!}
            @csrf
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">
                    <input type="hidden" name="id" id="data_id">
                    Apakah kamu ingin menghapus data ini?
                </h4>
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

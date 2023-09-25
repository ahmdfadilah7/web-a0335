<div class="modal fade bs-example-modal-lg" id="editmodal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tugas
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="pd-20 card-box mb-30">
                    {!! Form::open(['method' => 'PUT', 'route' => ['tugas.ubah'], 'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    <input type="hidden" name="id" id="tugasid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Deadline</label>
                                <input type="date" name="deadline" id="deadline" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">
                    SAVE
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

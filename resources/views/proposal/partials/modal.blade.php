<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Upload Dokumen Proposal
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="pd-20 card-box mb-30">
                    {!! Form::open(['method' => 'post', 'route' => ['proposal.store'], 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" name="kelompok_id" value="{{ Auth::user()->anggotakelompok[0]->kelompok_id }}">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Tugas</label>
                                <select name="tugas_id" class="form-control">
                                    @foreach ($tugas as $value)
                                        <option value="{{ $value->id }}">{{ $value->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">File Proposal</label>
                                <input type="file" name="file" class="form-control">
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

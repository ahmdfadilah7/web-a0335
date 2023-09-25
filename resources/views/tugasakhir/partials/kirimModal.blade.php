<div class="modal fade bs-example-modal-lg" id="kirimmodal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Kirim Dokumen ke Penguji
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="pd-20 card-box mb-30">
                    {!! Form::open(['method' => 'post', 'route' => ['tugasakhir.kirim'], 'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    <input type="hidden" name="tugasakhir_id" id="idtugasakhir">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Penguji</label>
                                <select name="dosen_id" class="form-control">
                                    @foreach ($dosen as $value)
                                        <option value="{{ $value->user_id }}">{{ $value->name.' - '.$value->nim.' - '.$value->title }}</option>
                                    @endforeach
                                </select>
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

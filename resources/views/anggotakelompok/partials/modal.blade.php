<div class="modal fade bs-example-modal-lg" id="inputData" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Tambah Anggota
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="pd-20 card-box mb-30">
                    {!! Form::open(['method' => 'post', 'route' => ['anggotakelompok.store'], 'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    <input type="hidden" name="kelompok_id" value="{{ $kelompok->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Pilih Anggota</label>
                                <select name="user_id" class="form-control">
                                    @foreach ($anggota as $value)
                                        <option value="{{ $value->id }}">{{ $value->name.' - '.$value->prodi->title }}</option>
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

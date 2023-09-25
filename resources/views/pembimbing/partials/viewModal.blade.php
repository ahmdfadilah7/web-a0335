<div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body font-18" id="viewbody">
                <div class="col-md-12 text-center">
                    <img src="{{ url('/images/user-profile.png') }}" stlye="width:300px">
                    <div class="mt-4">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label text-right">NIM</label>
                            <div class="col-sm-12 col-md-10">
                                <input type="text" class="form-control" id="nim" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label text-right">Nama</label>
                            <div class="col-sm-12 col-md-10">
                                <input type="text" class="form-control" id="nama" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label text-right">Prodi</label>
                            <div class="col-sm-12 col-md-10">
                                <input type="text" class="form-control" id="prodi" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

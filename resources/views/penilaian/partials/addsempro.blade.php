<div class="modal fade bs-example-modal-lg" id="add_sempro" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Nilai Seminar Proposal
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="pd-20 card-box mb-30">
                    @if(Request::segment(2)=='sempropenguji')
                        {!! Form::open(['method' => 'post', 'route' => ['penilaian.addsempropenguji'], 'enctype' => 'multipart/form-data']) !!}
                    @elseif(Request::segment(2)=='sempropembimbing')
                        {!! Form::open(['method' => 'post', 'route' => ['penilaian.addsempropembimbing'], 'enctype' => 'multipart/form-data']) !!}
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Mahasiswa</label>
                                <select name="mahasiswa_id" class="form-control">
                                    @foreach ($mahasiswa as $value)
                                        <option value="{{ $value->id }}">{{ $value->name.' - '.$value->nim }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Judul</label>
                                <select name="pengajuanjudul_id" class="form-control">
                                    @foreach ($judul as $value)
                                        <option value="{{ $value->id }}">{{ $value->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Nilai 1</label>
                                <input type="number" name="nilai_1" class="form-control">
                                <p class="font-12 text-secondary">
                                    <i>(Delivery - Final Project Report, Writing Skill)</i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Nilai 2</label>
                                <input type="number" name="nilai_2" class="form-control">
                                <p class="font-12 text-secondary">
                                    <i>(Presentation-Delivery)</i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Nilai 3</label>
                                <input type="number" name="nilai_3" class="form-control">
                                <p class="font-12 text-secondary">
                                    <i>(Presentation-Organization)</i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Nilai 4</label>
                                <input type="number" name="nilai_4" class="form-control">
                                <p class="font-12 text-secondary">
                                    <i>(Question and Answer)</i>
                                </p>
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

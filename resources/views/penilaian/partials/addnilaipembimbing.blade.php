<div class="modal fade bs-example-modal-lg" id="add_sempro" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                @if(Request::segment(2)=='nilaipembimbingta_1')
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Nilai Pembimbing TA 1
                    </h4>
                @elseif (Request::segment(2)=='nilaipembimbingta_2')
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Nilai Pembimbing TA 2
                    </h4>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <div class="pd-20 card-box mb-30">
                    @if(Request::segment(2)=='nilaipembimbingta_1')
                        {!! Form::open(['method' => 'post', 'route' => ['penilaian.addnilaipembimbingta_1'], 'enctype' => 'multipart/form-data']) !!}
                        @php
                            $ket_n1 = 'Personality dan nilai diri-Antusiasme, motivasi, inisiatif';
                            $ket_n2 = 'Proses Pembimbingan- Dapat berinteraksi dengan pembimbing sehingga saling memperkaya';
                            $ket_n3 = 'Proses Pembimbingan TA';
                            $ket_n4 = 'Penguasaan materi- Dari lingkup yang ditentukan dan ditargetkan, penguasaan konsep';
                            $ket_n5 = 'Penguasaan materi - Skill penunjang';
                        @endphp
                    @elseif (Request::segment(2)=='nilaipembimbingta_2')
                        {!! Form::open(['method' => 'post', 'route' => ['penilaian.addnilaipembimbingta_2'], 'enctype' => 'multipart/form-data']) !!}
                        @php
                            $ket_n1 = 'Tingkat kerajinan Dalam bekerja (Deligence)';
                            $ket_n2 = 'Kemampuan Mengelola Waktu (time management)';
                            $ket_n3 = 'Sikap dan Komitmen terhadap yang dikerjakan (Attitude and Commitment to Work)';
                            $ket_n4 = 'Kerjasana dalan tim, sistematik (team Work, Well organized and systematic)';
                            $ket_n5 = 'Pemahaman terhadap materi, masalah dan inisiatif (understanding of topic and initiative)';
                            $ket_n6 = 'Tingkat ketanggapan mahasiswa dalam proses pembimbingan dan keaktifan selama pembimbingan (student’s responsiveness towards advisor and his/her activeness)';
                            $ket_n7 = 'Tingkat kelengkapan dan kualitas deliverables (completeness and quality of deliverables)';
                        @endphp
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
                                    <i>({{ $ket_n1 }})</i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Nilai 2</label>
                                <input type="number" name="nilai_2" class="form-control">
                                <p class="font-12 text-secondary">
                                    <i>({{ $ket_n2 }})</i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Nilai 3</label>
                                <input type="number" name="nilai_3" class="form-control">
                                <p class="font-12 text-secondary">
                                    <i>({{ $ket_n3 }})</i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Nilai 4</label>
                                <input type="number" name="nilai_4" class="form-control">
                                <p class="font-12 text-secondary">
                                    <i>({{ $ket_n4 }})</i>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Nilai 5</label>
                                <input type="number" name="nilai_5" class="form-control">
                                <p class="font-12 text-secondary">
                                    <i>({{ $ket_n5 }})</i>
                                </p>
                            </div>
                        </div>
                        @if(Request::segment(2)=='nilaipembimbingta_2')
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Nilai 6</label>
                                    <input type="number" name="nilai_6" class="form-control">
                                    <p class="font-12 text-secondary">
                                        <i>({{ $ket_n6 }})</i>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Nilai 7</label>
                                    <input type="number" name="nilai_7" class="form-control">
                                    <p class="font-12 text-secondary">
                                        <i>({{ $ket_n7 }})</i>
                                    </p>
                                </div>
                            </div>
                        @endif
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

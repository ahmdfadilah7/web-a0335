<div class="modal fade bs-example-modal-lg" id="add_sempro" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                @if(Request::segment(2)=='nilaiadmta_1')
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Nilai Administrasi TA 1
                    </h4>
                @elseif (Request::segment(2)=='nilaiadmta_2')
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Nilai Administrasi TA 2
                    </h4>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                {{-- <div class="pd-20 card-box mb-30"> --}}
                    @if(Request::segment(2)=='nilaiadmta_1')
                        {!! Form::open(['method' => 'post', 'route' => ['penilaian.addnilaiadmta_1'], 'enctype' => 'multipart/form-data']) !!}
                        @php
                            $judul_1 = 'Seminar Proposal';
                            $judul_2 = 'Seminar';
                        @endphp
                    @elseif (Request::segment(2)=='nilaiadmta_2')
                        {!! Form::open(['method' => 'post', 'route' => ['penilaian.addnilaiadmta_2'], 'enctype' => 'multipart/form-data']) !!}
                        @php
                            $judul_1 = 'Pra Sidang';
                            $judul_2 = 'Sidang';                            
                        @endphp
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Mahasiswa</label>
                                <select name="mahasiswa_id" id="mahasiswaId" class="form-control">
                                    <option value="0">- Pilih -</option>
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
                                    <option value="0">- Pilih -</option>
                                    @foreach ($judul as $value)
                                        <option value="{{ $value->id }}">{{ $value->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table table-responsive">
                                <table class="table-bordered table-striped" style="width: 100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th></th>
                                            <th>Submit Dokumen H-2</th>
                                            <th>On Schedule</th>
                                            <th>Re Schedule</th>
                                            <th>Ulang</th>
                                            <th>Nilai</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $judul_1 }}</td>
                                            <td>
                                                <select name="submit_dokumen_1">
                                                    <option value="0">- Pilih -</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="schedule_1">
                                                    <option value="0">- Pilih -</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="reschedule_1">
                                                    <option value="0">- Pilih -</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="ulang_1">
                                                    <option value="0">- Pilih -</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="nilai_1" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" name="persentase" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ $judul_2 }}</td>
                                            <td>
                                                <select name="submit_dokumen_2">
                                                    <option value="0">- Pilih -</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="schedule_2">
                                                    <option value="0">- Pilih -</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="reschedule_2">
                                                    <option value="0">- Pilih -</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="ulang_2">
                                                    <option value="0">- Pilih -</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="nilai_2" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" name="persentase_2" class="form-control">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                        {{-- <div class="col-md-12 mt-3">
                            <h6 class="text-center">{{ $judul_1 }}</h6>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">Submit dokumen H-2</label>
                                <select name="submit_dokumen_1" class="form-control">
                                    <option value="0">- Pilih -</option>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">{{ $judul_1 }} on schedule</label>
                                <select name="schedule_1" class="form-control">
                                    <option value="0">- Pilih -</option>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">{{ $judul_1 }} on reschedule</label>
                                <select name="schedule_1" class="form-control">
                                    <option value="0">- Pilih -</option>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">{{ $judul_1 }} Ulang</label>
                                <select name="ulang_1" class="form-control">
                                    <option value="0">- Pilih -</option>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="">Nilai {{ $judul_1 }}</label>
                                <input type="number" name="nilai_1" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <h6 class="text-center">{{ $judul_2 }}</h6>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Submit dokumen H-2</label>
                                <select name="submit_dokumen_2" class="form-control">
                                    <option value="0">- Pilih -</option>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">{{ $judul_2 }} on schedule</label>
                                <select name="schedule_2" class="form-control">
                                    <option value="0">- Pilih -</option>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">{{ $judul_2 }} Ulang</label>
                                <select name="ulang_2" class="form-control">
                                    <option value="0">- Pilih -</option>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="">Nilai {{ $judul_2 }}</label>
                                <input type="number" name="nilai_2" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Persentase (%)</label>
                                <input type="number" name="persentase" class="form-control">
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <ul>
                                <li>
                                    <p class="font-12 text-secondary">
                                        <i>Administrasi tepat waktu + on-schedule : 100 %</i>
                                    </p>
                                </li>
                                <li>
                                    <p class="font-12 text-secondary">
                                        <i>Administrasi tepat waktu + Re-schedule : 71 – 90 %</i>
                                    </p>
                                </li>
                                <li>
                                    <p class="font-12 text-secondary">
                                        <i>Administrasi terlambat + on-schedule : 51 – 70 %</i>
                                    </p>
                                </li>
                                <li>
                                    <p class="font-12 text-secondary">
                                        <i>Administrasi terlambat + Re-schedule : 26 – 50 %</i>
                                    </p>
                                </li>
                                <li>
                                    <p class="font-12 text-secondary">
                                        <i>Seminar atau sidang ulang : 0 – 25 %</i>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                {{-- </div> --}}
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

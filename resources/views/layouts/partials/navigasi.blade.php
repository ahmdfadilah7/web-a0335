<div class="menu-block customscroll">
    <div class="sidebar-menu">
        <ul id="accordion-menu">
            <li class="dropdown">
                <a href="{{ route('dashboard.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='dashboard'){ echo 'active'; } ?>">
                    <span class="micon bi bi-house"></span
                    ><span class="mtext">Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role->title=='Mahasiswa')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-files"></span> <span class="mtext">Dokumen</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('proposal.index') }}" class="<?php if(Request::segment(1)=='proposal'){ echo 'active'; } ?>">Proposal</a></li>
                        <li><a href="{{ route('tugasakhir.index') }}" class="<?php if(Request::segment(1)=='tugasakhir'){ echo 'active'; } ?>">Tugas Akhir</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file"></span> <span class="mtext">Penilaian</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('penilaian.index') }}" class="<?php if(Request::segment(1)=='penilaian' && Request::segment(2)=='' || Request::segment(2)=='nilai'){ echo 'active'; } ?>">TA 1</a></li>
                        <li><a href="{{ route('penilaian.nilaita_2') }}" class="<?php if(Request::segment(2)=='nilaita_2' || Request::segment(2)=='nilai_ta2'){ echo 'active'; } ?>">TA 2</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('dosenpembimbing.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='dosenpembimbing'){ echo 'active'; } ?>">
                        <span class="micon bi bi-people"></span
                        ><span class="mtext">Dosen Pembimbing</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('bimbingan.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='bimbingan'){ echo 'active'; } ?>">
                        <span class="micon bi bi-calendar2-date"></span
                        ><span class="mtext">Bimbingan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengajuanjudul.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='pengajuanjudul'){ echo 'active'; } ?>">
                        <span class="micon bi bi-chat-left-dots"></span
                        ><span class="mtext">Pengajuan Judul</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('artefak.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='artefak'){ echo 'active'; } ?>">
                        <span class="micon bi bi-file-earmark-zip"></span>
                        <span class="mtext">Artefak Tugas Akhir</span>
                    </a>
                </li>
            @elseif (Auth::user()->role->title=='Dosen')
                @php
                    $dosen = DB::table('dosens')
                        ->where('user_id', Auth::user()->id)
                        ->get();
                @endphp
                @foreach ($dosen as $row)      
                    @if($row->role=='Pembimbing')
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-file"></span> <span class="mtext">Penilaian Pembimbing</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('penilaian.sempropembimbing') }}" class="<?php if(Request::segment(2)=='sempropembimbing'){ echo 'active'; } ?>">Nilai SemPro TA 1</a></li>
                                <li><a href="{{ route('penilaian.seminarpembimbing') }}" class="<?php if(Request::segment(2)=='seminarpembimbing'){ echo 'active'; } ?>">Nilai Seminar TA 1</a></li>
                                <li><a href="{{ route('penilaian.nilaipembimbingta_1') }}" class="<?php if(Request::segment(2)=='nilaipembimbingta_1'){ echo 'active'; } ?>">Nilai Pembimbing TA 1</a></li>
                                <li><a href="{{ route('penilaian.prasidangpembimbing') }}" class="<?php if(Request::segment(2)=='prasidangpembimbing'){ echo 'active'; } ?>">Nilai Pra Sidang TA 2</a></li>
                                <li><a href="{{ route('penilaian.nilaipembimbingta_2') }}" class="<?php if(Request::segment(2)=='nilaipembimbingta_2'){ echo 'active'; } ?>">Nilai Pembimbing TA 2</a></li>
                                <li><a href="{{ route('penilaian.sidangpembimbing') }}" class="<?php if(Request::segment(2)=='sidangpembimbing'){ echo 'active'; } ?>">Nilai Sidang TA 2</a></li>
                            </ul>
                        </li>
                    @endif     
                    @if($row->role=='Penguji')
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon bi bi-file"></span> <span class="mtext">Penilaian Penguji</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('penilaian.sempropenguji') }}" class="<?php if(Request::segment(2)=='sempropenguji'){ echo 'active'; } ?>">Nilai SemPro TA 1</a></li>
                                <li><a href="{{ route('penilaian.seminarpenguji') }}" class="<?php if(Request::segment(2)=='seminarpenguji'){ echo 'active'; } ?>">Nilai Seminar TA 1</a></li>
                                <li><a href="{{ route('penilaian.prasidangpenguji') }}" class="<?php if(Request::segment(2)=='prasidangpenguji'){ echo 'active'; } ?>">Nilai Pra Sidang TA 2</a></li>
                                <li><a href="{{ route('penilaian.sidangpenguji') }}" class="<?php if(Request::segment(2)=='sidangpenguji'){ echo 'active'; } ?>">Nilai Sidang TA 2</a></li>
                            </ul>
                        </li>
                    @endif         
                @endforeach
                <li>
                    <a href="{{ route('pembimbing.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='pembimbing'){ echo 'active'; } ?>">
                        <span class="micon bi bi-people"></span
                        ><span class="mtext">Pilih Pembimbing</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-people"></span> <span class="mtext">Dosen Penguji</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('dosenpenguji.dokumen') }}" class="<?php if(Request::segment(1)=='dosenpenguji'){ echo 'active'; } ?>">Dokumen</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('bimbingan.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='bimbingan'){ echo 'active'; } ?>">
                        <span class="micon bi bi-calendar2-date"></span
                        ><span class="mtext">Bimbingan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengajuanjudul.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='pengajuanjudul'){ echo 'active'; } ?>">
                        <span class="micon bi bi-chat-left-dots"></span
                        ><span class="mtext">Pengajuan Judul</span>
                    </a>
                </li>
            @elseif (Auth::user()->role->title=='Koordinator')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-files"></span> <span class="mtext">Tugas</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('tugas.index') }}" class="<?php if(Request::segment(1)=='tugas' && Request::segment(2)==''){ echo 'active'; } ?>">List Tugas</a></li>
                        <li><a href="{{ route('tugas.selesai') }}" class="<?php if(Request::segment(1)=='tugas' && Request::segment(2)=='selesai'){ echo 'active'; } ?>">Tugas Selesai</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file"></span> <span class="mtext">Penilaian</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('penilaian.nilaiadmta_1') }}" class="<?php if(Request::segment(2)=='nilaiadmta_1'){ echo 'active'; } ?>">Nilai Administrasi TA 1</a></li>
                        <li><a href="{{ route('penilaian.nilaiadmta_2') }}" class="<?php if(Request::segment(2)=='nilaiadmta_2'){ echo 'active'; } ?>">Nilai Administrasi TA 2</a></li>
                        <li><a href="{{ route('penilaian.index') }}" class="<?php if(Request::segment(1)=='penilaian' && Request::segment(2)=='' || Request::segment(2)=='nilai'){ echo 'active'; } ?>">Masukan Penilaian TA 1</a></li>
                        <li><a href="{{ route('penilaian.nilaita_2') }}" class="<?php if(Request::segment(2)=='nilaita_2' || Request::segment(2)=='nilai_ta2'){ echo 'active'; } ?>">Masukan Penilaian TA 2</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('dosenpembimbing.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='dosenpembimbing'){ echo 'active'; } ?>">
                        <span class="micon bi bi-people"></span
                        ><span class="mtext">Dosen Pembimbing</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dosenpenguji.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='dosenpenguji'){ echo 'active'; } ?>">
                        <span class="micon bi bi-people"></span
                        ><span class="mtext">Dosen Penguji</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelompok.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='kelompok'){ echo 'active'; } ?>">
                        <span class="micon bi bi-filter-square"></span
                        ><span class="mtext">Kelompok</span>
                    </a>
                </li>
            @elseif (Auth::user()->role->title=='Baak')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-files"></span> <span class="mtext">Dokumen</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('dokumen.proposal') }}" class="<?php if(Request::segment(1)=='dokumen' && Request::segment(2)=='proposal'){ echo 'active'; } ?>">Proposal</a></li>
                        <li><a href="{{ route('dokumen.tugasakhir') }}" class="<?php if(Request::segment(1)=='dokumen' && Request::segment(2)=='tugasakhir'){ echo 'active'; } ?>">Tugas Akhir</a></li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="{{ route('pengumuman.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='pengumuman'){ echo 'active'; } ?>">
                    <span class="micon bi bi-filter-square"></span
                    ><span class="mtext">Pengumuman</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}" class="dropdown-toggle no-arrow <?php if(Request::segment(1)=='user'){ echo 'active'; } ?>">
                    <span class="micon bi bi-person"></span
                    ><span class="mtext">Profil</span>
                </a>
            </li>

        </ul>
    </div>
</div>

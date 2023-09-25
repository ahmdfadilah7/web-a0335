@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<div class="card-box pd-20">
    <div class="row align-items-center">
        <div class="col-md-4">
            @if (Auth::user()->foto==NULL)
                <img src="{{ url('/images/user-profile.png') }}" stlye="width:300px">
            @else
                <img src="{{ url(Auth::user()->foto) }}" class="w-100" />
            @endif
        </div>
        <div class="col-md-8">
            <h4 class="font-20 weight-500 mb-10 text-capitalize">
                @if (Auth::user()->role->title=='Baak')
                    Hallo Pak/Ibu {{ Auth::user()->name }}
                @elseif (Auth::user()->role->title=='Dosen' || Auth::user()->role->title=='Koordinator')
                    Hallo Pak/Ibu {{ Auth::user()->name }} - {{ Auth::user()->role->title }} - {{ Auth::user()->prodi->title }}
                @else
                    Hallo {{ Auth::user()->name }} - {{ Auth::user()->role->title }} - {{ Auth::user()->prodi->title }}
                @endif
                <div class="weight-600 font-30 text-blue">Selamat Datang</div>
            </h4>
            <p class="font-18 max-width-600">
                SITA Vokasi IT DEL
            </p>
        </div>
    </div>
</div>

@if (Auth::user()->role->title != 'Baak')
    <div class="card-box pd-20 mt-30">
        <h2 class="h4 mb-20">Project Statistics</h2>
        @if (Auth::user()->role->title=='Koordinator')
            <div class="row pt-3 mb-3" style="border: 1px solid #1D69DB; border-radius: 10px; margin-left:5px; margin-right:5px;">
                <div class="col-md-10">
                    <div style="display:flex;">
                        <img src="{{ url('/images/icon-dosen.png') }}" class="mt-2" style="width:40px; height:40px;">
                        <div class="pl-3">
                            <h2 class="h5">Dosen Penguji</h2>
                            <p class="font-12">Menambahkan Dosen Penguji atau melihar Dosen Penguji</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('proposal.index') }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
            <div class="row pt-3 mb-3" style="border: 1px solid #1D69DB; border-radius: 10px; margin-left:5px; margin-right:5px;">
                <div class="col-md-10">
                    <div style="display:flex;">
                        <img src="{{ url('/images/icon-dosen.png') }}" class="mt-2" style="width:40px; height:40px;">
                        <div class="pl-3">
                            <h2 class="h5">Dosen Pembimbing</h2>
                            <p class="font-12">Menambahkan Dosen Pembimbing atau melihat Dosen Pembimbing</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('dosenpembimbing.index') }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
            <div class="row pt-3 mb-3" style="border: 1px solid #1D69DB; border-radius: 10px; margin-left:5px; margin-right:5px;">
                <div class="col-md-10">
                    <div style="display:flex;">
                        <img src="{{ url('/images/icon-mahasiswa.png') }}" class="mt-2" style="width:40px; height:40px;">
                        <div class="pl-3">
                            <h2 class="h5">Pengumuman</h2>
                            <p class="font-12">Menambahkan Pengumuman atau melihat Pengumuman</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
        @elseif (Auth::user()->role->title=='Mahasiswa')
            <div class="row pt-3 mb-3" style="border: 1px solid #1D69DB; border-radius: 10px; margin-left:5px; margin-right:5px;">
                <div class="col-md-10">
                    <div style="display:flex;">
                        <img src="{{ url('/images/icon-dokumen.png') }}" class="mt-2" style="width:40px; height:40px;">
                        <div class="pl-3">
                            <h2 class="h5">Dokumen</h2>
                            <p class="font-12">Bahan untuk bimbingan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('proposal.index') }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
            <div class="row pt-3 mb-3" style="border: 1px solid #1D69DB; border-radius: 10px; margin-left:5px; margin-right:5px;">
                <div class="col-md-10">
                    <div style="display:flex;">
                        <img src="{{ url('/images/icon-dosen.png') }}" class="mt-2" style="width:40px; height:40px;">
                        <div class="pl-3">
                            <h2 class="h5">Dosen Pembimbing</h2>
                            <p class="font-12">Pengajuan Dosen Pembimbing atau melihat Dosen Pembimbing</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('dosenpembimbing.index') }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
            <div class="row pt-3 mb-3" style="border: 1px solid #1D69DB; border-radius: 10px; margin-left:5px; margin-right:5px;">
                <div class="col-md-10">
                    <div style="display:flex;">
                        <img src="{{ url('/images/icon-mahasiswa.png') }}" class="mt-2" style="width:40px; height:40px;">
                        <div class="pl-3">
                            <h2 class="h5">Pengajuan Judul</h2>
                            <p class="font-12">Penjadwalan Seminar</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('pengajuanjudul.index') }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
        @elseif (Auth::user()->role->title=='Dosen')
            <div class="row pt-3 mb-3" style="border: 1px solid #1D69DB; border-radius: 10px; margin-left:5px; margin-right:5px;">
                <div class="col-md-10">
                    <div style="display:flex;">
                        <img src="{{ url('/images/icon-dokumen.png') }}" class="mt-2" style="width:40px; height:40px;">
                        <div class="pl-3">
                            <h2 class="h5">Pembimbing</h2>
                            <p class="font-12">Pengajuan pembimbing atau melihat pembimbing.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('pembimbing.index') }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
            <div class="row pt-3 mb-3" style="border: 1px solid #1D69DB; border-radius: 10px; margin-left:5px; margin-right:5px;">
                <div class="col-md-10">
                    <div style="display:flex;">
                        <img src="{{ url('/images/icon-dosen.png') }}" class="mt-2" style="width:40px; height:40px;">
                        <div class="pl-3">
                            <h2 class="h5">Bimbingan</h2>
                            <p class="font-12">Pengajuan bimbingan atau melihat jadwal bimbingan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('bimbingan.index') }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
            <div class="row pt-3 mb-3" style="border: 1px solid #1D69DB; border-radius: 10px; margin-left:5px; margin-right:5px;">
                <div class="col-md-10">
                    <div style="display:flex;">
                        <img src="{{ url('/images/icon-mahasiswa.png') }}" class="mt-2" style="width:40px; height:40px;">
                        <div class="pl-3">
                            <h2 class="h5">Pengajuan Judul</h2>
                            <p class="font-12">Pengajuan judul atau melihat daftar judul.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('pengajuanjudul.index') }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
        @endif
    </div>
@endif
@if (Auth::user()->role->title=='Mahasiswa')
    <div class="row mt-30">
        <div class="col-md-7">
            <div class="card-box pd-20" style="border: 2px solid #1D69DB;">
                <div style="display: flex;">
                    <img src="{{ url('/images/icon-comment.png') }}" class="mt-2" style="width:80px; height: 80px;">
                    <div class="pl-3 text-center">
                        <a href="{{ route('bimbingan.index') }}" class="btn btn-primary">Bimbingan</a>
                        <p class="font-12">Pengajuan bimbingan untuk membahas progres Tugas Akhir</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-box pd-20" style="border: 2px solid #1D69DB;">
                <div style="display: flex;">
                    <img src="{{ url('/images/icon-berkas.png') }}" class="mt-2" style="width:80px; height:80px;">
                    <div class="pl-3 text-center">
                        <a href="{{ route('artefak.index') }}" class="btn btn-primary">Artefak</a>
                        <p class="font-12">Semua berkas tugas akhir Prodi Diploma</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection

@include('layouts.partials.js')

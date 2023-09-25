<?php

namespace App\Http\Controllers;

use App\Exports\PenilaianExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Segment;
use Illuminate\Support\Str;
use App\Models\Penilaian;
use App\Models\Anggotakelompok;
use App\Models\Bimbingan;
use App\Models\NilaiAdm;
use App\Models\NilaiPembimbing;
use App\Models\NilaiPrasidang;
use App\Models\NilaiSeminar;
use App\Models\NilaiSempro;
use App\Models\NilaiSidang;
use App\Models\Tugas;
use App\Models\User;
use App\Models\Pengajuanjudul;
use App\Models\Penilaianta;

use PDF;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Menampilkan data penilaian
    public function index()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        if (Auth::user()->role->title=='Mahasiswa') {
            $penilaian = Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.mahasiswa_id', Auth::user()->id)
                    ->where('penilaiantas.status', 'TA 1')
                    ->select('penilaiantas.*', 'pengajuanjuduls.judul as tugas', 'users.name as mahasiswa', 'prodis.title as prodi')
                    ->get();
        } else {
            $penilaian = Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.prodi_id', Auth::user()->prodi_id)
                    ->where('penilaiantas.status', 'TA 1')
                    ->select('penilaiantas.*', 'pengajuanjuduls.judul as tugas', 'users.name as mahasiswa', 'prodis.title as prodi')
                    ->get();
        }
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.index', compact('penilaian', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data penilaian

    // Menampilkan data penilaian
    public function nilai_ta_2()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        if (Auth::user()->role->title=='Mahasiswa') {
            $penilaian = Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.mahasiswa_id', Auth::user()->id)
                    ->where('penilaiantas.status', 'TA 2')
                    ->select('penilaiantas.*', 'pengajuanjuduls.judul as tugas', 'users.name as mahasiswa', 'prodis.title as prodi')
                    ->get();
        } else {
            $penilaian = Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.prodi_id', Auth::user()->prodi_id)
                    ->where('penilaiantas.status', 'TA 2')
                    ->select('penilaiantas.*', 'pengajuanjuduls.judul as tugas', 'users.name as mahasiswa', 'prodis.title as prodi')
                    ->get();
        }
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.index', compact('penilaian', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data penilaian

    public function export_ta_1()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            return (new PenilaianExport)->download('Nilai-TA-1-'.Auth::user()->name.'-'.Str::random(5).'.xlsx');
        } elseif (Auth::user()->role->title=='Koordinator') {
            return (new PenilaianExport)->download('Nilai-TA-1-'.Auth::user()->prodi->title.'-'.Str::random(5).'.xlsx');
        }
    }

    public function export_ta_2()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            return (new PenilaianExport)->download('Nilai-TA-2-'.Auth::user()->name.'-'.Str::random(5).'.xlsx');
        } elseif (Auth::user()->role->title=='Koordinator') {
            return (new PenilaianExport)->download('Nilai-TA-2-'.Auth::user()->prodi->title.'-'.Str::random(5).'.xlsx');
        }
    }

    public function export_pdf_ta_1()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $penilaian = Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.mahasiswa_id', Auth::user()->id)            
                    ->where('penilaiantas.status', 'TA 1')
                    ->select('penilaiantas.*', 'users.name as mahasiswa', 'prodis.title as prodi', 'pengajuanjuduls.judul as judul')
                    ->get();
            $pdf = PDF::loadview('penilaian.pdf', compact('penilaian'));
            return $pdf->download('Nilai-TA-1-'.Auth::user()->name.'-'.Str::random(5).'.pdf');

        } elseif (Auth::user()->role->title=='Koordinator') {
            $penilaian = Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.prodi_id', Auth::user()->prodi_id)
                    ->where('penilaiantas.status', 'TA 1')
                    ->select('penilaiantas.*', 'users.name as mahasiswa', 'prodis.title as prodi', 'pengajuanjuduls.judul as judul')
                    ->get();
            $pdf = PDF::loadview('penilaian.pdf', compact('penilaian'));
            return $pdf->download('Nilai-TA-1-'.Auth::user()->prodi->title.'-'.Str::random(5).'.pdf');
        }
    }

    public function export_pdf_ta_2()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $penilaian = Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.mahasiswa_id', Auth::user()->id)            
                    ->where('penilaiantas.status', 'TA 2')
                    ->select('penilaiantas.*', 'users.name as mahasiswa', 'prodis.title as prodi', 'pengajuanjuduls.judul as judul')
                    ->get();
            $pdf = PDF::loadview('penilaian.pdf', compact('penilaian'));
            return $pdf->download('Nilai-TA-2-'.Auth::user()->name.'-'.Str::random(5).'.pdf');

        } elseif (Auth::user()->role->title=='Koordinator') {
            $penilaian = Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.prodi_id', Auth::user()->prodi_id)
                    ->where('penilaiantas.status', 'TA 2')
                    ->select('penilaiantas.*', 'users.name as mahasiswa', 'prodis.title as prodi', 'pengajuanjuduls.judul as judul')
                    ->get();
            $pdf = PDF::loadview('penilaian.pdf', compact('penilaian'));
            return $pdf->download('Nilai-TA-2-'.Auth::user()->prodi->title.'-'.Str::random(5).'.pdf');
        }
    }

    // Menampilkan data nilai seminar proposal penguji
    public function sempro_penguji()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }
        
        $sempro = NilaiSempro::join('users', 'nilai_sempros.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_sempros.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_sempros.prodi_id', 'prodis.id')
            ->where('nilai_sempros.dosen_id', Auth::user()->id)
            ->where('nilai_sempros.penilai', 'Penguji')
            ->select('nilai_sempros.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.sempro', compact('sempro', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai seminar proposal penguji

    // Menampilkan data nilai seminar proposal pembimbing
    public function sempro_pembimbing()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }
        
        $sempro = NilaiSempro::join('users', 'nilai_sempros.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_sempros.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_sempros.prodi_id', 'prodis.id')
            ->where('nilai_sempros.dosen_id', Auth::user()->id)
            ->where('nilai_sempros.penilai', 'Pembimbing')
            ->select('nilai_sempros.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.sempro', compact('sempro', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai seminar proposal pembimbing

    // Menampilkan data nilai seminar TA 1 penguji
    public function seminar_penguji()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        $seminar = NilaiSeminar::join('users', 'nilai_seminars.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_seminars.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_seminars.prodi_id', 'prodis.id')
            ->where('nilai_seminars.dosen_id', Auth::user()->id)
            ->where('nilai_seminars.penilai', 'Penguji')
            ->select('nilai_seminars.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.seminar', compact('seminar', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai seminar TA 1 penguji    

    // Menampilkan data nilai seminar TA 1 Pembimbing
    public function seminar_pembimbing()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        $seminar = NilaiSeminar::join('users', 'nilai_seminars.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_seminars.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_seminars.prodi_id', 'prodis.id')
            ->where('nilai_seminars.dosen_id', Auth::user()->id)
            ->where('nilai_seminars.penilai', 'Pembimbing')
            ->select('nilai_seminars.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.seminar', compact('seminar', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai seminar TA 1 Pembimbing  

    // Menampilkan data nilai Pra Sidang TA 2 penguji
    public function prasidang_penguji()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        $prasidang = NilaiPrasidang::join('users', 'nilai_prasidangs.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_prasidangs.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_prasidangs.prodi_id', 'prodis.id')
            ->where('nilai_prasidangs.dosen_id', Auth::user()->id)
            ->where('nilai_prasidangs.penilai', 'Penguji')
            ->select('nilai_prasidangs.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.prasidang', compact('prasidang', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai Pra Sidang TA 2 penguji    

    // Menampilkan data nilai Pra Sidang TA 2 Pembimbing
    public function prasidang_pembimbing()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        $prasidang = NilaiPrasidang::join('users', 'nilai_prasidangs.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_prasidangs.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_prasidangs.prodi_id', 'prodis.id')
            ->where('nilai_prasidangs.dosen_id', Auth::user()->id)
            ->where('nilai_prasidangs.penilai', 'Pembimbing')
            ->select('nilai_prasidangs.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.prasidang', compact('prasidang', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai Pra Sidang TA 2 Pembimbing
    
    // Menampilkan data nilai Sidang TA 2 penguji
    public function sidang_penguji()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        $sidang = NilaiSidang::join('users', 'nilai_sidangs.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_sidangs.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_sidangs.prodi_id', 'prodis.id')
            ->where('nilai_sidangs.dosen_id', Auth::user()->id)
            ->where('nilai_sidangs.penilai', 'Penguji')
            ->select('nilai_sidangs.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.sidang', compact('sidang', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai Sidang TA 2 penguji    

    // Menampilkan data nilai Sidang TA 2 Pembimbing
    public function sidang_pembimbing()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        $sidang = NilaiSidang::join('users', 'nilai_sidangs.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_sidangs.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_sidangs.prodi_id', 'prodis.id')
            ->where('nilai_sidangs.dosen_id', Auth::user()->id)
            ->where('nilai_sidangs.penilai', 'Pembimbing')
            ->select('nilai_sidangs.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.sidang', compact('sidang', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai Sidang TA 2 Pembimbing
    
    // Menampilkan data nilai Pembimbing TA 1 dari Pembimbing
    public function nilai_pembimbing_ta_1()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        $nilaipembimbing = NilaiPembimbing::join('users', 'nilai_pembimbings.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_pembimbings.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_pembimbings.prodi_id', 'prodis.id')
            ->where('nilai_pembimbings.dosen_id', Auth::user()->id)
            ->where('nilai_pembimbings.status', 'TA 1')
            ->select('nilai_pembimbings.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.nilaipembimbing', compact('nilaipembimbing', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai Pembimbing TA 1 dari Pembimbing
    
    // Menampilkan data nilai Pembimbing TA 2 dari Pembimbing
    public function nilai_pembimbing_ta_2()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        $nilaipembimbing = NilaiPembimbing::join('users', 'nilai_pembimbings.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_pembimbings.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_pembimbings.prodi_id', 'prodis.id')
            ->where('nilai_pembimbings.dosen_id', Auth::user()->id)
            ->where('nilai_pembimbings.status', 'TA 2')
            ->select('nilai_pembimbings.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.nilaipembimbing', compact('nilaipembimbing', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai Pembimbing TA 2 dari Pembimbing

    // Menampilkan data nilai Administrasi TA 1 dari Koordinator
    public function nilai_adm_ta_1()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        $nilaiadm = NilaiAdm::join('users', 'nilai_adms.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_adms.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_adms.prodi_id', 'prodis.id')
            ->where('nilai_adms.koordinator_id', Auth::user()->id)
            ->where('nilai_adms.status', 'TA 1')
            ->select('nilai_adms.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.nilaiadm', compact('nilaiadm', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai Administrasi TA 1 dari Koordinator
    
    // Menampilkan data nilai Administrasi TA 2 dari Koordinator
    public function nilai_adm_ta_2()
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }

        $nilaiadm = NilaiAdm::join('users', 'nilai_adms.mahasiswa_id', 'users.id')
            ->join('pengajuanjuduls', 'nilai_adms.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('prodis', 'nilai_adms.prodi_id', 'prodis.id')
            ->where('nilai_adms.koordinator_id', Auth::user()->id)
            ->where('nilai_adms.status', 'TA 2')
            ->select('nilai_adms.*', 'users.name as mahasiswa_name', 'pengajuanjuduls.judul', 'prodis.title as prodi')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.nilaiadm', compact('nilaiadm', 'tugas', 'judul', 'mahasiswa', 'calendar', 'deadline'));
    }
    // Menampilkan data nilai Administrasi TA 2 dari Koordinator

    // Menambahkan nilai seminar proposal dari penguji
    public function add_sempro_penguji(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $penilai = 'Penguji';
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai = ($nilai_1*40/100)+($nilai_2*5/100)+($nilai_3*5/100)+($nilai_4*50/100);
        $total_nilai = $nilai;

        NilaiSempro::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'penilai' => $penilai,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.sempropenguji')->with('success', 'Berhasil memasukan nilai seminar proposal');
    }
    // Menambahkan nilai seminar proposal dari penguji

    // Menambahkan nilai seminar proposal dari pembimbing
    public function add_sempro_pembimbing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $penilai = 'Pembimbing';
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai = ($nilai_1*40/100)+($nilai_2*5/100)+($nilai_3*5/100)+($nilai_4*50/100);
        $total_nilai = $nilai;

        NilaiSempro::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'penilai' => $penilai,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.sempropembimbing')->with('success', 'Berhasil memasukan nilai seminar proposal');
    }
    // Menambahkan nilai seminar proposal dari pembimbing

    // Menampilkan data seminar proposal
    public function edit_sempro($id)
    {
        $sempro = NilaiSempro::join('pengajuanjuduls', 'nilai_sempros.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('users', 'nilai_sempros.mahasiswa_id', 'users.id')
            ->select('nilai_sempros.*', 'users.name as mahasiswa', 'pengajuanjuduls.judul')
            ->find($id);

        return response()->json($sempro);
    }

    public function update_sempro(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $id = $request->get('sempro_id');
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai = ($nilai_1*40/100)+($nilai_2*5/100)+($nilai_3*5/100)+($nilai_4*50/100);
        $total_nilai = $nilai;

        $sempro = NilaiSempro::find($id);
        $sempro->nilai_1 = $nilai_1;
        $sempro->nilai_2 = $nilai_2;
        $sempro->nilai_3 = $nilai_3;
        $sempro->nilai_4 = $nilai_4;
        $sempro->total_nilai = round($total_nilai, 2);
        $sempro->save();

        if ($sempro->penilai=='Pembimbing') {
            return redirect()->route('penilaian.sempropembimbing')->with('success', 'Berhasil merubah nilai seminar proposal.');
        } else {
            return redirect()->route('penilaian.sempropenguji')->with('success', 'Berhasil merubah nilai seminar proposal.');
        }

    }
    
    // Menambahkan nilai seminar TA 1 dari penguji
    public function add_seminar_penguji(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $penilai = 'Penguji';
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai = ($nilai_1*40/100)+($nilai_2*5/100)+($nilai_3*5/100)+($nilai_4*50/100);
        $total_nilai = $nilai;

        NilaiSeminar::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'penilai' => $penilai,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.seminarpenguji')->with('success', 'Berhasil memasukan nilai seminar TA 1');
    }
    // Menambahkan nilai seminar TA 1 dari penguji

    // Menambahkan nilai seminar TA 1 dari pembimbing
    public function add_seminar_pembimbing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $penilai = 'Pembimbing';
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai = ($nilai_1*40/100)+($nilai_2*5/100)+($nilai_3*5/100)+($nilai_4*50/100);
        $total_nilai = $nilai;

        NilaiSeminar::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'penilai' => $penilai,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.seminarpembimbing')->with('success', 'Berhasil memasukan nilai seminar TA 1');
    }
    // Menambahkan nilai seminar TA 1 dari pembimbing

    // Menampilkan data seminar
    public function edit_seminar($id)
    {
        $seminar = NilaiSeminar::join('pengajuanjuduls', 'nilai_seminars.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('users', 'nilai_seminars.mahasiswa_id', 'users.id')
            ->select('nilai_seminars.*', 'users.name as mahasiswa', 'pengajuanjuduls.judul')
            ->find($id);

        return response()->json($seminar);
    }

    public function update_seminar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $id = $request->get('seminar_id');
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai = ($nilai_1*40/100)+($nilai_2*5/100)+($nilai_3*5/100)+($nilai_4*50/100);
        $total_nilai = $nilai;

        $sempro = NilaiSeminar::find($id);
        $sempro->nilai_1 = $nilai_1;
        $sempro->nilai_2 = $nilai_2;
        $sempro->nilai_3 = $nilai_3;
        $sempro->nilai_4 = $nilai_4;
        $sempro->total_nilai = round($total_nilai, 2);
        $sempro->save();

        if ($sempro->penilai=='Pembimbing') {
            return redirect()->route('penilaian.seminarpembimbing')->with('success', 'Berhasil merubah nilai seminar.');
        } else {
            return redirect()->route('penilaian.seminarpenguji')->with('success', 'Berhasil merubah nilai seminar.');
        }

    }

    // Menambahkan nilai Pra Sidang TA 2 dari penguji
    public function add_prasidang_penguji(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
            'nilai_5' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $penilai = 'Penguji';
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai_5 = $request->get('nilai_5');
        $nilai = ($nilai_1*20/100)+($nilai_2*5/100)+($nilai_3*10/100)+($nilai_4*5/100)+($nilai_5*60/100);
        $total_nilai = $nilai;

        NilaiPrasidang::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'penilai' => $penilai,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'nilai_5' => $nilai_5,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.prasidangpenguji')->with('success', 'Berhasil memasukan nilai Pra Sidang TA 2 Penguji');
    }
    // Menambahkan nilai Pra Sidang TA 2 dari penguji

    // Menambahkan nilai Pra Sidang TA 2 dari pembimbing
    public function add_prasidang_pembimbing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
            'nilai_5' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $penilai = 'Pembimbing';
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai_5 = $request->get('nilai_5');
        $nilai = ($nilai_1*20/100)+($nilai_2*5/100)+($nilai_3*10/100)+($nilai_4*5/100)+($nilai_5*60/100);
        $total_nilai = $nilai;

        NilaiPrasidang::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'penilai' => $penilai,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'nilai_5' => $nilai_5,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.prasidangpembimbing')->with('success', 'Berhasil memasukan nilai Pra Sidang TA 2 Pembimbing');
    }
    // Menambahkan nilai Pra Sidang TA 2 dari pembimbing

    // Menampilkan data pra sidang
    public function edit_prasidang($id)
    {
        $prasidang = NilaiPrasidang::join('pengajuanjuduls', 'nilai_prasidangs.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('users', 'nilai_prasidangs.mahasiswa_id', 'users.id')
            ->select('nilai_prasidangs.*', 'users.name as mahasiswa', 'pengajuanjuduls.judul')
            ->find($id);

        return response()->json($prasidang);
    }

    public function update_prasidang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
            'nilai_5' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $id = $request->get('prasidang_id');
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai_5 = $request->get('nilai_5');
        $nilai = ($nilai_1*20/100)+($nilai_2*5/100)+($nilai_3*10/100)+($nilai_4*5/100)+($nilai_5*60/100);
        $total_nilai = $nilai;

        $prasidang = NilaiPrasidang::find($id);
        $prasidang->nilai_1 = $nilai_1;
        $prasidang->nilai_2 = $nilai_2;
        $prasidang->nilai_3 = $nilai_3;
        $prasidang->nilai_4 = $nilai_4;
        $prasidang->nilai_5 = $nilai_5;
        $prasidang->total_nilai = round($total_nilai, 2);
        $prasidang->save();

        if ($prasidang->penilai=='Pembimbing') {
            return redirect()->route('penilaian.prasidangpembimbing')->with('success', 'Berhasil merubah nilai pra sidang.');
        } else {
            return redirect()->route('penilaian.prasidangpenguji')->with('success', 'Berhasil merubah nilai pra sidang.');
        }

    }

    // Menambahkan nilai Sidang TA 2 dari penguji
    public function add_sidang_penguji(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
            'nilai_5' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $penilai = 'Penguji';
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai_5 = $request->get('nilai_5');
        $nilai = ($nilai_1*20/100)+($nilai_2*5/100)+($nilai_3*10/100)+($nilai_4*5/100)+($nilai_5*60/100);
        $total_nilai = $nilai;

        NilaiSidang::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'penilai' => $penilai,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'nilai_5' => $nilai_5,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.sidangpenguji')->with('success', 'Berhasil memasukan nilai Sidang TA 2 Penguji');
    }
    // Menambahkan nilai Sidang TA 2 dari penguji

    // Menambahkan nilai Sidang TA 2 dari pembimbing
    public function add_sidang_pembimbing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
            'nilai_5' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $penilai = 'Pembimbing';
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai_5 = $request->get('nilai_5');
        $nilai = ($nilai_1*20/100)+($nilai_2*5/100)+($nilai_3*10/100)+($nilai_4*5/100)+($nilai_5*60/100);
        $total_nilai = $nilai;

        NilaiSidang::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'penilai' => $penilai,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'nilai_5' => $nilai_5,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.sidangpembimbing')->with('success', 'Berhasil memasukan nilai Sidang TA 2 Pembimbing');
    }
    // Menambahkan nilai Sidang TA 2 dari pembimbing

    // Menampilkan data sidang
    public function edit_sidang($id)
    {
        $prasidang = NilaiSidang::join('pengajuanjuduls', 'nilai_sidangs.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('users', 'nilai_sidangs.mahasiswa_id', 'users.id')
            ->select('nilai_sidangs.*', 'users.name as mahasiswa', 'pengajuanjuduls.judul')
            ->find($id);

        return response()->json($prasidang);
    }

    public function update_sidang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
            'nilai_5' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $id = $request->get('sidang_id');
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai_5 = $request->get('nilai_5');
        $nilai = ($nilai_1*20/100)+($nilai_2*5/100)+($nilai_3*10/100)+($nilai_4*5/100)+($nilai_5*60/100);
        $total_nilai = $nilai;

        $sidang = NilaiSidang::find($id);
        $sidang->nilai_1 = $nilai_1;
        $sidang->nilai_2 = $nilai_2;
        $sidang->nilai_3 = $nilai_3;
        $sidang->nilai_4 = $nilai_4;
        $sidang->nilai_5 = $nilai_5;
        $sidang->total_nilai = round($total_nilai, 2);
        $sidang->save();

        if ($sidang->penilai=='Pembimbing') {
            return redirect()->route('penilaian.sidangpembimbing')->with('success', 'Berhasil merubah nilai sidang.');
        } else {
            return redirect()->route('penilaian.sidangpenguji')->with('success', 'Berhasil merubah nilai sidang.');
        }

    }

    // Menambahkan nilai Pembimbing TA 1 dari pembimbing
    public function add_nilai_pembimbing_ta_1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
            'nilai_5' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $status = 'TA 1';
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai_5 = $request->get('nilai_5');
        $nilai = ($nilai_1*20/100)+($nilai_2*20/100)+($nilai_3*30/100)+($nilai_4*20/100)+($nilai_5*10/100);
        $total_nilai = $nilai;

        NilaiPembimbing::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'status' => $status,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'nilai_5' => $nilai_5,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.nilaipembimbingta_1')->with('success', 'Berhasil memasukan nilai pembimbing TA 1');
    }
    // Menambahkan nilai Pembimbing TA 1 dari pembimbing

    // Menambahkan nilai Pembimbing TA 2 dari pembimbing
    public function add_nilai_pembimbing_ta_2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
            'nilai_5' => 'required',
            'nilai_6' => 'required',
            'nilai_7' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $status = 'TA 2';
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai_5 = $request->get('nilai_5');
        $nilai_6 = $request->get('nilai_6');
        $nilai_7 = $request->get('nilai_7');
        $nilai = ($nilai_1*5/100)+($nilai_2*5/100)+($nilai_3*10/100)+($nilai_4*10/100)+($nilai_5*25/100)+($nilai_6*20/100)+($nilai_7*25/100);
        $total_nilai = $nilai;

        NilaiPembimbing::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'status' => $status,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'nilai_3' => $nilai_3,
            'nilai_4' => $nilai_4,
            'nilai_5' => $nilai_5,
            'nilai_6' => $nilai_6,
            'nilai_7' => $nilai_7,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.nilaipembimbingta_2')->with('success', 'Berhasil memasukan nilai pembimbing TA 2');
    }
    // Menambahkan nilai Pembimbing TA 2 dari pembimbing

    // Menampilkan data nilai pembimbing
    public function edit_pembimbing($id)
    {
        $prasidang = NilaiPembimbing::join('pengajuanjuduls', 'nilai_pembimbings.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('users', 'nilai_pembimbings.mahasiswa_id', 'users.id')
            ->select('nilai_pembimbings.*', 'users.name as mahasiswa', 'pengajuanjuduls.judul')
            ->find($id);

        return response()->json($prasidang);
    }

    public function update_pembimbing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'nilai_3' => 'required',
            'nilai_4' => 'required',
            'nilai_5' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $id = $request->get('pembimbing_id');
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $nilai_3 = $request->get('nilai_3');
        $nilai_4 = $request->get('nilai_4');
        $nilai_5 = $request->get('nilai_5');

        $pembimbing = NilaiPembimbing::find($id);
        $pembimbing->nilai_1 = $nilai_1;
        $pembimbing->nilai_2 = $nilai_2;
        $pembimbing->nilai_3 = $nilai_3;
        $pembimbing->nilai_4 = $nilai_4;
        $pembimbing->nilai_5 = $nilai_5;

        if($pembimbing->status=='TA 1') {
            $nilai = ($nilai_1*20/100)+($nilai_2*5/100)+($nilai_3*10/100)+($nilai_4*5/100)+($nilai_5*60/100);
            $total_nilai = $nilai;
        } else {
            $nilai_6 = $request->get('nilai_6');
            $nilai_7 = $request->get('nilai_7');
            $nilai = ($nilai_1*5/100)+($nilai_2*5/100)+($nilai_3*10/100)+($nilai_4*10/100)+($nilai_5*25/100)+($nilai_6*20/100)+($nilai_7*25/100);
            $total_nilai = $nilai;

            $pembimbing->nilai_6 = $nilai_6;
            $pembimbing->nilai_7 = $nilai_7;
        }
        $pembimbing->total_nilai = round($total_nilai, 2);
        $pembimbing->save();
        


        if ($pembimbing->status=='TA 1') {
            return redirect()->route('penilaian.nilaipembimbingta_1')->with('success', 'Berhasil merubah nilai pembimbing.');
        } else {
            return redirect()->route('penilaian.nilaipembimbingta_2')->with('success', 'Berhasil merubah nilai pembimbing.');
        }

    }

    // Menambahkan nilai Administrasi TA 1 dari koordinator
    public function add_nilai_adm_ta_1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'submit_dokumen_1' => 'required',
            'schedule_1' => 'required',
            'reschedule_1' => 'required',
            'ulang_1' => 'required',
            'submit_dokumen_2' => 'required',
            'schedule_2' => 'required',
            'reschedule_2' => 'required',
            'ulang_2' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'persentase' => 'required',
            'persentase_2' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $status = 'TA 1';
        $submit_dokumen_1 = $request->get('submit_dokumen_1');
        $schedule_1 = $request->get('schedule_1');
        $reschedule_1 = $request->get('reschedule_1');
        $ulang_1 = $request->get('ulang_1');
        $submit_dokumen_2 = $request->get('submit_dokumen_2');
        $schedule_2 = $request->get('schedule_2');
        $reschedule_2 = $request->get('reschedule_2');
        $ulang_2 = $request->get('ulang_2');
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $persentase = $request->get('persentase');
        $persentase_2 = $request->get('persentase_2');
        $nilai = ($nilai_1*$persentase/100)+($nilai_2*$persentase_2/100);
        $total_nilai = $nilai/2;

        NilaiAdm::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'koordinator_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'status' => $status,
            'submit_dokumen_1' => $submit_dokumen_1,
            'schedule_1' => $schedule_1,
            'reschedule_1' => $reschedule_1,
            'ulang_1' => $ulang_1,
            'submit_dokumen_2' => $submit_dokumen_2,
            'schedule_2' => $schedule_2,
            'reschedule_2' => $reschedule_2,
            'ulang_2' => $ulang_2,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'persentase' => $persentase,
            'persentase_2' => $persentase_2,
            'total_nilai' => round($total_nilai, 2)
        ]);

        return redirect()->route('penilaian.nilaiadmta_1')->with('success', 'Berhasil memasukan nilai Administrasi TA 1');
    }
    // Menambahkan nilai Administrasi TA 1 dari koordinator

    // Menambahkan nilai Administrasi TA 2 dari koordinator
    public function add_nilai_adm_ta_2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'submit_dokumen_1' => 'required',
            'schedule_1' => 'required',
            'reschedule_1' => 'required',
            'ulang_1' => 'required',
            'submit_dokumen_2' => 'required',
            'schedule_2' => 'required',
            'reschedule_2' => 'required',
            'ulang_2' => 'required',
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'persentase' => 'required',
            'persentase_2' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $mahasiswa_id = $request->get('mahasiswa_id');
        $dosen_id = Auth::user()->id;
        $prodi_id = Auth::user()->prodi_id;
        $pengajuanjudul_id = $request->get('pengajuanjudul_id');
        $status = 'TA 2';
        $submit_dokumen_1 = $request->get('submit_dokumen_1');
        $schedule_1 = $request->get('schedule_1');
        $reschedule_1 = $request->get('reschedule_1');
        $ulang_1 = $request->get('ulang_1');
        $submit_dokumen_2 = $request->get('submit_dokumen_2');
        $schedule_2 = $request->get('schedule_2');
        $reschedule_2 = $request->get('reschedule_2');
        $ulang_2 = $request->get('ulang_2');
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $persentase = $request->get('persentase');
        $persentase_2 = $request->get('persentase_2');
        $nilai = ($nilai_1*$persentase/100)+($nilai_2*$persentase_2/100);
        $total_nilai = $nilai/2;

        NilaiAdm::create([
            'pengajuanjudul_id' => $pengajuanjudul_id,
            'mahasiswa_id' => $mahasiswa_id,
            'koordinator_id' => $dosen_id,
            'prodi_id' => $prodi_id,
            'status' => $status,
            'submit_dokumen_1' => $submit_dokumen_1,
            'schedule_1' => $schedule_1,
            'reschedule_1' => $reschedule_1,
            'ulang_1' => $ulang_1,
            'submit_dokumen_2' => $submit_dokumen_2,
            'schedule_2' => $schedule_2,
            'reschedule_2' => $reschedule_2,
            'ulang_2' => $ulang_2,
            'nilai_1' => $nilai_1,
            'nilai_2' => $nilai_2,
            'persentase' => $persentase,
            'persentase_2' => $persentase_2,
            'total_nilai' => round($total_nilai,2)
        ]);

        return redirect()->route('penilaian.nilaiadmta_2')->with('success', 'Berhasil memasukan nilai Administrasi TA 2');
    }
    // Menambahkan nilai Administrasi TA 2 dari koordinator

    // Menampilkan data nilai adm
    public function edit_nilaiadm($id)
    {
        $prasidang = NilaiAdm::join('pengajuanjuduls', 'nilai_adms.pengajuanjudul_id', 'pengajuanjuduls.id')
            ->join('users', 'nilai_adms.mahasiswa_id', 'users.id')
            ->select('nilai_adms.*', 'users.name as mahasiswa', 'pengajuanjuduls.judul')
            ->find($id);

        return response()->json($prasidang);
    }

    public function update_nilaiadm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nilai_1' => 'required',
            'nilai_2' => 'required',
            'persentase' => 'required',
            'persentase_2' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $id = $request->get('nilaiadm_id');
        $submit_dokumen_1 = $request->get('submit_dokumen_1');
        $schedule_1 = $request->get('schedule_1');
        $reschedule_1 = $request->get('reschedule_1');
        $ulang_1 = $request->get('ulang_1');
        $submit_dokumen_2 = $request->get('submit_dokumen_2');
        $schedule_2 = $request->get('schedule_2');
        $reschedule_2 = $request->get('reschedule_2');
        $ulang_2 = $request->get('ulang_2');
        $nilai_1 = $request->get('nilai_1');
        $nilai_2 = $request->get('nilai_2');
        $persentase = $request->get('persentase');
        $persentase_2 = $request->get('persentase_2');

        $nilaiadm = NilaiAdm::find($id);
        $nilaiadm->submit_dokumen_1 = $submit_dokumen_1;
        $nilaiadm->schedule_1 = $schedule_1;
        $nilaiadm->reschedule_1 = $reschedule_1;
        $nilaiadm->ulang_1 = $ulang_1;
        $nilaiadm->submit_dokumen_2 = $submit_dokumen_2;
        $nilaiadm->schedule_2 = $schedule_2;
        $nilaiadm->reschedule_2 = $reschedule_2;
        $nilaiadm->ulang_2 = $ulang_2;
        $nilaiadm->nilai_1 = $nilai_1;
        $nilaiadm->nilai_2 = $nilai_2;
        $nilaiadm->persentase = $persentase;
        $nilaiadm->persentase_2 = $persentase_2;
        
        $nilai = ($nilai_1*$persentase/100)+($nilai_2*$persentase_2/100);
        $total_nilai = $nilai/2;

        $nilaiadm->total_nilai = round($total_nilai, 2);
        $nilaiadm->save();

        if ($nilaiadm->status=='TA 1') {
            return redirect()->route('penilaian.nilaiadmta_1')->with('success', 'Berhasil merubah nilai administrasi.');
        } else {
            return redirect()->route('penilaian.nilaiadmta_2')->with('success', 'Berhasil merubah nilai administrasi.');
        }

    }

    // Menampilkan Detail Data Nilai
    public function detail_nilai($id)
    {        
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }
        $penilaian = Penilaianta::where('id', $id)
            ->where('status', 'TA 1')
            ->first();
        $judul = Pengajuanjudul::where('id', $penilaian->pengajuanjudul_id)->first();
        $mahasiswa = User::where('id', $penilaian->mahasiswa_id)->first();
        return view('penilaian.detailpenilaian', compact('judul', 'mahasiswa', 'penilaian', 'calendar', 'deadline'));
    }
    // Menampilkan Detail Data Nilai

    // Menampilkan Detail Data Nilai
    public function detail_nilai_ta2($id)
    {        
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }
        $penilaian = Penilaianta::where('id', $id)
            ->where('status', 'TA 2')
            ->first();
        $judul = Pengajuanjudul::where('id', $penilaian->pengajuanjudul_id)->first();
        $mahasiswa = User::where('id', $penilaian->mahasiswa_id)->first();
        return view('penilaian.detailpenilaian', compact('judul', 'mahasiswa', 'penilaian', 'calendar', 'deadline'));
    }
    // Menampilkan Detail Data Nilai

    // Mengambil Data Nilai
    public function nilai()
    {        
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.addpenilaian', compact('tugas', 'judul', 'mahasiswa'));
    }
    // Mengambil Data Nilai

    // Mengambil Data Nilai
    public function nilai_ta2()
    {        
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '0')
                ->get();
        $judul = Pengajuanjudul::where('prodi_id', Auth::user()->prodi_id)
                ->where('status', '1')
                ->get();
        $mahasiswa = User::where('prodi_id', Auth::user()->prodi_id)
                ->where('role_id', '1')
                ->get();
        return view('penilaian.addpenilaian', compact('tugas', 'judul', 'mahasiswa'));
    }
    // Mengambil Data Nilai

    // Mengambil Data Penilaian dari Tabel - Tabel Lain
    public function get_nilai($id, $judulid)
    {
        if ($id == 0 || $judulid == 0) {
            $pengajuanjudul = null;
        } else {
            $pengajuanjudul = Pengajuanjudul::where('mahasiswa_id', $id)
                ->where('id', $judulid)
                ->where('status', '1')
                ->first();            
        }
        $sempropembimbing = NilaiSempro::join('users', 'nilai_sempros.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('penilai', 'Pembimbing')
            ->where('nilai_sempros.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_sempros.*', 'users.name as dosen_name')
            ->get();
        $sempropenguji = NilaiSempro::join('users', 'nilai_sempros.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('penilai', 'Penguji')
            ->where('nilai_sempros.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_sempros.*', 'users.name as dosen_name')
            ->get();
        $seminarpembimbing = NilaiSeminar::join('users', 'nilai_seminars.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('penilai', 'Pembimbing')
            ->where('nilai_seminars.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_seminars.*', 'users.name as dosen_name')
            ->get();
        $seminarpenguji = NilaiSeminar::join('users', 'nilai_seminars.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('penilai', 'Penguji')
            ->where('nilai_seminars.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_seminars.*', 'users.name as dosen_name')
            ->get();
        $nilaipembimbing = NilaiPembimbing::join('users', 'nilai_pembimbings.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('status', 'TA 1')
            ->where('nilai_pembimbings.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_pembimbings.*', 'users.name as dosen_name')
            ->get();
        $nilaiadm = NilaiAdm::join('users', 'nilai_adms.koordinator_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('status', 'TA 1')
            ->where('nilai_adms.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_adms.*', 'users.name as dosen_name')
            ->get();

        return json_encode([
            'pengajuan' => $pengajuanjudul, 
            'sempropembimbing' => $sempropembimbing, 
            'sempropenguji' => $sempropenguji,
            'seminarpembimbing' => $seminarpembimbing,
            'seminarpenguji' => $seminarpenguji,
            'nilaipembimbing' => $nilaipembimbing,
            'nilaiadm' => $nilaiadm,
        ]);
    }
    // Mengambil Data Penilaian dari Tabel - Tabel Lain

    // Mengambil Data Penilaian dari Tabel - Tabel Lain
    public function get_nilai_ta2($id, $judulid)
    {
        if ($id == 0 || $judulid == 0) {
            $pengajuanjudul = null;
        } else {
            $pengajuanjudul = Pengajuanjudul::where('mahasiswa_id', $id)
                ->where('id', $judulid)
                ->where('status', '1')
                ->first();            
        }
        $sempropembimbing = NilaiPrasidang::join('users', 'nilai_prasidangs.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('penilai', 'Pembimbing')
            ->where('nilai_prasidangs.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_prasidangs.*', 'users.name as dosen_name')
            ->get();
        $sempropenguji = NilaiPrasidang::join('users', 'nilai_prasidangs.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('penilai', 'Penguji')
            ->where('nilai_prasidangs.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_prasidangs.*', 'users.name as dosen_name')
            ->get();
        $seminarpembimbing = NilaiSidang::join('users', 'nilai_sidangs.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('penilai', 'Pembimbing')
            ->where('nilai_sidangs.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_sidangs.*', 'users.name as dosen_name')
            ->get();
        $seminarpenguji = NilaiSidang::join('users', 'nilai_sidangs.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('penilai', 'Penguji')
            ->where('nilai_sidangs.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_sidangs.*', 'users.name as dosen_name')
            ->get();
        $nilaipembimbing = NilaiPembimbing::join('users', 'nilai_pembimbings.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('status', 'TA 2')
            ->where('nilai_pembimbings.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_pembimbings.*', 'users.name as dosen_name')
            ->get();
        $nilaiadm = NilaiAdm::join('users', 'nilai_adms.koordinator_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $judulid)
            ->where('status', 'TA 2')
            ->where('nilai_adms.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_adms.*', 'users.name as dosen_name')
            ->get();

        return json_encode([
            'pengajuan' => $pengajuanjudul, 
            'sempropembimbing' => $sempropembimbing, 
            'sempropenguji' => $sempropenguji,
            'seminarpembimbing' => $seminarpembimbing,
            'seminarpenguji' => $seminarpenguji,
            'nilaipembimbing' => $nilaipembimbing,
            'nilaiadm' => $nilaiadm,
        ]);
    }
    // Mengambil Data Penilaian dari Tabel - Tabel Lain

    // Mengambil Data Penilaian dari Tabel - Tabel Lain
    public function get_adm($id)
    {
        $pengajuanjudul = Pengajuanjudul::where('mahasiswa_id', $id)
            ->where('status', '1')
            ->first();
        $sempro = NilaiSempro::join('users', 'nilai_sempros.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $pengajuanjudul->id)
            ->where('nilai_sempros.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_sempros.*', 'users.name as dosen_name')
            ->get();
        $nilaisempro = array();
        foreach ($sempro as $key => $value) {
            $nilaisempro[$key] = $value->total_nilai;
        }
        $total_nilaisempro = ($nilaisempro[0]+$nilaisempro[1]+$nilaisempro[2]+$nilaisempro[3])/4;
        
        $seminar = NilaiSeminar::join('users', 'nilai_seminars.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $pengajuanjudul->id)
            ->where('nilai_seminars.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_seminars.*', 'users.name as dosen_name')
            ->get();
        $nilaiseminar = array();
        foreach ($seminar as $key => $value) {
            $nilaiseminar[$key] = $value->total_nilai;
        }     
        $total_nilaiseminar = ($nilaiseminar[0]+$nilaiseminar[1]+$nilaiseminar[2]+$nilaiseminar[3])/4;

        return json_encode([
            'pengajuanjudul_id' => $pengajuanjudul->id,
            'pengajuanjudul_name' => $pengajuanjudul->judul,
            'nilai_sempro' => round($total_nilaisempro,2),
            'nilai_seminar' => round($total_nilaiseminar,2),
        ]);
    }
    // Mengambil Data Penilaian dari Tabel - Tabel Lain

    // Mengambil Data Penilaian dari Tabel - Tabel Lain
    public function get_adm_ta2($id)
    {
        $pengajuanjudul = Pengajuanjudul::where('mahasiswa_id', $id)
            ->where('status', '1')
            ->first();
        $prasidang = NilaiPrasidang::join('users', 'nilai_prasidangs.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $pengajuanjudul->id)
            ->where('nilai_prasidangs.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_prasidangs.*', 'users.name as dosen_name')
            ->get();
        $nilaiprasidang = array();
        foreach ($prasidang as $key => $value) {
            $nilaiprasidang[$key] = $value->total_nilai;
        }
        $total_nilaiprasidang = ($nilaiprasidang[0]+$nilaiprasidang[1]+$nilaiprasidang[2]+$nilaiprasidang[3])/4;
        
        $sidang = NilaiSidang::join('users', 'nilai_sidangs.dosen_id', 'users.id')
            ->where('mahasiswa_id', $id)
            ->where('pengajuanjudul_id', $pengajuanjudul->id)
            ->where('nilai_sidangs.prodi_id', Auth::user()->prodi_id)
            ->select('nilai_sidangs.*', 'users.name as dosen_name')
            ->get();
        $nilaisidang = array();
        foreach ($sidang as $key => $value) {
            $nilaisidang[$key] = $value->total_nilai;
        }     
        $total_nilaisidang = ($nilaisidang[0]+$nilaisidang[1]+$nilaisidang[2]+$nilaisidang[3])/4;

        return json_encode([
            'pengajuanjudul_id' => $pengajuanjudul->id,
            'pengajuanjudul_name' => $pengajuanjudul->judul,
            'nilai_sempro' => round($total_nilaiprasidang,2),
            'nilai_seminar' => round($total_nilaisidang,2),
        ]);
    }
    // Mengambil Data Penilaian dari Tabel - Tabel Lain

    // Fungsi menambahkan penilaian
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'p1_totalnilaiseminar' => 'required',
            // 'p2_totalnilaiseminar' => 'required',
            'pg1_totalnilaiseminar' => 'required',
            // 'pg2_totalnilaiseminar' => 'required',
            'p1_totalnilaisempro' => 'required',
            // 'p2_totalnilaisempro' => 'required',
            'pg1_totalnilaisempro' => 'required',
            // 'pg2_totalnilaisempro' => 'required',
            'p1_totalnilaipembimbing' => 'required',
            // 'p2_totalnilaipembimbing' => 'required',
            'p1_totalnilaiadm' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('errors', 'Harap Lengkapi data nilai terlebih dahulu.');
        }

        $p1_nilaiseminar = $request->get('p1_totalnilaiseminar');
        $p2_nilaiseminar = $request->get('p2_totalnilaiseminar');
        $p3_nilaiseminar = $request->get('pg1_totalnilaiseminar');
        $p4_nilaiseminar = $request->get('pg2_totalnilaiseminar');
        if ($p2_nilaiseminar == 0 && $p4_nilaiseminar != 0) {
            $total_seminar = ($p1_nilaiseminar+$p2_nilaiseminar+$p3_nilaiseminar+$p4_nilaiseminar)/3;
        } elseif ($p2_nilaiseminar != 0 && $p4_nilaiseminar == 0) {
            $total_seminar = ($p1_nilaiseminar+$p2_nilaiseminar+$p3_nilaiseminar+$p4_nilaiseminar)/3;
        } elseif ($p2_nilaiseminar == 0 && $p4_nilaiseminar == 0) {
            $total_seminar = ($p1_nilaiseminar+$p2_nilaiseminar+$p3_nilaiseminar+$p4_nilaiseminar)/2;
        } else {
            $total_seminar = ($p1_nilaiseminar+$p2_nilaiseminar+$p3_nilaiseminar+$p4_nilaiseminar)/4;
        }
        $nilai_seminar = round($total_seminar,2);

        $p1_nilaisempro = $request->get('p1_totalnilaisempro');
        $p2_nilaisempro = $request->get('p2_totalnilaisempro');
        $p3_nilaisempro = $request->get('pg1_totalnilaisempro');
        $p4_nilaisempro = $request->get('pg2_totalnilaisempro');
        if ($p2_nilaisempro == 0 && $p4_nilaisempro != 0) {
            $total_sempro = ($p1_nilaisempro+$p2_nilaisempro+$p3_nilaisempro+$p4_nilaisempro)/3;
        } elseif ($p2_nilaisempro != 0 && $p4_nilaisempro == 0) {
            $total_sempro = ($p1_nilaisempro+$p2_nilaisempro+$p3_nilaisempro+$p4_nilaisempro)/3;
        } elseif ($p2_nilaisempro == 0 && $p4_nilaisempro == 0) {
            $total_sempro = ($p1_nilaisempro+$p2_nilaisempro+$p3_nilaisempro+$p4_nilaisempro)/2;
        } else {
            $total_sempro = ($p1_nilaisempro+$p2_nilaisempro+$p3_nilaisempro+$p4_nilaisempro)/4;
        }
        $nilai_sempro = round($total_sempro,2);

        $p1_nilaipembimbing = $request->get('p1_totalnilaipembimbing');
        $p2_nilaipembimbing = $request->get('p2_totalnilaipembimbing');
        if ($p2_nilaipembimbing != 0) {
            $total_pembimbing = ($p1_nilaipembimbing+$p2_nilaipembimbing)/2;
        } else {
            $total_pembimbing = $p1_nilaipembimbing;
        }
        $nilai_pembimbing = round($total_pembimbing,2);

        $nilai_adm = $request->get('p1_totalnilaiadm');

        $total_nilai = ($nilai_seminar*30/100)+($nilai_sempro*20/100)+($nilai_pembimbing*35/100)+($nilai_adm*15/100);
        $total = round($total_nilai,2);

        if ($total < 34) {
            $grade = 'E';
        } elseif ($total >= 34 && $total < 49.5) {
            $grade = 'D';
        } elseif ($total >= 49.5 && $total < 57) {
            $grade = 'C';
        } elseif ($total >= 57 && $total < 64.5) {
            $grade = 'BC';
        } elseif ($total >= 64.5 && $total < 72) {
            $grade = 'B';
        } elseif ($total >= 72 && $total < 79.5) {
            $grade = 'AB';
        } elseif ($total >= 79.5 && $total <= 100) {
            $grade = 'A';
        }

        Penilaianta::create([
            'mahasiswa_id' => $request->get('mahasiswa_id'),
            'prodi_id' => Auth::user()->prodi_id,
            'pengajuanjudul_id' => $request->get('pengajuanjudul_id'),
            'nilai_1' => $nilai_sempro,
            'nilai_2' => $nilai_seminar,
            'nilai_3' => $nilai_pembimbing,
            'nilai_4' => $nilai_adm,
            'total_nilai' => $total,
            'grade' => $grade
        ]);

        return redirect()->route('penilaian.index')->with('success', 'Berhasil memasukan nilai mahasiswa.');
    }
    // Fungsi penambahan penilaian

    // Fungsi menambahkan penilaian TA 2
    public function store_ta_2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required',
            'pengajuanjudul_id' => 'required',
            'p1_totalnilaiseminar' => 'required',
            // 'p2_totalnilaiseminar' => 'required',
            'pg1_totalnilaiseminar' => 'required',
            // 'pg2_totalnilaiseminar' => 'required',
            'p1_totalnilaisempro' => 'required',
            // 'p2_totalnilaisempro' => 'required',
            'pg1_totalnilaisempro' => 'required',
            // 'pg2_totalnilaisempro' => 'required',
            'p1_totalnilaipembimbing' => 'required',
            // 'p2_totalnilaipembimbing' => 'required',
            'p1_totalnilaiadm' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('errors', 'Harap Lengkapi data nilai terlebih dahulu.');
        }

        $p1_nilaisidang = $request->get('p1_totalnilaiseminar');
        $p2_nilaisidang = $request->get('p2_totalnilaiseminar');
        $p3_nilaisidang = $request->get('pg1_totalnilaiseminar');
        $p4_nilaisidang = $request->get('pg2_totalnilaiseminar');
        if ($p2_nilaisidang == 0 && $p4_nilaisidang != 0) {
            $total_sidang = ($p1_nilaisidang+$p2_nilaisidang+$p3_nilaisidang+$p4_nilaisidang)/3;
        } elseif ($p2_nilaisidang != 0 && $p4_nilaisidang == 0) {
            $total_sidang = ($p1_nilaisidang+$p2_nilaisidang+$p3_nilaisidang+$p4_nilaisidang)/3;
        } elseif ($p2_nilaisidang == 0 && $p4_nilaisidang == 0) {
            $total_sidang = ($p1_nilaisidang+$p2_nilaisidang+$p3_nilaisidang+$p4_nilaisidang)/2;
        } else {
            $total_sidang = ($p1_nilaisidang+$p2_nilaisidang+$p3_nilaisidang+$p4_nilaisidang)/4;
        }
        $nilai_sidang = round($total_sidang,2);

        $p1_nilaiprasidang = $request->get('p1_totalnilaisempro');
        $p2_nilaiprasidang = $request->get('p2_totalnilaisempro');
        $p3_nilaiprasidang = $request->get('pg1_totalnilaisempro');
        $p4_nilaiprasidang = $request->get('pg2_totalnilaisempro');
        if ($p2_nilaiprasidang != 0 && $p4_nilaiprasidang == 0) {
            $total_prasidang = ($p1_nilaiprasidang+$p2_nilaiprasidang+$p3_nilaiprasidang+$p4_nilaiprasidang)/3;
        } elseif ($p2_nilaiprasidang == 0 && $p4_nilaiprasidang != 0) {
            $total_prasidang = ($p1_nilaiprasidang+$p2_nilaiprasidang+$p3_nilaiprasidang+$p4_nilaiprasidang)/3;
        } elseif ($p2_nilaiprasidang == 0 && $p4_nilaiprasidang == 0) {
            $total_prasidang = ($p1_nilaiprasidang+$p2_nilaiprasidang+$p3_nilaiprasidang+$p4_nilaiprasidang)/2;
        } else {
            $total_prasidang = ($p1_nilaiprasidang+$p2_nilaiprasidang+$p3_nilaiprasidang+$p4_nilaiprasidang)/4;
        }
        $nilai_prasidang = round($total_prasidang,2);

        $p1_nilaipembimbing = $request->get('p1_totalnilaipembimbing');
        $p2_nilaipembimbing = $request->get('p2_totalnilaipembimbing');
        if ($p2_nilaipembimbing != 0) {
            $total_pembimbing = ($p1_nilaipembimbing+$p2_nilaipembimbing)/2;
        } else {
            $total_pembimbing = $p1_nilaipembimbing;
        }
        $nilai_pembimbing = round($total_pembimbing,2);

        $nilai_adm = $request->get('p1_totalnilaiadm');

        $total_nilai = ($nilai_sidang*40/100)+($nilai_prasidang*15/100)+($nilai_pembimbing*40/100)+($nilai_adm*5/100);
        $total = round($total_nilai,2);

        if ($total < 34) {
            $grade = 'E';
        } elseif ($total >= 34 && $total < 49.5) {
            $grade = 'D';
        } elseif ($total >= 49.5 && $total < 57) {
            $grade = 'C';
        } elseif ($total >= 57 && $total < 64.5) {
            $grade = 'BC';
        } elseif ($total >= 64.5 && $total < 72) {
            $grade = 'B';
        } elseif ($total >= 72 && $total < 79.5) {
            $grade = 'AB';
        } elseif ($total >= 79.5 && $total <= 100) {
            $grade = 'A';
        }

        Penilaianta::create([
            'mahasiswa_id' => $request->get('mahasiswa_id'),
            'prodi_id' => Auth::user()->prodi_id,
            'pengajuanjudul_id' => $request->get('pengajuanjudul_id'),
            'status' => 'TA 2',
            'nilai_1' => $nilai_prasidang,
            'nilai_2' => $nilai_sidang,
            'nilai_3' => $nilai_pembimbing,
            'nilai_4' => $nilai_adm,
            'total_nilai' => $total,
            'grade' => $grade
        ]);

        return redirect()->route('penilaian.nilaita_2')->with('success', 'Berhasil memasukan nilai mahasiswa TA 2.');
    }
    // Fungsi penambahan penilaian TA 2

    // Hapus Penilaian
    public function destroy(Request $request)
    {
        $penilaian = Penilaianta::find($request->id);
        $penilaian->delete();

        if ($penilaian->status=='TA 2') {
            return redirect()->route('penilaian.nilaita_2')->with('success', 'Berhasil menghapus penilaian.');
        } else {
            return redirect()->route('penilaian.index')->with('success', 'Berhasil menghapus penilaian.');
        }
    }
    // Hapus Penilaian

    // Menghapus nilai seminar proposal dari penguji
    public function destroy_sempro_penguji(Request $request)
    {
        $sempro = NilaiSempro::find($request->id);
        $sempro->delete();

        return redirect()->route('penilaian.sempropenguji')->with('success', 'Berhasil menghapus nilai seminar proposal.');
    }
    // Menghapus nilai seminar proposal dari penguji

    // Menghapus nilai seminar proposal dari pembimbing
    public function destroy_sempro_pembimbing(Request $request)
    {
        $sempro = NilaiSempro::find($request->id);
        $sempro->delete();

        return redirect()->route('penilaian.sempropembimbing')->with('success', 'Berhasil menghapus nilai seminar proposal.');
    }
    // Menghapus nilai seminar proposal dari pembimbing

    // Menghapus nilai seminar TA 1 dari penguji
    public function destroy_seminar_penguji(Request $request)
    {
        $seminar = NilaiSeminar::find($request->id);
        $seminar->delete();

        return redirect()->route('penilaian.seminarpenguji')->with('success', 'Berhasil menghapus nilai seminar TA 1.');
    }
    // Menghapus nilai seminar TA 1 dari penguji

    // Menghapus nilai seminar TA 1 dari pembimbing
    public function destroy_seminar_pembimbing(Request $request)
    {
        $seminar = NilaiSeminar::find($request->id);
        $seminar->delete();

        return redirect()->route('penilaian.seminarpembimbing')->with('success', 'Berhasil menghapus nilai seminar TA 1.');
    }
    // Menghapus nilai seminar TA 1 dari pembimbing

    // Menghapus nilai Pra Sidang TA 2 dari penguji
    public function destroy_prasidang_penguji(Request $request)
    {
        $nprasidang = NilaiPrasidang::find($request->id);
        $nprasidang->delete();

        return redirect()->route('penilaian.prasidangpenguji')->with('success', 'Berhasil menghapus nilai Pra Sidang TA 2 Penguji.');
    }
    // Menghapus nilai Pra Sidang TA 2 dari penguji

    // Menghapus nilai Pra Sidang TA 2 dari pembimbing
    public function destroy_prasidang_pembimbing(Request $request)
    {
        $nprasidang = NilaiPrasidang::find($request->id);
        $nprasidang->delete();

        return redirect()->route('penilaian.prasidangpembimbing')->with('success', 'Berhasil menghapus nilai Pra Sidang TA 2 Pembimbing.');
    }
    // Menghapus nilai Pra Sidang TA 2 dari pembimbing

    // Menghapus nilai Sidang TA 2 dari penguji
    public function destroy_sidang_penguji(Request $request)
    {
        $nsidang = NilaiSidang::find($request->id);
        $nsidang->delete();

        return redirect()->route('penilaian.sidangpenguji')->with('success', 'Berhasil menghapus nilai Sidang TA 2 Penguji.');
    }
    // Menghapus nilai Sidang TA 2 dari penguji

    // Menghapus nilai Sidang TA 2 dari pembimbing
    public function destroy_sidang_pembimbing(Request $request)
    {
        $nsidang = NilaiSidang::find($request->id);
        $nsidang->delete();

        return redirect()->route('penilaian.sidangpembimbing')->with('success', 'Berhasil menghapus nilai Sidang TA 2 Pembimbing.');
    }
    // Menghapus nilai Sidang TA 2 dari pembimbing

    // Menghapus nilai pembimbing TA 1 dari pembimbing
    public function destroy_nilai_pembimbing_ta_1(Request $request)
    {
        $npembimbing = NilaiPembimbing::find($request->id);
        $npembimbing->delete();

        return redirect()->route('penilaian.nilaipembimbingta_1')->with('success', 'Berhasil menghapus nilai pembimbing TA 1.');
    }
    // Menghapus nilai pembimbing TA 1 dari pembimbing

    // Menghapus nilai pembimbing TA 2 dari pembimbing
    public function destroy_nilai_pembimbing_ta_2(Request $request)
    {
        $npembimbing = NilaiPembimbing::find($request->id);
        $npembimbing->delete();

        return redirect()->route('penilaian.nilaipembimbingta_2')->with('success', 'Berhasil menghapus nilai pembimbing TA 2.');
    }
    // Menghapus nilai pembimbing TA 2 dari pembimbing

    // Menghapus nilai Administrasi TA 1 dari koordinator
    public function destroy_nilai_adm_ta_1(Request $request)
    {
        $nilaiadm = NilaiAdm::find($request->id);
        $nilaiadm->delete();

        return redirect()->route('penilaian.nilaiadmta_1')->with('success', 'Berhasil menghapus nilai Administrasi TA 1.');
    }
    // Menghapus nilai Administrasi TA 1 dari koordinator

    // Menghapus nilai Administrasi TA 2 dari koordinator
    public function destroy_nilai_adm_ta_2(Request $request)
    {
        $nilaiadm = NilaiAdm::find($request->id);
        $nilaiadm->delete();

        return redirect()->route('penilaian.nilaiadmta_1')->with('success', 'Berhasil menghapus nilai Administrasi TA 2.');
    }
    // Menghapus nilai Administrasi TA 2 dari koordinator
}

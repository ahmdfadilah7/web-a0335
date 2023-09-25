<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Pengajuanpembimbing;
use App\Models\Bimbingan;
use App\Models\Dokumenpenguji;
use App\Models\Tugas;

class DosenpengujiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = User::where('role_id', 2)
            ->where('prodi_id', Auth::user()->prodi_id)
            ->get();
        $dosenpenguji = Dosen::join('users', 'dosens.user_id', '=', 'users.id')
            ->join('prodis', 'users.prodi_id', '=', 'prodis.id')
            ->where('users.prodi_id', Auth::user()->prodi->id)
            ->where('role', 'Penguji')
            ->select('dosens.*', 'users.nim', 'users.name', 'prodis.title')
            ->get();
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
        return view('dosenpenguji.index', compact('calendar', 'dosen', 'dosenpenguji', 'deadline'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function dokumen()
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
            $calendar = Bimbingan::join('users', 'bimbingans.mahasiswa_id', 'users.id')
                ->where('dosen_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = '';
        } else {
            $calendar = '';
            $deadline = '';
        }
        $dokumen = Dokumenpenguji::join('users', 'dokumenpengujis.mahasiswa_id', 'users.id')
            ->join('anggotakelompoks', 'users.id', 'anggotakelompoks.user_id')
            ->join('kelompoks', 'anggotakelompoks.kelompok_id', 'kelompoks.id')
            ->where('dosen_id', Auth::user()->id)
            ->select('users.name', 'dokumenpengujis.*', 'kelompoks.name as nama_kelompok')
            ->get();
        return view('dosenpenguji.dokumen', compact('dokumen', 'calendar', 'deadline'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        Dosen::create([
            'user_id' => $request->get('user_id'),
            'role' => 'Penguji'
        ]);

        return redirect()->route('dosenpenguji.index')->with('success', 'Berhasil menambahkan Dosen Penguji.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $dosen = Dosen::findOrFail($request->get('id'));
        $dosen->delete();

        return redirect()->route('dosenpenguji.index')->with('success', 'Berhasil menghapus data.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kelompok;
use App\Models\Anggotakelompok;
use App\Models\Bimbingan;
use App\Models\Tugas;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $kelompok = Kelompok::join('prodis', 'kelompoks.prodi_id', '=', 'prodis.id')
            ->where('prodi_id', Auth::user()->prodi->id)
            ->select('kelompoks.*', 'prodis.title')
            ->get();
        return view('kelompok.index', compact('kelompok', 'calendar', 'deadline'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        Kelompok::create([
            'name' => $request->get('name'),
            'prodi_id' => Auth::user()->prodi->id,
        ]);

        return redirect()->route('kelompok.index')->with('success', 'Berhasil menambahkan kelompok baru.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->role->title=='Mahasiswa') {
            $calendar = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugasakhir::join('tugas', 'tugasakhirs.tugas_id', 'tugas.id')
                ->join('users', 'tugas.user_id', 'users.id')
                ->where('tugasakhirs.user_id', Auth::user()->id)
                ->select('tugasakhirs.*', 'tugas.judul', 'tugas.deadline', 'users.name')
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
        $kelompok = Kelompok::find($id);
        $anggotakelompok = Anggotakelompok::join('users', 'anggotakelompoks.user_id', '=', 'users.id')
            ->where('kelompok_id', $id)
            ->where('status', '1')
            ->select('anggotakelompoks.*', 'users.name')
            ->get();
        $cekanggota = Anggotakelompok::join('users', 'anggotakelompoks.user_id', '=', 'users.id')
            ->where('status', '1')
            ->select('anggotakelompoks.*', 'users.name')
            ->get();
        $anggota = User::where('role_id', 1)
            ->where('prodi_id', Auth::user()->prodi->id)
            ->get();
        return view('anggotakelompok.index', compact('kelompok', 'anggotakelompok', 'anggota', 'calendar', 'deadline'));
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
        $kelompok = Kelompok::findOrFail($request->id);
        $kelompok->delete();

        return redirect()->route('kelompok.index')->with('success', 'Berhasil Menghapus kelompok.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pengajuanjudul;
use App\Models\Pengajuanpembimbing;
use App\Models\Bimbingan;
use App\Models\Tugas;

class PengajuanjudulController extends Controller
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
        $dosen = Pengajuanpembimbing::join('users', 'pengajuanpembimbings.dosen_id', 'users.id')
            ->where('mahasiswa_id', Auth::user()->id)
            ->where('status', '1')
            ->select('pengajuanpembimbings.*', 'users.name')
            ->get();
        if (Auth::user()->role->title=='Mahasiswa') {
            $pengajuanjudul = Pengajuanjudul::join('users', 'pengajuanjuduls.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->select('pengajuanjuduls.*', 'users.name')
                ->get();
        } elseif (Auth::user()->role->title=='Dosen') {
            $pengajuanjudul = Pengajuanjudul::join('users', 'pengajuanjuduls.mahasiswa_id', 'users.id')
                ->where('dosen_id', Auth::user()->id)
                ->select('pengajuanjuduls.*', 'users.name')
                ->get();
        }

        return view('pengajuanjudul.index', compact('pengajuanjudul', 'dosen', 'calendar', 'deadline'));
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
            'dosen_id' => 'required',
            'judul' => 'required',
            'keterangan' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        Pengajuanjudul::create([
            'mahasiswa_id' => Auth::user()->id,
            'dosen_id' => $request->get('dosen_id'),
            'prodi_id' => Auth::user()->prodi_id,
            'judul' => $request->get('judul'),
            'keterangan' => $request->get('keterangan')
        ]);

        return redirect()->route('pengajuanjudul.index')->with('success', 'Berhasil menambahkan judul.');
    }

    public function pengajuan(Request $request)
    {
        $pengajuanjudul = Pengajuanjudul::find($request->id);
        $pengajuanjudul->status = $request->get('status');
        if ($request->get('status')==2) {
            $pengajuanjudul->alasan = $request->get('alasan');
        }
        $pengajuanjudul->save();

        if($request->get('status')==1){
            return redirect()->route('pengajuanjudul.index')->with('success', 'Pengajuan judul berhasil diterima.');
        } else {
            return redirect()->route('pengajuanjudul.index')->with('danger', 'Pengajuan judul berhasil ditolak.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengajuanjudul = Pengajuanjudul::join('users', 'pengajuanjuduls.mahasiswa_id', 'users.id')
                ->select('pengajuanjuduls.*', 'users.name')
                ->find($id);

        return response()->json($pengajuanjudul);
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
        $pengajuanjudul = Pengajuanjudul::findOrFail($request->id);
        $pengajuanjudul->delete();

        return redirect()->route('pengajuanjudul.index')->with('success', 'Berhasil Menghapus judul.');
    }
}

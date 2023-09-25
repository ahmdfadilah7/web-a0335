<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Pengajuanpembimbing;
use App\Models\Bimbingan;
use App\Models\Tugas;

class BimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = Pengajuanpembimbing::join('users', 'pengajuanpembimbings.dosen_id', 'users.id')
            ->where('mahasiswa_id', Auth::user()->id)
            ->where('status', '1')
            ->select('pengajuanpembimbings.*', 'users.name')
            ->get();
        if (Auth::user()->role->title=='Mahasiswa') {
            $bimbingan = Bimbingan::join('users', 'bimbingans.dosen_id', 'users.id')
                ->where('mahasiswa_id', Auth::user()->id)
                ->select('bimbingans.*', 'users.name')
                ->get();
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
            $bimbingan = Bimbingan::join('users', 'bimbingans.mahasiswa_id', 'users.id')
                ->where('dosen_id', Auth::user()->id)
                ->select('bimbingans.*', 'users.name')
                ->get();
            $calendar = Bimbingan::join('users', 'bimbingans.mahasiswa_id', 'users.id')
                ->where('dosen_id', Auth::user()->id)
                ->where('status', '1')
                ->select('bimbingans.*', 'users.name')
                ->get();
            $deadline = Tugas::join('users', 'tugas.user_id', 'users.id')
                ->where('tugas.prodi_id', Auth::user()->prodi_id)
                ->select('tugas.judul', 'tugas.deadline', 'users.name')
                ->get();
        } else {
            $calendar = '';
            $deadline = '';
        }
        return view('bimbingan.index', compact('bimbingan', 'dosen', 'calendar', 'deadline'));
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
            'waktu' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        Bimbingan::create([
            'mahasiswa_id' => Auth::user()->id,
            'dosen_id' => $request->get('dosen_id'),
            'waktu' => $request->get('waktu'),
            'tanggal' => $request->get('tanggal'),
            'keterangan' => $request->get('keterangan')
        ]);

        return redirect()->route('bimbingan.index')->with('success', 'Berhasil mengajukan bimbingan.');
    }

    public function pengajuan(Request $request)
    {
        $bimbingan = Bimbingan::find($request->id);
        $bimbingan->status = $request->get('status');
        if($request->get('status')==2){
            $bimbingan->alasan = $request->get('alasan');
        }
        $bimbingan->save();

        if($request->get('status')==1){
            return redirect()->route('bimbingan.index')->with('success', 'Bimbingan berhasil diterima.');
        } else {
            return redirect()->route('bimbingan.index')->with('danger', 'Bimbingan berhasil ditolak.');
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
        $bimbingan = Bimbingan::join('users', 'bimbingans.mahasiswa_id', 'users.id')
                ->select('bimbingans.*', 'users.name')
                ->find($id);

        return response()->json($bimbingan);
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
        $bimbingan = Bimbingan::findOrFail($request->id);
        $bimbingan->delete();

        return redirect()->route('bimbingan.index')->with('success', 'Berhasil Menghapus pengajuan bimbingan.');
    }
}

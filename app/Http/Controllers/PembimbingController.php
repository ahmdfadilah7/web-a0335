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

class PembimbingController extends Controller
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
        $pembimbing = Pengajuanpembimbing::join('users', 'pengajuanpembimbings.mahasiswa_id', 'users.id')
            ->join('prodis', 'users.prodi_id', 'prodis.id')
            ->where('dosen_id', Auth::user()->id)
            ->select('pengajuanpembimbings.*', 'users.name', 'users.nim', 'prodis.title')
            ->get();
        return view('pembimbing.index', compact('pembimbing', 'calendar', 'deadline'));
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
        $id = $request->id;
        $pembimbing = Pengajuanpembimbing::find($id);
        $pembimbing->status = $request->get('status');
        $pembimbing->save();

        $dosen = Dosen::where('user_id', $pembimbing->dosen_id)->where('role', 'Pembimbing')->first();
        $kuota = $dosen->kuota - 1;
        $dosen->kuota = $kuota;
        $dosen->save();

        if($request->get('status')==1){
            return redirect()->route('pembimbing.index')->with('success', 'Pembimbing berhasil diterima.');
        } else {
            return redirect()->route('pembimbing.index')->with('danger', 'Pembimbing berhasil ditolak.');
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
        $pembimbing = Pengajuanpembimbing::join('users', 'pengajuanpembimbings.mahasiswa_id', 'users.id')
            ->join('prodis', 'users.prodi_id', 'prodis.id')
            ->where('dosen_id', Auth::user()->id)
            ->select('pengajuanpembimbings.*', 'users.name', 'users.nim', 'users.foto', 'prodis.title')
            ->find($id);

        return response()->json($pembimbing);
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
    public function destroy($id)
    {
        //
    }
}

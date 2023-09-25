<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Artefak;
use App\Models\Bimbingan;
use App\Models\Tugas;

class ArtefakController extends Controller
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
        $artefak = Artefak::join('tugasakhirs', 'artefaks.tugasakhir_id', 'tugasakhirs.id')
                ->join('tugas', 'tugasakhirs.tugas_id', 'tugas.id')
                ->where('artefaks.prodi_id', Auth::user()->prodi_id)
                ->select('artefaks.*', 'tugas.judul')
                ->get();
        return view('artefak.index', compact('artefak', 'calendar', 'deadline'));
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
        //
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
    public function destroy($id)
    {
        //
    }
}

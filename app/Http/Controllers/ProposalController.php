<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Proposal;
use App\Models\Dokumenproposal;
use App\Models\Bimbingan;
use App\Models\Tugasakhir;
use App\Models\Tugas;

class ProposalController extends Controller
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
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
                ->where('tugas.status', '1')
                ->get();
        $proposal = Proposal::join('tugas', 'proposals.tugas_id', 'tugas.id')
            ->where('proposals.user_id', Auth::user()->id)
            ->select('proposals.*', 'tugas.judul')
            ->get();
        return view('proposal.index', compact('proposal', 'calendar', 'deadline', 'tugas'));
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
        $file = $request->file('file');
        $namafile = str_replace(' ', '-', $file->getClientOriginalName());
        $tujuan = 'file';
        $file->move(public_path($tujuan), $namafile);
        $filename = $tujuan.'/'.$namafile;

        $proposal = new Proposal;
        $proposal->file = $filename;
        $proposal->tugas_id = $request->get('tugas_id');
        $proposal->user_id = Auth::user()->id;
        $proposal->kelompok_id = $request->get('kelompok_id');
        $proposal->status = '1';
        $proposal->save();

        return redirect()->route('proposal.index')->with('success', 'Berhasil menambahkan Proposal baru.');
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
        $proposal = Proposal::findOrFail($request->id);
        $proposal->delete();

        $dokumen = Dokumenproposal::where('proposal_id', $request->id);
        $dokumen->delete();

        File::delete($proposal->file);

        return redirect()->route('proposal.index')->with('success', 'Berhasil menghapus File.');
    }
}

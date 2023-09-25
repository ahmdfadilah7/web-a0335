<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Tugasakhir;
use App\Models\Tugas;
use App\Models\Artefak;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Dokumenpenguji;
use App\Models\Dokumentugasakhir;
use App\Models\Pengajuanjudul;

class TugasakhirController extends Controller
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
        $tugasakhir = Tugasakhir::join('tugas', 'tugasakhirs.tugas_id', 'tugas.id')
            ->where('tugasakhirs.user_id', Auth::user()->id)
            ->where('tugasakhirs.status', '1')
            ->select('tugasakhirs.*', 'tugas.judul')
            ->get();
        $dosen = Dosen::join('users', 'dosens.user_id', '=', 'users.id')
            ->join('prodis', 'users.prodi_id', '=', 'prodis.id')
            ->where('users.prodi_id', Auth::user()->prodi->id)
            ->where('role', 'Penguji')
            ->select('dosens.*', 'users.nim', 'users.name', 'prodis.title')
            ->get();
        $tugas = Tugas::where('prodi_id', Auth::user()->prodi_id)
            ->where('tugas.status', '1')
            ->get();
        $judul = Pengajuanjudul::where('mahasiswa_id', Auth::user()->id)
            ->where('status', '1')
            ->get();
        // $tugasakhir_count = Tugasakhir::count();
        return view('tugasakhir.index', compact('tugasakhir', 'calendar', 'dosen', 'tugas', 'deadline', 'judul'));
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

        $tugasakhir = new Tugasakhir;
        $tugasakhir->file = $filename;
        $tugasakhir->tugas_id = $request->get('tugas_id');
        $tugasakhir->user_id = Auth::user()->id;
        $tugasakhir->kelompok_id = $request->get('kelompok_id');
        $tugasakhir->status = '1';
        $tugasakhir->save();

        return redirect()->route('tugasakhir.index')->with('success', 'Berhasil menambahkan Tugas Akhir baru.');
    }

    public function kirim(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dosen_id' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        Dokumenpenguji::create([
            'mahasiswa_id' => Auth::user()->id,
            'dosen_id' => $request->get('dosen_id'),
            'tugasakhir_id' => $request->get('tugasakhir_id')
        ]);

        $tugasakhir = Tugasakhir::find($request->get('tugasakhir_id'));
        $tugasakhir->kirim = '1';
        $tugasakhir->save();

        return redirect()->route('tugasakhir.index')->with('success', 'Berhasil mengirimkan dokumen.');
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
        $tugasakhir = Tugasakhir::find($id);
        $tugasakhir->status = $request->get('status');
        $tugasakhir->save();

        $artefak = Artefak::create([
            'tugasakhir_id' => $id,
            'user_id' => Auth::user()->id,
            'kelompok_id' => Auth::user()->anggotakelompok[0]->kelompok_id,
            'prodi_id' => Auth::user()->prodi_id,
            'tahun' => date('Y', strtotime($tugasakhir->created_at))
        ]);

        return redirect()->route('tugasakhir.index')->with('success', 'Berhasil menyimpan ke Artefak.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tugasakhir = Tugasakhir::findOrFail($request->id);
        $tugasakhir->delete();

        $dokumen = Dokumenpenguji::where('tugasakhir_id', $request->id);
        $dokumen->delete();

        $dokumentugasakhir = Dokumentugasakhir::where('tugasakhir_id', $request->id);
        $dokumentugasakhir->delete();

        File::delete($tugasakhir->file);

        return redirect()->route('tugasakhir.index')->with('success', 'Berhasil menghapus File.');
    }
}

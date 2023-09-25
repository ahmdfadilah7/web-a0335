<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Tugas;
use App\Models\Tugasakhir;
use App\Models\Proposal;
use App\Models\Bimbingan;

class TugasController extends Controller
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
        $tugas = Tugas::join('users', 'tugas.user_id', 'users.id')
            ->join('prodis', 'tugas.prodi_id', 'prodis.id')
            ->where('tugas.prodi_id', Auth::user()->prodi_id)
            ->where('tugas.status', '1')
            ->select('tugas.*', 'users.name', 'prodis.title')
            ->get();
        return view('tugas.index', compact('tugas', 'calendar', 'deadline'));
    }

    public function selesai()
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
        $tugas = Tugas::join('users', 'tugas.user_id', 'users.id')
            ->join('prodis', 'tugas.prodi_id', 'prodis.id')
            ->where('tugas.prodi_id', Auth::user()->prodi_id)
            ->where('tugas.status', '0')
            ->select('tugas.*', 'users.name', 'prodis.title')
            ->get();
        return view('tugas.index', compact('tugas', 'calendar', 'deadline'));
    }

    public function penilaian()
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
        $tugas = Tugas::join('users', 'tugas.user_id', 'users.id')
            ->join('prodis', 'tugas.prodi_id', 'prodis.id')
            ->where('tugas.prodi_id', Auth::user()->prodi_id)
            ->where('tugas.status', '0')
            ->select('tugas.*', 'users.name', 'prodis.title')
            ->get();
        return view('tugas.index', compact('tugas', 'calendar', 'deadline'));
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
            'judul' => 'required',
            'deadline' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        Tugas::create([
            'judul' => $request->get('judul'),
            'deadline' => $request->get('deadline'),
            'user_id' => Auth::user()->id,
            'prodi_id' => Auth::user()->prodi_id,
            'status' => '1',
        ]);

        return redirect()->route('tugas.index')->with('success', 'Berhasil menambahkan tugas baru.');
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
        $tugas = Tugas::find($id);

        return response()->json($tugas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deadline' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $id = $request->id;

        $tugas = Tugas::find($id);
        $tugas->judul = $request->get('judul');
        $tugas->deadline = $request->get('deadline');
        $tugas->save();

        return redirect()->route('tugas.index')->with('success', 'Berhasil mengedit tugas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tugas = Tugas::find($request->id);
        $tugas->delete();

        return redirect()->route('tugas.index')->with('success', 'Berhasil menghapus tugas.');
    }

    public function save(Request $request)
    {
        $tugas = Tugas::findOrFail($request->id);
        $tugas->status = '0';
        $tugas->save();

        $tugasakhir_count = Tugasakhir::where('tugas_id', $request->id)->count();
        if ($tugasakhir_count > 0) {
            $tugasakhir = Tugasakhir::where('tugas_id', $request->id)->first();
            $tugasakhir->status = '0';
            $tugasakhir->save();
        }

        $proposal_count = Proposal::where('tugas_id', $request->id)->count();
        if ($proposal_count > 0) {
            $proposal = Proposal::where('tugas_id', $request->id)->first();
            $proposal->status = '0';
            $proposal->save();
        }

        return redirect()->route('tugas.index')->with('success', 'Berhasil menyelesaikan Tugas.');
    }
}

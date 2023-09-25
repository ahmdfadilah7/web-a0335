<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Bimbingan;
use App\Models\Tugas;
use App\Models\Pengumuman;

class PengumumanController extends Controller
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
        $pengumuman = Pengumuman::join('users', 'pengumumans.user_id', 'users.id')
            ->join('roles', 'users.role_id', 'roles.id')
            ->where('pengumumans.prodi_id', Auth::user()->prodi_id)
            ->select('pengumumans.*', 'users.name', 'roles.title as role')
            ->paginate(5);
        return view('pengumuman.index', compact('calendar', 'pengumuman', 'deadline'));
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
            'title' => 'required',
            'file_jadwal' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
            'description' => 'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if ($request->file_jadwal) {
            $file = $request->file('file_jadwal');
            $namafile = str_replace(' ', '-', $file->getClientOriginalName());
            $tujuan = 'file';
            $file->move(public_path($tujuan), $namafile);
            $filename = $tujuan.'/'.$namafile;

        } else {
            $filename = null;
        }

        Pengumuman::create([
            'user_id' => Auth::user()->id,
            'prodi_id' => Auth::user()->prodi_id,
            'title' => $request->get('title'),
            'link_jadwal' => $request->get('link_jadwal'),
            'file_jadwal' => $filename,
            'description' => $request->get('description')
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Berhasil menambahkan pengumuman baru.');
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
        $pengumuman = Pengumuman::find($id);

        return response()->json($pengumuman);
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
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $id = $request->id;

        $pengumuman = Pengumuman::find($id);
        $pengumuman->title = $request->get('title');
        $pengumuman->description = $request->get('description');
        $pengumuman->save();

        return redirect()->route('pengumuman.index')->with('success', 'Berhasil mengedit pengumuman.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $pengumuman = Pengumuman::findOrFail($request->id);
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Berhasil Menghapus judul.');
    }
}

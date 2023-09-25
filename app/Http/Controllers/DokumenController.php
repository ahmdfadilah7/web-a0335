<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumenproposal;
use App\Models\Dokumentugasakhir;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('dokumen.index');
    }

    public function proposal()
    {
        $dokumen = Dokumenproposal::join('users', 'dokumenproposals.user_id', 'users.id')
            ->join('proposals', 'dokumenproposals.proposal_id', 'proposals.id')
            ->join('prodis', 'dokumenproposals.prodi_id', 'prodis.id')
            ->select('users.name as nama_mahasiswa', 'users.nim', 'prodis.title as prodi', 'proposals.file', 'dokumenproposals.id')
            ->get();
        return view('dokumen.proposal', compact('dokumen'));
    }

    public function kirimproposal(Request $request)
    {
        Dokumenproposal::create([
            'user_id' => $request->get('user_id'),
            'proposal_id' => $request->get('proposal_id'),
            'prodi_id' => $request->get('prodi_id')
        ]);

        return redirect()->route('proposal.index')->with('success', 'Berhasil mengirimkan dokumen ke BAAK.');
    }

    public function hapusproposal(Request $request)
    {
        $dokumen = Dokumenproposal::find($request->id);
        $dokumen->delete();

        return redirect()->route('dokumen.proposal')->with('success', 'Berhasil menghapus dokumen dari BAAK.');
    }

    public function tugasakhir()
    {
        $dokumen = Dokumentugasakhir::join('users', 'dokumentugasakhirs.user_id', 'users.id')
            ->join('tugasakhirs', 'dokumentugasakhirs.tugasakhir_id', 'tugasakhirs.id')
            ->join('prodis', 'dokumentugasakhirs.prodi_id', 'prodis.id')
            ->select('users.name as nama_mahasiswa', 'users.nim', 'prodis.title as prodi', 'tugasakhirs.file', 'dokumentugasakhirs.id')
            ->get();
        return view('dokumen.tugasakhir', compact('dokumen'));
    }

    public function kirimtugasakhir(Request $request)
    {
        Dokumentugasakhir::create([
            'user_id' => $request->get('user_id'),
            'tugasakhir_id' => $request->get('tugasakhir_id'),
            'prodi_id' => $request->get('prodi_id')
        ]);

        return redirect()->route('tugasakhir.index')->with('success', 'Berhasil mengirimkan dokumen ke BAAK.');
    }

    public function hapustugasakhir(Request $request)
    {
        $dokumen = Dokumentugasakhir::find($request->id);
        $dokumen->delete();

        return redirect()->route('dokumen.tugasakhir')->with('success', 'Berhasil menghapus dokumen dari BAAK.');
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

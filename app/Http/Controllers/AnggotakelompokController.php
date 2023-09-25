<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Kelompok;
use App\Models\Anggotakelompok;

class AnggotakelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        Anggotakelompok::create([
            'kelompok_id' => $request->get('kelompok_id'),
            'user_id' => $request->get('user_id'),
            'token' => Str::random(5),
            'status' => '1'
        ]);

        return redirect()->route('kelompok.show', $request->get('kelompok_id'))->with('success', 'Berhasil Menambahkan Anggota kelompok.');
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
        $anggotakelompok = Anggotakelompok::findOrFail($request->id);
        $anggotakelompok->delete();

        return redirect()->route('kelompok.show', $anggotakelompok->kelompok_id)->with('success', 'Berhasil menghapus data.');
    }
}

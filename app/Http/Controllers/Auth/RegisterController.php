<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // MENUJU HALAMAN PENDAFTARAN
    public function index()
    {
        $role = Role::where('title', '<>', 'Baak')->get();
        $prodi = Prodi::get();
        return view('auth.register', compact('role', 'prodi'));
    }
    // MENUJU HALAMAN PENDAFTARAN SELESAI

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
    // PROSES PENDAFTARAN USER
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required',
            'prodi_id' => 'required',
            'password' => 'required|min:6'
        ], 
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter',
            'unique' => ':attribute sudah terdaftar'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        User::create([
            'name' => $request->get('name'),
            'nim' => $request->get('nim'),
            'email' => $request->get('email'),
            'role_id' => $request->get('role_id'),
            'prodi_id' => $request->get('prodi_id'),
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect()->route('login')->with('success', 'Selamat Pendaftaran berhasil.');
    }
    // PROSES PENDAFTARAN SELESAI

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

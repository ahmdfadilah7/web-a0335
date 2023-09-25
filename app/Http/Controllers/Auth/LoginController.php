<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // MENUJU HALAMAN LOGIN
    public function index()
    {
        return view('auth.login');
    }
    // MENUJU HALAMAN LOGIN SELESAI

    // PROSES LOGIN
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],
        [
            'required' => ':attribute wajib diisi !!!',
            'email' => 'harap masukan format :attribute dengan benar',
            'min' => 'jumlah password minimal 6 karakter'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $email = $request->get('email');
        $password = Hash::make($request->get('password'));
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard.index');
        }
        return back()->with('danger', 'Data tidak sesuai')->withInput($request->all());

    }
    // PROSES LOGIN SELESAI

    // PROSES LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }
    // PROSES LOGOUT SELESAI

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

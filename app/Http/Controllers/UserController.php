<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Bimbingan;
use App\Models\Tugas;

class UserController extends Controller
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
        return view('user.index', compact('calendar', 'deadline'));
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $user = User::findOrFail($id);
        $role = Role::get();
        $prodi = Prodi::get();
        return view('user.edit', compact('role', 'prodi', 'user', 'calendar', 'deadline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nim' => 'required|unique:users,nim,'.$id,
            'email' => 'required|unique:users,email,'.$id,
            'foto' => 'image|mimes:jpg,png,jpeg,svg,gif|max:2048'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if ($request->foto) {
            $foto = $request->foto;
            $namafoto = time().'-UserProfile.'.$foto->extension();
            $tujuan = 'images/user';
            $foto->move(public_path($tujuan), $namafoto);
            $fotoname = $tujuan.'/'.$namafoto;

            $fotosebelumnya = User::findOrFail($id);
            File::delete($fotosebelumnya->foto);

        } else {
            $fotoname = '';
        }

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->nim = $request->get('nim');
        $user->email = $request->get('email');
        if($fotoname <> ''){
            $user->foto = $fotoname;
        }
        $user->save();

        return redirect()->route('user.index')->with('success', 'User Profile Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

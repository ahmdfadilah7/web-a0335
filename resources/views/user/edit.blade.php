@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Edit Profil</h2>
    <div class="row align-items-center">
        <div class="col-md-12 text-center">
            @if (Auth::user()->foto == NULL)
                <img src="{{ url('/images/user-profile.png') }}" stlye="width:300px">
            @else
                <img src="{{ url($user->foto) }}" stlye="width:300px">
            @endif
            <div class="mt-4">
                {!! Form::model($user, ['method' => 'PUT', 'route' => ['user.update', $user->id], 'enctype' => 'multipart/form-data']) !!}
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">NIM</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="nim" class="form-control" value="{{ $user->nim }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">Name</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">Email</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">Role</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="role_id" class="form-control" value="{{ $user->role->title }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">Prodi</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="prodi_id" class="form-control" value="{{ $user->prodi->title }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">Foto</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>
            </div>
            <div class="mt-4 text-left">
                <button class="btn btn-outline-primary">UPDATE</button>
                <a href="{{ route('user.index') }}" class="btn btn-primary">BACK</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@include('layouts.partials.js')

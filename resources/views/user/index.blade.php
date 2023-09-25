@extends('layouts.app')
@include('layouts.partials.css')

@section('content')

<div class="card-box pd-20">
    <h2 class="h4 mb-20">Profil</h2>
    <div class="row align-items-center">
        <div class="col-md-12 text-center">
            @if (Auth::user()->foto == NULL)
                <img src="{{ url('/images/user-profile.png') }}" stlye="width:300px">
            @else
                <img src="{{ url(Auth::user()->foto) }}" stlye="width:300px">
            @endif
            <div class="mt-4">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">NIM</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" class="form-control" value="{{ Auth::user()->nim }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">Name</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">Email</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" class="form-control" value="{{ Auth::user()->email }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">Role</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" class="form-control" value="{{ Auth::user()->role->title }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label text-right">Prodi</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" class="form-control" value="{{ Auth::user()->prodi->title }}" readonly>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-left">
                <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-outline-primary">EDIT</a>
            </div>
        </div>
    </div>
</div>

@endsection

@include('layouts.partials.js')

@extends('auth.layouts')

@section('content')

<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Register</h2>
        <p class="font-14 text-center">Isi semua bagian dengan benar</p>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Ada beberapa masalah dengan masukan Anda. <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{ route('register.store') }}" method="post">
        @csrf

        <div class="form-group custom">
            <label for="">Role</label>
            <select name="role_id" class="form-control">
                @foreach ($role as $value)
                    @php
                        $select = '';
                    @endphp
                    @if (old('role_id') == $value->id)
                        @php
                            $select = 'selected';
                        @endphp
                    @endif
                    <option value="{{ $value->id }}" {{ $select }}>{{ $value->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group custom">
            <label for="">Prodi</label>
            <select name="prodi_id" class="form-control">
                @foreach ($prodi as $value)
                    @php
                        $select = '';
                    @endphp
                    @if (old('prodi_id') == $value->id)
                        @php
                            $select = 'selected';
                        @endphp
                    @endif
                    <option value="{{ $value->id }}" {{ $select }}>{{ $value->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Nomor Induk Mahasiswa/Dosen</label>
            <input type="text" name="nim" class="form-control" placeholder="Nomor Induk Mahasiswa/Dosen" value="{{ old('nim') }}">
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <div class="input-group custom">
                <input
                    type="text"
                    name="email"
                    class="form-control form-control-lg"
                    placeholder="Email"
                    value="{{ old('email') }}"
                />
                <div class="input-group-append custom">
                    <span class="input-group-text"
                        ><i class="icon-copy dw dw-user1"></i
                    ></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <div class="input-group custom">
                <input
                    type="password"
                    name="password"
                    class="form-control form-control-lg"
                    placeholder="**********"
                />
                <div class="input-group-append custom">
                    <span class="input-group-text"
                        ><i class="dw dw-padlock1"></i
                    ></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <button class="btn btn-primary btn-lg btn-block">
                        Daftar
                    </button>
                </div>
                <div class="font-16 pt-10 pb-10 text-center" data-color="#707373">
                    Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary weight-600">Masuk</a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

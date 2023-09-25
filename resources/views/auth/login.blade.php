@extends('auth.layouts')

@section('content')

<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Login</h2>
        <p class="font-14 text-center">Masukkan email dan password anda dengan benar</p>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @elseif ($message = Session::get('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
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
    </div>
    <form action="{{ route('postlogin') }}" method="post">
        @csrf

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
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <button class="btn btn-primary">Masuk</button>
                </div>
                <div class="font-16 pt-10 pb-10 text-center" data-color="#707373">
                    Tidak memiliki akun? <a href="{{ route('register.index') }}" class="text-primary weight-600">Daftar Sekarang</a>
                </div>
                <div class="mb-0 text-center">
                    <a class="text-primary weight-600" href="{{ route('lupapassword.index') }}" >
                        <u>Lupa Password</u>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

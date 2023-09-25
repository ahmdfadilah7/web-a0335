@extends('auth.layouts')

@section('content')

<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Lupa Password</h2>
        <p class="font-14 text-center">Masukkan Email yang terdaftar</p>
    </div>
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
            There were some problems with your input. <br><br>
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
    <form action="{{ route('cekemail') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email yang didaftarkan">
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <button class="btn btn-primary btn-lg btn-block">
                        Kirim
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

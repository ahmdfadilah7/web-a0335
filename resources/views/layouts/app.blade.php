<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Informasi Fakultas Vokasi</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/images/logo.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/images/logo.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/images/logo.png') }}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    {{-- CSS --}}
    @yield('css');
    {{-- End CSS --}}

</head>

<body class="header-white sidebar-light">
    {{-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo text-center">
                <img src="{{ url('/images/logo.png') }}" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div> --}}

    {{-- HEADER --}}
    @include('layouts.partials.header')
    {{-- END HEADER --}}


    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ url('/images/logo.png') }}" alt="" class="dark-logo" />
                <img src="{{ url('/images/logo.png') }}" alt="" class="light-logo" />
                <h6 class="pl-3 font-12">SITA VOKASI IT DEL</h6>
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>

        {{-- NAVIGASI --}}
        @include('layouts.partials.navigasi')
        {{-- END NAVIGASI --}}

    </div>
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20">

            {{-- CONTENT --}}
            <div class="row">
                <div class="col-md-8 col-sm-12 mb-30">
                    @yield('content')
                </div>

                {{-- CALENDAR --}}
                @include('layouts.partials.calendar')
                {{-- END CALENDAR --}}

            </div>
            {{-- END CONTENT --}}

            {{-- <div class="footer-wrap pd-20 mb-20 card-box">
                Sistem Informasi Fakultas Vokasi
            </div> --}}
        </div>
    </div>

    {{-- JS --}}
    @yield('js')
    {{-- END JS --}}

    {{-- SCRIPT --}}
    @yield('script')
    {{-- END SCRIPT --}}
</body>

</html>

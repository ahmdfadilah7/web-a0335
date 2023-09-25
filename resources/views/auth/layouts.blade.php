<!DOCTYPE html>
<html>
	{{-- HEAD --}}
    @include('auth.partials.head')
    {{-- END HEAD --}}

	<body class="login-page">
		<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center" >
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-12 col-lg-12">

                        {{-- CONTENT --}}
                        @yield('content')
                        {{-- END CONTENT --}}

					</div>
				</div>
			</div>
		</div>

        {{-- JS --}}
        @include('auth.partials.js')
        {{-- END JS --}}
	</body>
</html>

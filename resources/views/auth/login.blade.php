<x-layouts.auth>

    <body class="app app-login p-0">
        <div class="row g-0 app-auth-wrapper">
            <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
                <div class="d-flex flex-column align-content-end">
                    <div class="app-auth-body mx-auto">

                        <div class="app-auth-branding mb-4">
                            <a class="h1 app-logo" href="{{ env('APP_URL') }}">
                                {{-- <img class="logo-icon me-2" src="{{ asset('assets') }}/images/app-logo.svg"
                                    alt="logo"> --}}
                                Dinas Peternakan
                            </a>
                        </div>

                        <h2 class="auth-heading text-center mb-5">Log in</h2>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="auth-form-container text-start">
                            <form class="auth-form login-form" method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="email mb-3">
                                    <label class="sr-only" for="email">Email</label>
                                    <input id="email" name="email" type="email"
                                        class="form-control signin-email" placeholder="Email address"
                                        required="required" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="password mb-3">
                                    <label class="sr-only" for="password">Password</label>
                                    <input id="password" name="password" type="password"
                                        class="form-control signin-password" placeholder="Password" required="required"
                                        autocomplete="current-password">
                                    @error('password')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror

                                    <div class="extra mt-3 row justify-content-between">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember"
                                                    name="remember">
                                                <label class="form-check-label" for="remember">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                        {{-- <div class="col-6">
                                            <div class="forgot-password text-end">
                                                <a href="{{ route('password.request') }}">Forgot password?</a>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                                {{-- <div class="password mb-3">
                                    <div class="text-center">
                                        {!! htmlFormSnippet() !!}
                                    </div>
                                    @error('g-recaptcha-response')
                                        <span class="fv-help-block text-center" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                <div class="text-center">
                                    <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">
                                        Log In
                                    </button>
                                </div>
                            </form>

                            <div class="auth-option text-center pt-5">No Account? Sign up
                                <a class="text-link" href="{{ route('register') }}">here</a>.
                            </div>
                        </div><!--//auth-form-container-->

                    </div><!--//auth-body-->

                    <footer class="app-auth-footer">
                        <x-footer></x-footer>
                    </footer>
                    <!--//app-auth-footer-->

                </div><!--//flex-column-->
            </div><!--//auth-main-col-->

            <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
                {{-- change image below --}}
                {{-- <div class="auth-background-holder"></div> --}}
                <img src="https://static.promediateknologi.id/crop/0x0:0x0/750x500/photo/p2/77/2024/06/08/adhy-kurban-1453939168.jpg"
                    alt="" style="height: 100vh; width: 100%; object-fit: cover">

                <div class="auth-background-mask"></div>
            </div><!--//auth-background-col-->
        </div><!--//row-->

    </body>
</x-layouts.auth>

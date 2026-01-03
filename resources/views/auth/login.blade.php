<style>
    .auth-background-col {
        position: relative;
        height: 100vh;
        overflow: hidden;
    }

    .auth-background-col img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* gambar menyesuaikan kolom */
        object-position: center;
    }

    .auth-background-mask {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        /* opsional overlay */
    }
</style>
<x-layouts.auth>

    <body class="app app-login p-0">
        <div class="row g-0 app-auth-wrapper">
            <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
                <div class="d-flex flex-column align-content-end">
                    <div class="app-auth-body mx-auto">

                        <div class="app-auth-branding mb-4">
                            <a class="h1 app-logo" href="{{ env('APP_URL') }}">
                                <img style="width: 160px; object-fit: cover;" src="{{ asset('storage/' . $set_logo) }}"
                                    alt="logo">
                            </a>
                        </div>

                        <h2 class="auth-heading text-center mb-5">Log in</h2>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <x-flash-message></x-flash-message>

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
                                    <button type="submit" class="btn w-100 mx-auto btn-info text-white">
                                        Log In
                                    </button>
                                </div>
                            </form>

                            <div class="auth-option text-center pt-5">No Account? Sign up
                                <a class="text-info" href="{{ route('register') }}">
                                    <u>here</u>
                                </a>.
                            </div>
                        </div>

                    </div>

                    <footer class="app-auth-footer">
                        <x-footer></x-footer>
                    </footer>
                </div>
            </div>

            <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
                {{-- <div class="auth-background-holder"></div> --}}
                <img src="{{ asset('assets') }}/images/background-login2.jpg" alt="" class="pl-4">
                <div class="auth-background-mask"></div>
            </div>
        </div>
    </body>

</x-layouts.auth>

<x-layouts.auth>

    <body class="app app-signup p-0">
        <div class="row g-0 app-auth-wrapper">
            <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
                <div class="d-flex flex-column align-content-end">
                    <div class="app-auth-body mx-auto">

                        {{-- <div class="app-auth-branding mb-4">
                            <a class="app-logo" href="{{ env('APP_URL') }}">
                                <img class="logo-icon me-2" src="{{ asset('assets') }}/images/app-logo.svg"
                                    alt="logo">
                            </a>
                        </div> --}}

                        <h2 class="auth-heading text-center mb-4">Sign up</h2>

                        <div class="auth-form-container text-start mx-auto">
                            <form class="auth-form auth-signup-form" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="sr-only" for="name">Nama</label>
                                    <input id="name" name="name" type="text" class="form-control signup-name"
                                        placeholder="Nama Lengkap" required="required" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="sr-only" for="email">Email</label>
                                    <input id="email" name="email" type="email"
                                        class="form-control signup-email" placeholder="Email" required="required"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="sr-only" for="no_telp">No Telpon (WA)</label>
                                    <input id="no_telp" name="no_telp" type="number" class="form-control"
                                        placeholder="628xxxxxxxxxx" required="required" value="{{ old('no_telp') }}">
                                    @error('no_telp')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="sr-only" for="nik">NIK</label>
                                    <input id="nik" name="nik" type="number" class="form-control"
                                        placeholder="NIK" required="required" value="{{ old('nik') }}">
                                    @error('nik')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="password mb-3">
                                    <label class="sr-only" for="password">Password Baru</label>
                                    <input id="password" name="password" type="password"
                                        class="form-control signup-password" placeholder="Password Baru"
                                        required="required">
                                    @error('password')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="password mb-3">
                                    <label class="sr-only" for="password_confirmation">Konfirmasi Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control signup-password" placeholder="Konfirmasi Password"
                                        required="required">
                                    @error('password_confirmation')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">
                                        Sign Up
                                    </button>
                                </div>
                            </form>

                            <div class="auth-option text-center pt-1">Already have an account?
                                <a class="text-link" href="{{ route('login') }}">Log in</a>
                            </div>
                        </div>

                    </div>

                    <footer class="app-auth-footer">
                        <x-footer></x-footer>
                    </footer>
                    <!--//app-auth-footer-->

                </div><!--//flex-column-->
            </div><!--//auth-main-col-->
            <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
                {{-- change image below --}}
                <div class="auth-background-holder"></div>

                <div class="auth-background-mask"></div>
            </div><!--//auth-background-col-->

        </div><!--//row-->

    </body>
</x-layouts.auth>

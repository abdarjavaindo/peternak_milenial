<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
<x-layouts.auth>

    <body class="app app-signup p-0">
        <div class="row g-0 app-auth-wrapper">
            <div class="col-12 col-md-7 col-lg-8 auth-main-col text-center p-4">
                <div class="d-flex flex-column align-content-end">

                    <h2 class="auth-heading text-center mb-4">Sign up</h2>
                    <x-flash-message></x-flash-message>

                    <div class="auth-form-container text-start">
                        <form class="auth-form auth-signup-form" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="sr-only" for="name">Nama</label>
                                        <input id="name" name="name" type="text"
                                            class="form-control signup-name" placeholder="Nama Lengkap"
                                            required="required" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="sr-only" for="email">Email</label>
                                        <input id="email" name="email" type="email"
                                            class="form-control signup-email" placeholder="Email" required="required"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="sr-only" for="no_telp">No Telpon (WA)</label>
                                        <input id="no_telp" name="no_telp" type="number" class="form-control"
                                            placeholder="628xxxxxxxxxx" required="required"
                                            value="{{ old('no_telp') }}">
                                        @error('no_telp')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="sr-only" for="nik">NIK</label>
                                        <input id="nik" name="nik" type="number" class="form-control"
                                            placeholder="NIK" required="required" value="{{ old('nik') }}">
                                        @error('nik')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control"
                                            placeholder="Tanggal Lahir" required="required"
                                            value="{{ old('tgl_lahir') }}">
                                        @error('tgl_lahir')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="kabupaten">Kabupaten/Kota</label>
                                        <select class="form-select" id="kabupaten" name="kabupaten" required>
                                            <option value="">Pilih Kabupaten ...</option>
                                            @foreach ($kabupaten as $kab)
                                                <option value="{{ $kab->nama }}">{{ $kab->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kabupaten')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="kecamatan">Kecamatan</label>
                                        <select class="form-select" id="kecamatan" name="kecamatan" required>
                                            <option value="">Pilih Kecamatan ...</option>
                                            @foreach ($kecamatan as $kec)
                                                <option value="{{ $kec->nama }}">{{ $kec->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kecamatan')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="desa">Kelurahan/Desa</label>
                                        <select class="form-select" id="desa" name="desa" required>
                                            <option value="">Pilih Desa ...</option>
                                            @foreach ($desa as $des)
                                                <option value="{{ $des->nama }}">{{ $des->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('desa')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="password mb-3">
                                        <label class="sr-only" for="password">Password Baru</label>
                                        <input id="password" name="password" type="password"
                                            class="form-control signup-password" placeholder="Password Baru"
                                            required="required">
                                        @error('password')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="password mb-3">
                                        <label class="sr-only" for="password_confirmation">Konfirmasi
                                            Password</label>
                                        <input id="password_confirmation" name="password_confirmation"
                                            type="password" class="form-control signup-password"
                                            placeholder="Konfirmasi Password" required="required">
                                        @error('password_confirmation')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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

                    <footer class="app-auth-footer">
                        <x-footer></x-footer>
                    </footer>

                </div>
            </div>
            <div class="col-12 col-md-5 col-lg-4 h-100 auth-background-col">
                <div class="auth-background-holder"></div>
                <div class="auth-background-mask"></div>
            </div>
        </div>
    </body>
</x-layouts.auth>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#kabupaten').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
    $('#kecamatan').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
    $('#desa').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
</script>

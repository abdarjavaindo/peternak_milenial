<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
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

    @media (min-width: 992px) {

        /* area konten bisa di scroll */
        .auth-scroll {
            height: 100vh;
            overflow-y: auto;
        }

        /* background tetap */
        .auth-background-col-fixed {
            position: fixed;
            top: 0;
            right: 0;
            width: 33.333333%;
            height: 100vh;
            overflow: hidden;
        }

        .auth-background-col-fixed img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }

    /* mask tetap */
    .auth-background-mask {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
    }
</style>
<style>
    .eye-slash {
        position: relative;
    }

    .eye-slash::after {
        content: '';
        position: absolute;
        width: 22px;
        height: 2px;
        background: #555;
        top: 50%;
        left: -1px;
        transform: rotate(-45deg);
    }
</style>

<x-layouts.auth>

    <body class="app app-signup p-0">
        <div class="row g-0 app-auth-wrapper">
            <div class="col-12 col-md-7 col-lg-8 auth-main-col text-center p-4 auth-scroll">
                <div class="d-flex flex-column align-content-end">

                    <h2 class="auth-heading text-center mb-4">Sign up</h2>
                    <x-flash-message></x-flash-message>

                    <div class="auth-form-container text-start">
                        <form class="auth-form auth-signup-form" method="POST" action="{{ route('register') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="" for="name">
                                            Nama<span class="text-danger">*</span>
                                        </label>
                                        <input id="name" name="name" type="text"
                                            class="form-control border border-1 border-secondary"
                                            placeholder="Nama Lengkap" required="required" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="" for="email">
                                            Email<span class="text-danger">*</span>
                                        </label>
                                        <input id="email" name="email" type="email"
                                            class="form-control border border-1 border-secondary" placeholder="Email"
                                            required="required" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                        <small class="text-danger error-msg" id="emailError"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="" for="no_telp">
                                            No Telpon (WA)<span class="text-danger">*</span>
                                        </label>
                                        <input id="no_telp" name="no_telp" type="number"
                                            class="form-control border border-1 border-secondary"
                                            placeholder="628xxxxxxxxxx" required="required"
                                            value="{{ old('no_telp') }}">
                                        @error('no_telp')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                        <small class="text-danger error-msg" id="telpError"></small>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="" for="nik">
                                            NIK<span class="text-danger">*</span>
                                        </label>
                                        <input id="nik" name="nik" type="number"
                                            class="form-control border border-1 border-secondary" placeholder="NIK"
                                            required="required" value="{{ old('nik') }}">
                                        @error('nik')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                        <small class="text-danger error-msg" id="nikError"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="tgl_lahir">
                                            Tanggal Lahir<span class="text-danger">*</span>
                                        </label>
                                        <input id="tgl_lahir" name="tgl_lahir" type="date"
                                            class="form-control border border-1 border-secondary" required="required"
                                            value="{{ old('tgl_lahir') }}">
                                        @error('tgl_lahir')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                        <small id="tglError" class="text-danger"></small>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="kabupaten" class="">
                                            Kabupaten/Kota<span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-control border border-1 border-secondary"
                                            id="kabupaten" name="kabupaten" required>
                                            <option value="">Pilih Kabupaten ...</option>
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
                                        <label for="kecamatan" class="">
                                            Kecamatan<span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-control border border-1 border-secondary"
                                            id="kecamatan" name="kecamatan" required>
                                            <option value="">Pilih Kecamatan ...</option>
                                        </select>
                                        @error('kecamatan')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="desa" class="">
                                            Kelurahan/Desa<span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-control border border-1 border-secondary"
                                            id="desa" name="desa" required>
                                            <option value="">Pilih Desa ...</option>
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
                                        <label class="" for="password">
                                            Password Baru<span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input id="password" name="password" type="password"
                                                class="form-control border border-1 border-secondary"
                                                placeholder="Password Baru" required>

                                            <span class="input-group-text toggle-password" data-target="password"
                                                style="cursor:pointer">
                                                <!-- EYE OPEN -->
                                                <svg class="eye-open" width="20" height="20"
                                                    viewBox="0 0 24 24">
                                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"
                                                        fill="none" stroke="currentColor" stroke-width="2" />
                                                    <circle cx="12" cy="12" r="3" fill="none"
                                                        stroke="currentColor" stroke-width="2" />
                                                </svg>

                                                <!-- EYE CLOSED -->
                                                <svg class="eye-close d-none" width="20" height="20"
                                                    viewBox="0 0 24 24">
                                                    <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7
                 a21.87 21.87 0 0 1 5.06-5.94M9.9 4.24
                 A9.77 9.77 0 0 1 12 4c7 0 11 7 11 7
                 a21.87 21.87 0 0 1-2.88 4.19M1 1l22 22" fill="none" stroke="currentColor" stroke-width="2" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('password')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                        <small id="passwordError" class="text-danger"></small>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="password mb-3">
                                        <label class="" for="password_confirmation">
                                            Konfirmasi Password<span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input id="password_confirmation" name="password_confirmation"
                                                type="password" class="form-control border border-1 border-secondary"
                                                placeholder="Konfirmasi Password" required>

                                            <span class="input-group-text toggle-password"
                                                data-target="password_confirmation" style="cursor:pointer">
                                                <!-- EYE OPEN -->
                                                <svg class="eye-open" width="20" height="20"
                                                    viewBox="0 0 24 24">
                                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"
                                                        fill="none" stroke="currentColor" stroke-width="2" />
                                                    <circle cx="12" cy="12" r="3" fill="none"
                                                        stroke="currentColor" stroke-width="2" />
                                                </svg>

                                                <!-- EYE CLOSED -->
                                                <svg class="eye-close d-none" width="20" height="20"
                                                    viewBox="0 0 24 24">
                                                    <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7
                 a21.87 21.87 0 0 1 5.06-5.94M9.9 4.24
                 A9.77 9.77 0 0 1 12 4c7 0 11 7 11 7
                 a21.87 21.87 0 0 1-2.88 4.19M1 1l22 22" fill="none" stroke="currentColor" stroke-width="2" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('password_confirmation')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                        <small id="confirmError" class="text-danger"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="nama_ternak" class="">
                                            Ternak yang Dimiliki<span class="text-danger">*</span>
                                        </label>
                                        <select type="text" class="form-select border border-1 border-secondary"
                                            id="nama_ternak" name="nama_ternak" required>
                                            <option value="">Pilih ...</option>
                                            @foreach ($kategori_produk as $item)
                                                <option value="{{ $item->nama_kategori }}">
                                                    {{ $item->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_produk_id')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="jumlah" class="">
                                            Jumlah Ternak yang Dimiliki<span class="text-danger">*</span>
                                        </label>
                                        <input type="text" id="jumlah" name="jumlah"
                                            class="form-control border border-1 border-secondary"
                                            value="{{ isset($ternak) ? number_format($ternak->jumlah, 0, ',', '.') : old('jumlah') }}"
                                            required placeholder="Jumlah Ternak yang Dimiliki (per ekor)"
                                            inputmode="numeric" autocomplete="off">
                                        @error('jumlah')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <label for="img_ktp" class="">
                                        Foto Berkas KTP<span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control bg-light border-black" type="file" id="img_ktp"
                                        name="img_ktp" accept=".jpg,.jpeg,.png" required>
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small><span class="text-danger">*</span> Tipe: jpeg, png, dan jpg</small><br>
                                    @error('img_ktp')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn w-100 mx-auto text-white"
                                    style="background-color: #052e70" id="btnSubmit" disabled>
                                    Sign Up
                                </button>
                            </div>
                        </form>

                        <div class="auth-option text-center pt-1">Already have an account?
                            <a class="text-info" href="{{ route('login') }}">
                                <u>
                                    Log in
                                </u>
                            </a>
                        </div>
                        <div class="my-4"></div>
                    </div>

                    <footer class="app-auth-footer">
                        <x-footer></x-footer>
                    </footer>

                </div>
            </div>
            <div class="col-12 col-md-5 col-lg-4 h-100 auth-background-col-fixed auth-background-col">
                <img src="{{ asset('assets') }}/images/background-loginrg.jpg" alt="" class="pl-4">
                <div class="auth-background-mask"></div>
            </div>
        </div>
    </body>
</x-layouts.auth>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const email = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        let emailValid = false;
        let emailtypingTimer;
        let emailvalidationActive = false;

        function emailactivateValidation() {
            emailvalidationActive = true;
        }
        [email].forEach(el => {
            el.addEventListener('focus', emailactivateValidation);
        });

        function validateEmailFormat(value) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        }

        function resetEmail() {
            clearTimeout(emailtypingTimer);
            email.value = '';
            emailError.textContent = '';
            emailValid = false;
            // Matikan validasi sebentar supaya input event tidak chaos
            emailvalidationActive = false;
            setTimeout(() => {
                emailvalidationActive = true;
                // email.focus();
            }, 100);
        }

        function checkEmailDB(value) {
            fetch("{{ route('check.email') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf
                    },
                    body: JSON.stringify({
                        email: value
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.exists) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Email sudah digunakan',
                            text: 'Email yang kamu input sudah digunakan oleh peternak lain',
                            confirmButtonColor: '#17a2b8'
                        }).then(() => {
                            resetEmail();
                        });
                        emailValid = false;
                    } else {
                        emailError.textContent = '';
                        emailValid = true;
                    }
                });
        }

        email.addEventListener('input', function() {
            if (!emailvalidationActive) return;
            clearTimeout(emailtypingTimer);
            const value = email.value.trim().toLowerCase();
            email.value = value;
            if (!value) {
                emailError.textContent = 'Email wajib diisi';
                emailValid = false;
                return;
            }
            if (!validateEmailFormat(value)) {
                emailError.textContent = 'Format email tidak valid';
                emailValid = false;
                return;
            }
            emailtypingTimer = setTimeout(() => checkEmailDB(value), 600);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const telp = document.getElementById('no_telp');
        const telpError = document.getElementById('telpError');
        let telpvalidationActive = false;

        function telpactivateValidation() {
            telpvalidationActive = true;
        }
        telp.addEventListener('focus', telpactivateValidation);

        function validateTelp() {
            if (!telpvalidationActive) return false;
            const value = telp.value.trim();
            if (!value) return telpError.textContent = 'No Telpon wajib diisi', false;
            if (!/^62[0-9]{8,13}$/.test(value))
                return telpError.textContent = 'No Telpon harus diawali 62', false;
            telpError.textContent = '';
            return true;
        }
        telp.addEventListener('input', validateTelp);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nik = document.getElementById('nik');
        const nikError = document.getElementById('nikError');
        const csrf = document.querySelector('meta[name="csrf-token"]').content;

        let nikValid = false;
        let nikTypingTimer;
        let nikvalidationActive = false;

        function nikactivateValidation() {
            nikvalidationActive = true;
        }
        nik.addEventListener('focus', nikactivateValidation);

        function validateNik() {
            if (!nikvalidationActive) return false;
            const value = nik.value.trim();
            if (!value) return nikError.textContent = 'NIK wajib diisi', false;
            if (!value.startsWith('35'))
                return nikError.textContent = 'NIK bukan wilayah Jawa Timur', false;
            if (!/^[0-9]{16}$/.test(value))
                return nikError.textContent = 'NIK harus 16 digit angka', false;
            nikError.textContent = '';
            return true;
        }

        function resetNik() {
            clearTimeout(nikTypingTimer);
            nik.value = '';
            nikError.textContent = '';
            nikValid = false;
            nikvalidationActive = false;
            setTimeout(() => {
                nikvalidationActive = true;
                // nik.focus();
            }, 100);
        }

        function checkNikDB(value) {
            fetch("{{ route('check.nik') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf
                    },
                    body: JSON.stringify({
                        nik: value
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.exists) {
                        Swal.fire({
                            icon: 'error',
                            title: 'NIK sudah terdaftar',
                            text: 'NIK yang kamu input sudah digunakan oleh pengguna lain',
                            confirmButtonColor: '#17a2b8',
                            allowOutsideClick: false
                        }).then(() => resetNik());
                        nikValid = false;
                    } else {
                        nikError.textContent = '';
                        nikValid = true;
                    }
                });
        }

        nik.addEventListener('input', function() {
            if (!nikvalidationActive) return;
            clearTimeout(nikTypingTimer);
            const value = nik.value.trim();
            if (!validateNik()) {
                return;
            }
            nikTypingTimer = setTimeout(() => {
                checkNikDB(value);
            }, 600);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tgl = document.getElementById('tgl_lahir');
        const tglError = document.getElementById('tglError');
        // ❌ Blokir input manual tanggal
        tgl.addEventListener('keydown', function(e) {
            e.preventDefault();
        });

        // ❌ Blokir paste
        tgl.addEventListener('paste', function(e) {
            e.preventDefault();
        });

        // ❌ Blokir input via drag/drop
        tgl.addEventListener('drop', function(e) {
            e.preventDefault();
        });

        let tglvalidationActive = false;

        function tglactivateValidation() {
            tglvalidationActive = true;
        }
        tgl.addEventListener('focus', tglactivateValidation);

        function getAge(dateString) {
            const today = new Date();
            const birth = new Date(dateString);
            if (isNaN(birth.getTime())) return null; // tanggal belum valid
            let age = today.getFullYear() - birth.getFullYear();
            const m = today.getMonth() - birth.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
            return age;
        }

        function resetTanggal() {
            tgl.value = '';
            tglError.textContent = '';
            setTimeout(() => {
                // tgl.focus();
            }, 100);
        }

        function validateTanggal() {
            if (!tglvalidationActive) return;
            const value = tgl.value;
            // 🔒 Jangan validasi kalau belum lengkap
            if (!/^\d{4}-\d{2}-\d{2}$/.test(value)) {
                tglError.textContent = '';
                return;
            }
            const age = getAge(value);
            if (age === null) return;
            if (age < 19 || age > 39) {
                tglError.textContent = '';
                Swal.fire({
                    icon: 'error',
                    title: 'Umur Tidak Valid',
                    text: 'Umur harus antara 19 sampai 39 tahun',
                    confirmButtonColor: '#17a2b8',
                    allowOutsideClick: false
                }).then(() => {
                    resetTanggal();
                });
                return;
            }
            tglError.textContent = '';
        }
        // ✅ gunakan change → lebih stabil untuk input date
        tgl.addEventListener('change', validateTanggal);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        const submitBtn = document.getElementById('btnSubmit');
        const passwordError = document.getElementById('passwordError');
        const confirmError = document.getElementById('confirmError');
        let passwordValid = false;
        let confirmValid = false;

        function validatePassword() {
            const value = password.value;
            const rules = [
                value.length >= 8,
                /[a-z]/.test(value),
                /[A-Z]/.test(value),
                /[0-9]/.test(value),
                /[^A-Za-z0-9]/.test(value)
            ];
            if (!value) {
                passwordError.textContent = 'Password wajib diisi';
                passwordValid = false;
            } else if (rules.includes(false)) {
                passwordError.textContent =
                    'Password minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol';
                passwordValid = false;
            } else {
                passwordError.textContent = '';
                passwordValid = true;
            }
            validateConfirm();
            toggleButton();
        }

        function validateConfirm() {
            if (!confirm.value) {
                confirmError.textContent = 'Konfirmasi password wajib diisi';
                confirmValid = false;
            } else if (confirm.value !== password.value) {
                confirmError.textContent = 'Konfirmasi password tidak cocok';
                confirmValid = false;
            } else {
                confirmError.textContent = '';
                confirmValid = true;
            }
            toggleButton();
        }

        function toggleButton() {
            submitBtn.disabled = !(passwordValid && confirmValid);
        }
        password.addEventListener('input', validatePassword);
        confirm.addEventListener('input', validateConfirm);
    });
</script>
<script>
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = document.getElementById(this.dataset.target);
            if (!input) return;

            const eyeOpen = this.querySelector('.eye-open');
            const eyeClose = this.querySelector('.eye-close');

            const isHidden = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';

            eyeOpen.classList.toggle('d-none', isHidden);
            eyeClose.classList.toggle('d-none', !isHidden);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('img_ktp');

        const MAX_SIZE = 10 * 1024 * 1024; // 10 MB
        const ALLOWED_EXT = ['jpg', 'jpeg', 'png'];

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            const fileSize = file.size;
            const fileName = file.name.toLowerCase();
            const ext = fileName.split('.').pop();

            /* ===============================
               VALIDASI EXTENSION
            =============================== */
            if (!ALLOWED_EXT.includes(ext)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Format File Tidak Valid',
                    text: 'File harus bertipe JPG, JPEG, atau PNG',
                    confirmButtonColor: '#17a2b8',
                    allowOutsideClick: false
                }).then(() => {
                    fileInput.value = '';
                });
                return;
            }

            /* ===============================
               VALIDASI UKURAN
            =============================== */
            if (fileSize > MAX_SIZE) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran File Terlalu Besar',
                    text: 'Ukuran maksimal file adalah 10 MB',
                    confirmButtonColor: '#17a2b8',
                    allowOutsideClick: false
                }).then(() => {
                    fileInput.value = '';
                });
                return;
            }
        });
    });
</script>

<script>
    // untuk mengatur select alamat
    document.addEventListener('DOMContentLoaded', function() {

        // --- Inisialisasi Select2 ---
        $('#kabupaten').select2({
            theme: "bootstrap-5",
            placeholder: "Pilih Kabupaten..."
        });
        $('#kecamatan').select2({
            theme: "bootstrap-5",
            placeholder: "Pilih Kecamatan..."
        });
        $('#desa').select2({
            theme: "bootstrap-5",
            placeholder: "Pilih Desa..."
        });

        // --- Load Kabupaten ---
        fetch('/wilayah/kabupaten')
            .then(res => res.json())
            .then(data => {
                let select = $('#kabupaten');
                select.empty().append(`<option value="">Pilih Kabupaten ...</option>`);

                data.forEach(item => {
                    select.append(`<option value="${item.kode}">${item.nama}</option>`);
                });

                select.trigger('change'); // penting!
            });

        // --- Ketika Kabupaten Dipilih → Load Kecamatan ---
        $('#kabupaten').on('change', function() {
            let kab = $(this).val();

            $('#kecamatan').empty().append(`<option value="">Kecamatan ...</option>`).trigger('change');
            $('#desa').empty().append(`<option value="">Desa ...</option>`).trigger('change');

            if (!kab) return;

            fetch('/wilayah/kecamatan?kabupaten=' + kab)
                .then(res => res.json())
                .then(data => {
                    let kec = $('#kecamatan');
                    kec.empty().append(`<option value="">Kecamatan ...</option>`);

                    data.forEach(item => {
                        kec.append(`<option value="${item.kode}">${item.nama}</option>`);
                    });

                    kec.trigger('change'); // refresh Select2
                });
        });

        // --- Ketika Kecamatan Dipilih → Load Desa ---
        $('#kecamatan').on('change', function() {
            let kec = $(this).val();

            $('#desa').empty().append(`<option value="">Desa ...</option>`).trigger('change');

            if (!kec) return;

            fetch('/wilayah/desa?kecamatan=' + kec)
                .then(res => res.json())
                .then(data => {
                    let desa = $('#desa');
                    desa.empty().append(`<option value="">Desa ...</option>`);

                    data.forEach(item => {
                        desa.append(`<option value="${item.kode}">${item.nama}</option>`);
                    });

                    desa.trigger('change');
                });
        });

    });
</script>

<script>
    // untuk mengatur jumlah ternak
    var harga = document.getElementById("jumlah");

    harga.addEventListener("keyup", function(e) {
        this.value = formatRibuan(this.value);
    });

    function formatRibuan(angka) {
        // hapus semua selain angka
        var number_string = angka.replace(/[^0-9]/g, '');

        // format ribuan dengan titik
        var sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            var separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        return rupiah;
    }
</script>

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
                                            Nama
                                            <span class="text-danger"><i>(required)</i></span>
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
                                            Email
                                            <span class="text-danger"><i>(required)</i></span>
                                        </label>
                                        <input id="email" name="email" type="email"
                                            class="form-control border border-1 border-secondary" placeholder="Email"
                                            required="required" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="" for="no_telp">
                                            No Telpon (WA)
                                            <span class="text-danger"><i>(required)</i></span>
                                        </label>
                                        <input id="no_telp" name="no_telp" type="number"
                                            class="form-control border border-1 border-secondary"
                                            placeholder="628xxxxxxxxxx" required="required"
                                            value="{{ old('no_telp') }}">
                                        @error('no_telp')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="" for="nik">
                                            NIK
                                            <span class="text-danger"><i>(required)</i></span>
                                        </label>
                                        <input id="nik" name="nik" type="number"
                                            class="form-control border border-1 border-secondary" placeholder="NIK"
                                            required="required" value="{{ old('nik') }}">
                                        @error('nik')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="tgl_lahir">
                                            Tanggal Lahir
                                            <span class="text-danger"><i>(required)</i></span>
                                        </label>
                                        <input id="tgl_lahir" name="tgl_lahir" type="date"
                                            class="form-control border border-1 border-secondary"
                                            placeholder="Tanggal Lahir" required="required"
                                            value="{{ old('tgl_lahir') }}">
                                        @error('tgl_lahir')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="kabupaten" class="">
                                            Kabupaten/Kota
                                            <span class="text-danger"><i>(required)</i></span>
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
                                            Kecamatan
                                            <span class="text-danger"><i>(required)</i></span>
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
                                            Kelurahan/Desa
                                            <span class="text-danger"><i>(required)</i></span>
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
                                            Password Baru
                                            <span class="text-danger"><i>(required)</i></span>
                                        </label>
                                        <input id="password" name="password" type="password"
                                            class="form-control border border-1 border-secondary"
                                            placeholder="Password Baru" required="required">
                                        @error('password')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="password mb-3">
                                        <label class="" for="password_confirmation">
                                            Konfirmasi Password
                                            <span class="text-danger"><i>(required)</i></span>
                                        </label>
                                        <input id="password_confirmation" name="password_confirmation"
                                            type="password" class="form-control border border-1 border-secondary"
                                            placeholder="Konfirmasi Password" required="required">
                                        @error('password_confirmation')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="nama_ternak" class="">
                                            Hewan yang Diternakkan
                                        </label>
                                        <select type="text" class="form-select border border-1 border-secondary"
                                            id="nama_ternak" name="nama_ternak" required>
                                            <option value="">Pilih ...</option>
                                            <!-- Ternak Besar -->
                                            <option value="Sapi Potong">Sapi Potong</option>
                                            <option value="Sapi Perah">Sapi Perah</option>
                                            <option value="Kerbau">Kerbau</option>
                                            <!-- Ternak Kecil -->
                                            <option value="Domba/Kambing">Domba/Kambing</option>
                                            <option value="Babi">Babi</option>
                                            <!-- Ternak Unggas -->
                                            <option value="Ayam Petelur">Ayam Petelur</option>
                                            <option value="Ayam Pedaging">Ayam Pedaging</option>
                                            <option value="Burung Puyuh">Burung Puyuh</option>
                                        </select>
                                        @error('nama_ternak')
                                            <span class="text-danger" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="nama_ternak" class="">
                                            Ternak yang Dimiliki
                                            <span class="text-danger"><i>(required)</i></span>
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
                                            Jumlah Ternak yang Dimiliki
                                            <span class="text-danger"><i>(required)</i></span>
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
                                        Foto Berkas KTP
                                        <span class="text-danger"><i>(required)</i></span>
                                    </label>
                                    <input class="form-control bg-light border-black" type="file" id="img_ktp"
                                        name="img_ktp" required>
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small><span class="text-danger">*</span> Tipe: jpeg, png, dan jpg</small><br>
                                    @error('img_ktp')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn w-100 mx-auto btn-info text-white">
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
<script>
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

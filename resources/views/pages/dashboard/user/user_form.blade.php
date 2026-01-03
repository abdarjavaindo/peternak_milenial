<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($adminbasic) ? 'Edit' : 'Tambah' }} User</h1>

    <section class="section">
        <x-flash-message></x-flash-message>

        {{-- @if (isset($adminbasic))
            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <a class="flex-sm-fill text-sm-center nav-link active"
                    href="{{ route('user.edit', $adminbasic->id) }}">Edit User</a>
                <a class="flex-sm-fill text-sm-center nav-link"
                    href="{{ route('user.komuditas', $adminbasic->id) }}">Komuditas</a>
            </nav>
        @endif --}}

        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($adminbasic) ? route('user.update', $adminbasic->id) : route('user.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($adminbasic))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="email" class="form-label">Email
                                <span class="{{ isset($adminbasic) ? 'text-warning' : 'text-danger' }}">
                                    <i>{{ isset($adminbasic) ? '(read only)' : '(required)' }}</i>
                                </span>
                            </label>
                            <input type="email"
                                class="form-control {{ isset($adminbasic) ? 'bg-light border-black' : '' }}"
                                id="email" name="email"
                                value="{{ isset($adminbasic) ? $adminbasic->email : old('email') }}"
                                {{ isset($adminbasic) ? 'readonly' : 'required' }}>
                            @error('email')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ isset($adminbasic) ? $adminbasic->name : old('name') }}" required>
                            @error('name')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="no_telp">
                                No Telpon (WA)
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input id="no_telp" name="no_telp" type="number" class="form-control"
                                placeholder="628xxxxxxxxxx" required="required"
                                value="{{ isset($adminbasic) ? $adminbasic->no_telp : old('no_telp') }}">
                            @error('no_telp')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nik" class="form-label">
                                NIK
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ isset($adminbasic) ? $adminbasic->nik : old('nik') }}" required>
                            @error('nik')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span
                                    class="text-danger"><i>{{ isset($adminbasic) ? '' : '(required)' }}</i></span></label>
                            <input type="password" class="form-control" id="password" name="password"
                                {{ isset($adminbasic) ? '' : 'required' }}>
                            @error('password')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Konfirmasi Password <span
                                    class="text-danger"><i>{{ isset($adminbasic) ? '' : '(required)' }}</i></span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="form-control" {{ isset($adminbasic) ? '' : 'required' }}>
                            @error('password_confirmation')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">
                                Tanggal Lahir
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control"
                                required="required"
                                value="{{ isset($adminbasic) ? $adminbasic->tgl_lahir : old('tgl_lahir') }}">
                            @error('tgl_lahir')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kabupaten" class="form-label">
                                Kabupaten/Kota
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select class="form-select form-control" id="kabupaten" name="kabupaten" required>
                                <option value="">Pilih Kabupaten ...</option>
                                @foreach ($kabupaten as $kab)
                                    <option value="{{ $kab->nama }}"
                                        {{ @$adminbasic->kabupaten == $kab->nama ? 'selected' : '' }}>
                                        {{ $kab->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kabupaten')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">
                                Kecamatan
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select class="form-select form-control" id="kecamatan" name="kecamatan" required>
                                <option value="">Pilih Kecamatan ...</option>
                                @foreach ($kecamatan as $kec)
                                    <option value="{{ $kec->nama }}"
                                        {{ @$adminbasic->kecamatan == $kec->nama ? 'selected' : '' }}>
                                        {{ $kec->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kecamatan')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="desa" class="form-label">
                                Kelurahan/Desa
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select class="form-select form-control" id="desa" name="desa" required>
                                <option value="">Pilih Desa ...</option>
                                @foreach ($desa as $des)
                                    <option value="{{ $des->nama }}"
                                        {{ @$adminbasic->desa == $des->nama ? 'selected' : '' }}>
                                        {{ $des->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('desa')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="img_ktp" class="form-label">
                                Foto Berkas KTP
                                @if (!isset($adminbasic))
                                    <span class="text-danger"><i>(required)</i></span>
                                @endif
                            </label>
                            <div class="row">
                                @if (@$adminbasic->img_ktp)
                                    <div class="col-lg-4 mt-1 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="{{ url('storage/' . $adminbasic->img_ktp) }}">
                                                    <img src="{{ asset('storage/' . $adminbasic->img_ktp) }}"
                                                        class="img-fluid" alt=""
                                                        style="width: 100%; height: auto;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-8">
                                    <input class="form-control bg-light border-black" type="file" id="img_ktp"
                                        name="img_ktp" {{ isset($adminbasic) ? '' : 'required' }}>
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small>
                                        <span class="text-danger">*</span>
                                        Tipe: jpeg, png, dan jpg
                                    </small><br>
                                    @error('img_ktp')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if (!isset($adminbasic))
                            <hr>
                            <div class="mb-3">
                                <label for="nama_ternak" class="form-label">
                                    Ternak yang Dimiliki
                                    <span class="text-danger"><i>(required)</i></span>
                                </label>
                                <select type="text" class="form-select" id="nama_ternak" name="nama_ternak"
                                    required>
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

                            <div class="mb-3">
                                <label for="jumlah" class="form-label">
                                    Jumlah Ternak yang Dimiliki
                                    <span class="text-danger"><i>(required)</i></span>
                                </label>
                                <input type="text" id="jumlah" name="jumlah" class="form-control"
                                    value="{{ isset($ternak) ? number_format($ternak->jumlah, 0, ',', '.') : old('jumlah') }}"
                                    required placeholder="per ekor" inputmode="numeric" autocomplete="off">
                                @error('jumlah')
                                    <span class="text-danger" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <div class="" align="right">
                            <a href="{{ route('user') }}" class="btn btn-light text-black">Kembali</a>
                            <button type="submit" class="btn text-white"
                                style="background-color: #165d7d">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.dashboard>
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
<script>
    var harga = document.getElementById("jumlah");
    harga.addEventListener("keyup", function(e) {
        this.value = formatRibuan(this.value);
    });

    function formatRibuan(angka) {
        var number_string = angka.replace(/[^0-9]/g, '');
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

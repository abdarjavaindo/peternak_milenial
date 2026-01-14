<!-- Styles -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($kursus) ? 'Edit' : 'Tambah' }} Pelatihan</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($kursus) ? route('pembelajaran.update', $kursus->id) : route('pembelajaran.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($kursus))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="judul" class="form-label">
                                Judul Pelatihan
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control bg-light border-black" id="judul"
                                name="judul" value="{{ isset($kursus) ? $kursus->judul : old('judul') }}" required>
                            @error('judul')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori_kursus_id" class="form-label">
                                Kategori Pelatihan
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select type="text" class="form-select bg-light border-black" id="kategori_kursus_id"
                                name="kategori_kursus_id" required>
                                <option value="">Pilih ...</option>
                                <option value="1"
                                    {{ old('kategori_kursus_id') == '1' || @$kursus->kategori_kursus_id == '1' ? 'selected' : '' }}>
                                    Kursus Online
                                </option>
                                {{-- @foreach ($kategori_kursus as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kategori_kursus_id') == $item->id || @$kursus->kategori_kursus_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}</option>
                                @endforeach --}}
                            </select>
                            @error('kategori_kursus_id')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori_produk_id" class="form-label">
                                Komuditas
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select type="text" class="form-select bg-light border-black" id="kategori_produk_id"
                                name="kategori_produk_id" required>
                                <option value="">Pilih ...</option>
                                @foreach ($ketegori_produk as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kategori_produk_id') == $item->id || @$kursus->kategori_produk_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_produk_id')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="level" class="form-label">
                                Level
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select type="text" class="form-select bg-light border-black" id="level"
                                name="level" required>
                                <option value="">Pilih ...</option>
                                <option value="pemula"
                                    {{ old('level') == 'pemula' || @$kursus->level == 'pemula' ? 'selected' : '' }}>
                                    Pemula
                                </option>
                                <option value="menengah"
                                    {{ old('level') == 'menengah' || @$kursus->level == 'menengah' ? 'selected' : '' }}>
                                    Menengah
                                </option>
                                <option value="ahli"
                                    {{ old('level') == 'ahli' || @$kursus->level == 'ahli' ? 'selected' : '' }}>
                                    Ahli
                                </option>
                            </select>
                            @error('level')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="is_published" class="form-label">
                                Di publish?
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select type="text" class="form-select bg-light border-black" id="is_published"
                                name="is_published" required>
                                <option value="">Pilih ...</option>
                                <option value="1" {{ @$kursus->is_published == '1' ? 'selected' : '' }}>
                                    Iya
                                </option>
                                <option value="0" {{ @$kursus->is_published == '0' ? 'selected' : '' }}>
                                    Tidak
                                </option>

                            </select>
                            @error('is_published')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">
                                Deskripsi Pelatihan
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" name="deskripsi" id="tinymce-editor" contenteditable="true">{!! isset($kursus) ? $kursus->deskripsi : old('deskripsi') !!}</textarea>
                            @error('deskripsi')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="youtube" class="form-label">
                                Link Youtube
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control bg-light border-black" id="youtube"
                                name="youtube" value="{{ isset($kursus) ? $kursus->youtube : old('youtube') }}"
                                required>
                            @error('youtube')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hari" class="form-label">
                                Waktu Yang Diberikan (hari)
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control bg-light border-black" id="hari"
                                name="hari" value="{{ isset($kursus) ? $kursus->hari : old('hari') }}" required>
                            @error('hari')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">
                                Gambar Thumnail
                                @if (isset($kursus))
                                @else
                                    <span class="text-danger"><i>(required)</i></span>
                                @endif
                            </label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input class="form-control bg-light border-black" type="file" id="gambar"
                                        name="gambar" {{ isset($kursus) ? '' : 'required' }}>
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small><span class="text-danger">*</span> Tipe: jpeg, png, dan
                                        jpg</small><br>
                                    @error('gambar')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if (isset($kursus))
                            <div class="row">
                                <div class="col-md-6 col-xl-6 mt-1 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="{{ asset('storage/' . $kursus->gambar) }}" class="img-fluid"
                                                alt="" style="width: 100%; height: 300px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="" align="right">
                            <a href="{{ route('pembelajaran') }}" class="btn btn-light text-black">Kembali</a>
                            <button type="submit" class="btn text-white"
                                style="background-color: #165d7d">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.dashboard>
<x-tinymce-editor></x-tinymce-editor>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#basic-usage').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
</script>

<script>
    var harga = document.getElementById("harga");
    harga.addEventListener("keyup", function(e) {
        harga.value = formatRupiah(this.value, "");
    });
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }
        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? rupiah : "";
    }
</script>

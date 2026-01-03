<x-layouts.home>
    <section class="section mt-60">
        <div class="container">
            <x-flash-message></x-flash-message>
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <form method="post"
                        action="{{ isset($produk) ? route('tokoku.update', $produk->id) : route('tokoku.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($produk))
                            @method('PUT')
                        @endif

                        <div class="card shadow-sm bg-light rounded mb-3">
                            <div class="card-body">

                                <h3 class="text-center">{{ isset($produk) ? 'Edit' : 'Tambah' }} Produk</h3>

                                <div class="mb-3">
                                    <label for="nama_produk" class="form-label">
                                        Nama Produk
                                        <span class="text-danger"><i>(required)</i></span>
                                    </label>
                                    <input type="text" id="nama_produk" name="nama_produk"
                                        class="form-control border border-dark"
                                        value="{{ isset($produk) ? $produk->nama_produk : old('nama_produk') }}"
                                        required>
                                    @error('nama_produk')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kategori_produk_id" class="form-label">
                                        Komuditas
                                        <span class="text-danger"><i>(required)</i></span>
                                    </label>
                                    <select name="kategori_produk_id" id="kategori_produk_id"
                                        class="form-select border border-dark" required>
                                        <option value="">Pilih ...</option>
                                        @foreach ($kategori_produk as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('kategori_produk_id') == $item->id || @$produk->kategori_produk_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_produk_id')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi_singkat" class="form-label">
                                        Overview (deskripsi singkat)
                                        <span class="text-danger"><i>(required)</i></span>
                                    </label>
                                    <textarea type="text" name="deskripsi_singkat" id="deskripsi_singkat" class="form-control border border-dark"
                                        placeholder="" required>{{ isset($produk) ? $produk->deskripsi_singkat : old('deskripsi_singkat') }}</textarea>
                                    @error('deskripsi_singkat')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">
                                        Deskripsi Produk
                                    </label>
                                    <textarea type="text" name="deskripsi" id="tinymce-editor" contenteditable="true"
                                        class="form-control border border-dark">{!! isset($produk) ? $produk->deskripsi : old('deskripsi') !!}</textarea>
                                    @error('deskripsi')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">
                                        Harga
                                        <span class="text-danger"><i>(required)</i></span>
                                    </label>
                                    <input type="text" id="harga" name="harga"
                                        class="form-control border border-dark"
                                        value="{{ isset($produk) ? number_format($produk->harga, 0, ',', '.') : old('harga') }}"
                                        required>
                                    @error('harga')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="stok" class="form-label">
                                        Stok
                                        <span class="text-danger"><i>(required)</i></span>
                                    </label>
                                    <input type="number" id="stok" name="stok"
                                        class="form-control border border-dark"
                                        value="{{ isset($produk) ? $produk->stok : old('stok') }}" required>
                                    @error('stok')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="satuan" class="form-label">
                                        Satuan
                                        <span class="text-danger"><i>(required)</i></span>
                                    </label>
                                    <input type="text" id="satuan" name="satuan"
                                        class="form-control border border-dark" placeholder="contoh: ekor, kg, dll"
                                        value="{{ isset($produk) ? $produk->satuan : old('satuan') }}" required>
                                    @error('satuan')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="gambar" class="form-label">
                                        Gambar
                                        @if (isset($produk))
                                        @else
                                            <span class="text-danger"><i>(required)</i></span>
                                        @endif
                                    </label>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input class="form-control border border-dark" type="file" id="gambar"
                                                name="gambar[]" {{ isset($produk) ? '' : 'required' }} multiple>
                                            <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                            <small><span class="text-danger">*</span> Tipe: jpeg, png, dan
                                                jpg</small><br>
                                            @error('gambar.*')
                                                <span class="text-danger" style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if (isset($produk))
                                        <div class="row">
                                            @foreach ($produk->gambar as $item)
                                                <div class="col-md-6 col-xl-4 mt-1 mb-2">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <img src="{{ asset('storage/produk/' . $item->nama_file) }}"
                                                                class="img-fluid" alt=""
                                                                style="width: 100%; height: 300px;">
                                                            <a href="{{ route('tokoku.destroy_gambar', $item->id) }}"
                                                                class="btn btn-danger"
                                                                onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                                                Hapus
                                                            </a>
                                                        </div>
                                                        <div class="card-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="" align="left">
                                    <a href="{{ route('shop.user', auth()->user()->slug) }}"
                                        class="btn btn-secondary text-white">kembali</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="" align="right">
                                    <button type="submit" name="action" value="bayar" id="submit_btn"
                                        class="btn text-white" style="background-color: #165d7d">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>

<x-tinymce-editor></x-tinymce-editor>

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

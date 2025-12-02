<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($produk) ? 'Edit' : 'Tambah' }} Produk</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($produk) ? route('produk.update', $produk->id) : '#' }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($produk))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">
                                Nama Produk
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control bg-light border-black" id="nama_produk"
                                name="nama_produk"
                                value="{{ isset($produk) ? $produk->nama_produk : old('nama_produk') }}" required>
                            @error('nama_produk')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori_produk_id" class="form-label">
                                Kategori
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select type="text" class="form-select border border-dark" id="kategori_produk_id"
                                name="kategori_produk_id" required>
                                <option value="">Pilih ...</option>
                                @foreach ($kategori_produk as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kategori_produk_id') == $item->id || $produk->kategori_produk_id == $item->id ? 'selected' : '' }}>
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
                            <textarea type="text" class="form-control" id="deskripsi_singkat" name="deskripsi_singkat" style="height: 100px;"
                                required>{{ isset($produk) ? $produk->deskripsi_singkat : old('deskripsi_singkat') }}</textarea>
                            @error('deskripsi_singkat')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">
                                Deskripsi Produk
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" name="deskripsi" id="tinymce-editor" contenteditable="true">{!! isset($produk) ? $produk->deskripsi : old('deskripsi') !!}</textarea>
                            @error('deskripsi')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">
                                Harga
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="harga" name="harga"
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
                            <input type="text" class="form-control" id="stok" name="stok"
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
                            <input type="text" class="form-control" id="satuan" name="satuan"
                                value="{{ isset($produk) ? $produk->satuan : old('satuan') }}" required>
                            @error('satuan')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">
                                Gambar
                            </label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input class="form-control border border-dark" type="file" id="gambar"
                                        name="gambar[]" multiple>
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small><span class="text-danger">*</span> Tipe: jpeg, png, dan
                                        jpg</small><br>
                                    @error('gambar.*')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach ($produk->gambar as $item)
                                <div class="col-md-6 col-xl-4 mt-1 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="{{ asset('storage/produk/' . $item->nama_file) }}"
                                                class="img-fluid" alt="" style="width: 100%; height: 300px;">
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('produk.destroy_gambar', $item->id) }}"
                                                class="btn btn-danger"
                                                onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="" align="right">
                            <a href="{{ route('produk') }}" class="btn btn-light text-black">Kembali</a>
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

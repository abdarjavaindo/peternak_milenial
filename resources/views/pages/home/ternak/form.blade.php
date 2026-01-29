<x-layouts.home>
    <section class="section mt-60">
        <div class="container">
            <x-flash-message></x-flash-message>
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <form method="post"
                        action="{{ isset($ternak) ? route('ternak.update', $ternak->id) : route('ternak.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        @if (isset($ternak))
                            @method('PUT')
                        @endif

                        <div class="card shadow-sm bg-light rounded mb-3">
                            <div class="card-body">

                                <h3 class="text-center">Tambahkan Ternak</h3>

                                <div class="mb-3">
                                    <label for="nama_ternak" class="form-label">
                                        Komoditas Hewan Ternak yang Dimiliki
                                        @if (isset($ternak))
                                            <span class="text-warning"><i>(readonly)</i></span>
                                        @else
                                            <span class="text-danger"><i>(required)</i></span>
                                        @endif
                                    </label>
                                    <select type="text" class="form-select border border-dark" id="nama_ternak"
                                        name="nama_ternak" required {{ isset($ternak) ? 'disabled' : '' }}>
                                        <option value="">Pilih ...</option>
                                        @foreach ($kategori_produk as $item)
                                            <option value="{{ $item->nama_kategori }}"
                                                {{ old('nama_ternak') == $item->nama_kategori || @$ternak->nama_ternak == $item->nama_kategori ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nama_ternak')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">
                                        Jumlah
                                        <span class="text-danger"><i>(required)</i></span>
                                    </label>
                                    <input type="text" id="jumlah" name="jumlah"
                                        class="form-control border border-dark"
                                        value="{{ isset($ternak) ? number_format($ternak->jumlah, 0, ',', '.') : old('jumlah') }}"
                                        required>
                                    @error('jumlah')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="" align="left">
                                    <a href="{{ route('ternak') }}" class="btn btn-secondary text-white">kembali</a>
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
<script>
    var harga = document.getElementById("jumlah");
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

<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($kategori_produk) ? 'Edit' : 'Tambah' }} Kategori Produk</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($kategori_produk) ? route('kategori-produk.update', $kategori_produk->id) : route('kategori-produk.store') }}">
                        @csrf
                        @if (isset($kategori_produk))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">
                                Kategori Produk
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                value="{{ isset($kategori_produk) ? $kategori_produk->nama_kategori : old('nama_kategori') }}"
                                required>
                            @error('nama_kategori')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        @if (isset($kategori_produk))
                            <div class="mb-3">
                                <label for="slug_kategori" class="form-label">
                                    Pemilik Nomor Rekening
                                    <span class="text-danger"><i>(required)</i></span>
                                </label>
                                <input type="text" class="form-control" id="slug_kategori" name="slug_kategori"
                                    value="{{ isset($kategori_produk) ? $kategori_produk->slug_kategori : old('slug_kategori') }}"
                                    required>
                                @error('slug_kategori')
                                    <span class="text-danger" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <div class="" align="right">
                            <a href="{{ route('kategori-produk') }}" class="btn btn-light text-black">Kembali</a>
                            <button type="submit" class="btn text-white" style="background-color: #165d7d">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.dashboard>

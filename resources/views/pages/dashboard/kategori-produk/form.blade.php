<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($kategori_produk) ? 'Edit' : 'Tambah' }} Komoditas</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($kategori_produk) ? route('kategori-produk.update', $kategori_produk->id) : route('kategori-produk.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($kategori_produk))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="hewan_id" class="">
                                Hewan
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select type="text" class="form-select" id="hewan_id" name="hewan_id" required>
                                <option value="">Pilih ...</option>
                                @foreach ($hewan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ @$kategori_produk->hewan_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_hewan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hewan_id')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">
                                Nama Komoditas
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                value="{{ isset($kategori_produk) ? $kategori_produk->nama_kategori : old('nama_kategori') }}"
                                required>
                            @error('nama_kategori')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ikon_komuditas" class="form-label">
                                Ikon
                            </label>
                            <div class="row">
                                @if (@$kategori_produk->ikon_komuditas)
                                    <div class="col-lg-4 mt-1 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="{{ url('storage/' . $kategori_produk->ikon_komuditas) }}">
                                                    <img src="{{ asset('storage/' . $kategori_produk->ikon_komuditas) }}"
                                                        class="img-fluid" alt=""
                                                        style="width: 100%; height: auto;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-8">
                                    <input class="form-control" type="file" id="ikon_komuditas"
                                        name="ikon_komuditas">
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small>
                                        <span class="text-danger">*</span>
                                        Tipe: jpeg, png, dan jpg
                                    </small><br>
                                    @error('ikon_komuditas')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if (isset($kategori_produk))
                            <div class="mb-3">
                                <label for="slug_kategori" class="form-label">
                                    Slug
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

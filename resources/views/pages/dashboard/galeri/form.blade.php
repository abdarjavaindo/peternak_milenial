<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($galeri) ? 'Edit' : 'Tambah' }} Galeri</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($galeri) ? route('galeri.update', $galeri->id) : route('galeri.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($galeri))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="judul" class="form-label">
                                Judul
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                value="{{ isset($galeri) ? $galeri->judul : old('judul') }}" required>
                            @error('judul')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">
                                Gambar
                                @if (isset($galeri))
                                @else
                                    <span class="text-danger"><i>(required)</i></span>
                                @endif
                            </label>
                            <div class="row">
                                @if (@$galeri->gambar)
                                    <div class="col-lg-4 mt-1 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="{{ url('storage/' . $galeri->gambar) }}">
                                                    <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                                        class="img-fluid" alt=""
                                                        style="width: 100%; height: auto;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-8">
                                    <input class="form-control" type="file" id="gambar" name="gambar"
                                        {{ isset($galeri) ? '' : 'required' }}>
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small>
                                        <span class="text-danger">*</span>
                                        Tipe: jpeg, png, dan jpg
                                    </small><br>
                                    @error('gambar')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="" align="right">
                            <a href="{{ route('galeri') }}" class="btn btn-light text-black">Kembali</a>
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

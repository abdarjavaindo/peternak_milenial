<x-layouts.dashboard>
    <h1 class="app-page-title">Edit Pengaturan Website</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST" action="{{ route('pengaturan.update', $pengaturan->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="judul" class="form-label">
                                Judul Website
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                value="{{ isset($pengaturan) ? $pengaturan->judul : old('judul') }}" required>
                            @error('judul')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slogan" class="form-label">
                                Slogan
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="slogan" name="slogan"
                                value="{{ isset($pengaturan) ? $pengaturan->slogan : old('slogan') }}" required>
                            @error('slogan')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">
                                Deskripsi
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" class="form-control" style="height: 100px;" id="deskripsi" name="deskripsi" required>{{ isset($pengaturan) ? $pengaturan->deskripsi : old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="instansi" class="form-label">
                                Nama Instansi
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="instansi" name="instansi"
                                value="{{ isset($pengaturan) ? $pengaturan->instansi : old('instansi') }}" required>
                            @error('instansi')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keyword" class="form-label">
                                Keyword SEO
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="keyword" name="keyword"
                                value="{{ isset($pengaturan) ? $pengaturan->keyword : old('keyword') }}" required>
                            @error('keyword')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">
                                Logo Website
                            </label>
                            <div class="row">
                                <div class="col-lg-4 mt-1 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ url('storage/' . $pengaturan->logo) }}">
                                                <img src="{{ asset('storage/' . $pengaturan->logo) }}"
                                                    class="img-fluid" alt="" style="width: 100%; height: auto;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <input class="form-control bg-light border-black" type="file" id="logo"
                                        name="logo">
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small>
                                        <span class="text-danger">*</span>
                                        Tipe: jpeg, png, dan jpg
                                    </small><br>
                                </div>
                            </div>
                            @error('logo')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ikon" class="form-label">
                                Ikon
                            </label>
                            <div class="row">
                                <div class="col-lg-4 mt-1 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ url('storage/' . $pengaturan->ikon) }}">
                                                <img src="{{ asset('storage/' . $pengaturan->ikon) }}"
                                                    class="img-fluid" alt="" style="width: 100%; height: auto;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <input class="form-control bg-light border-black" type="file" id="ikon"
                                        name="ikon">
                                    <small><span class="text-danger">*</span> Besar Max 1 MB</small><br>
                                    <small>
                                        <span class="text-danger">*</span>
                                        Tipe: jpeg, png, dan jpg
                                    </small><br>
                                </div>
                            </div>
                            @error('ikon')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slider" class="form-label">
                                Slider Home
                            </label>
                            <div class="row">
                                <div class="col-lg-4 mt-1 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ url('storage/' . $pengaturan->slider) }}">
                                                <img src="{{ asset('storage/' . $pengaturan->slider) }}"
                                                    class="img-fluid" alt=""
                                                    style="width: 100%; height: auto;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <input class="form-control bg-light border-black" type="file" id="slider"
                                        name="slider">
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small>
                                        <span class="text-danger">*</span>
                                        Tipe: jpeg, png, dan jpg
                                    </small><br>
                                </div>
                            </div>
                            @error('slider')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="img_fitur" class="form-label">
                                Gambar Sebelah Fitur
                            </label>
                            <div class="row">
                                <div class="col-lg-4 mt-1 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ url('storage/' . $pengaturan->img_fitur) }}">
                                                <img src="{{ asset('storage/' . $pengaturan->img_fitur) }}"
                                                    class="img-fluid" alt=""
                                                    style="width: 100%; height: auto;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <input class="form-control bg-light border-black" type="file" id="img_fitur"
                                        name="img_fitur">
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small>
                                        <span class="text-danger">*</span>
                                        Tipe: jpeg, png, dan jpg
                                    </small><br>
                                </div>
                            </div>
                            @error('img_fitur')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="" align="right">
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

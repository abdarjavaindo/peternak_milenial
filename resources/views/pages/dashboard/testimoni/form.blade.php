<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($testimoni) ? 'Edit' : 'Tambah' }} Testimoni</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($testimoni) ? route('testimoni.update', $testimoni->id) : route('testimoni.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($testimoni))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="nama" class="form-label">
                                Nama
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ isset($testimoni) ? $testimoni->nama : old('nama') }}" required>
                            @error('nama')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">
                                Jabatan
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan"
                                value="{{ isset($testimoni) ? $testimoni->jabatan : old('jabatan') }}" required>
                            @error('jabatan')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="testimoni" class="form-label">
                                Testimoni
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" class="form-control" style="height: 100px;" id="testimoni" name="testimoni" required>{{ isset($testimoni) ? $testimoni->testimoni : old('testimoni') }}</textarea>
                            @error('testimoni')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">
                                Gambar
                                @if (isset($testimoni))
                                @else
                                    <span class="text-danger"><i>(required)</i></span>
                                @endif
                            </label>
                            <div class="row">
                                @if (@$testimoni->gambar)
                                    <div class="col-lg-4 mt-1 mb-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="{{ url('storage/' . $testimoni->gambar) }}">
                                                    <img src="{{ asset('storage/' . $testimoni->gambar) }}"
                                                        class="img-fluid" alt=""
                                                        style="width: 100%; height: auto;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-8">
                                    <input class="form-control" type="file" id="gambar" name="gambar"
                                        {{ isset($testimoni) ? '' : 'required' }}>
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
                            <a href="{{ route('testimoni') }}" class="btn btn-light text-black">Kembali</a>
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

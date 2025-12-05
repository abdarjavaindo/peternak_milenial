<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($pengajar) ? 'Edit' : 'Tambah' }} Pengajar</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($pengajar) ? route('pengajar.update', $pengajar->id) : route('pengajar.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($pengajar))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="nama" class="form-label">
                                Nama
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control bg-light border-black" id="nama"
                                name="nama" value="{{ isset($pengajar) ? $pengajar->nama : old('nama') }}" required>
                            @error('nama')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" class="form-control bg-light border-black" style="height: 100px;" name="title" required>{!! isset($pengajar) ? $pengajar->title : old('title') !!}</textarea>
                            @error('title')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">
                                Gambar
                                @if (isset($pengajar))
                                @else
                                    <span class="text-danger"><i>(required)</i></span>
                                @endif
                            </label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input class="form-control bg-light border-black" type="file" id="gambar"
                                        name="gambar" {{ isset($pengajar) ? '' : 'required' }}>
                                    <small><span class="text-danger">*</span> Besar Max 10 MB</small><br>
                                    <small><span class="text-danger">*</span> Tipe: jpeg, png, dan
                                        jpg</small><br>
                                    @error('gambar')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if (isset($pengajar))
                            <div class="row">
                                <div class="col-md-6 col-xl-6 mt-1 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="{{ asset('storage/' . $pengajar->gambar) }}" class="img-fluid"
                                                alt="" style="width: 100%; height: 300px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="" align="right">
                            <a href="{{ route('pengajar') }}" class="btn btn-light text-black">Kembali</a>
                            <button type="submit" class="btn text-white"
                                style="background-color: #165d7d">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.dashboard>

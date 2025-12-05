<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($bagian) ? 'Edit' : 'Tambah' }} Section</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($bagian) ? route('bagian.update', $bagian->id) : route('bagian.store', $kursus->id) }}">
                        @csrf
                        @if (isset($bagian))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="judul" class="form-label">
                                Judul Section
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                value="{{ isset($bagian) ? $bagian->judul : old('judul') }}" required>
                            @error('judul')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="urutan" class="form-label">
                                Urutan
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="urutan" name="urutan"
                                value="{{ isset($bagian) ? $bagian->urutan : old('urutan') }}" required>
                            @error('urutan')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="" align="right">
                            <a href="{{ isset($bagian) ? route('bagian', $bagian->kursus->id) : route('bagian', $kursus->id) }}"
                                class="btn btn-light text-black">Kembali</a>
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

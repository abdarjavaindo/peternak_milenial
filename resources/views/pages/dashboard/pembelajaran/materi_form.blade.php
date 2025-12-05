<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($materi) ? 'Edit' : 'Tambah' }} Materi</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($materi) ? route('materi.update', $materi->id) : route('materi.store', $bagian->id) }}">
                        @csrf
                        @if (isset($materi))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="judul" class="form-label">
                                Judul Materi
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                value="{{ isset($materi) ? $materi->judul : old('judul') }}" required>
                            @error('judul')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="konten" class="form-label">
                                Materi Konten
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" name="konten" id="tinymce-editor" contenteditable="true">{!! isset($materi) ? $materi->konten : old('konten') !!}</textarea>
                            @error('konten')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis" class="form-label">
                                Type
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select type="text" class="form-select bg-light border-black" id="jenis"
                                name="jenis" required>
                                <option value="">Pilih ...</option>
                                <option value="materi"
                                    {{ old('jenis') == 'materi' || @$materi->jenis == 'materi' ? 'selected' : '' }}>
                                    Materi
                                </option>
                                <option value="postest"
                                    {{ old('jenis') == 'postest' || @$materi->jenis == 'postest' ? 'selected' : '' }}
                                    disabled>
                                    Postest (Comming soon)
                                </option>
                            </select>
                            @error('jenis')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="" align="right">
                            <a href="{{ isset($materi) ? route('materi', $materi->bagian->id) : route('materi', $bagian->id) }}"
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
<x-tinymce-editor></x-tinymce-editor>

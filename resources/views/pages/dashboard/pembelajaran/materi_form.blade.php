<x-layouts.dashboard>
    {{-- <h1 class="app-page-title">{{ isset($materi) ? 'Edit' : 'Tambah' }} Materi</h1> --}}

    @if (request()->segment(2) == 'materi-edit')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('pembelajaran') }}">
                        Pelatihan
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('bagian', $materi->bagian->kursus->id) }}">
                        Section
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('materi', $materi->bagian->id) }}">
                        Materi dan Post-test
                    </a>
                </li>
                <li class="breadcrumb-item active">Edit Pertanyaan</li>
            </ol>
        </nav>

        <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
            <a class="flex-sm-fill text-sm-center nav-link active" href="{{ route('materi.edit', $materi->id) }}">Edit
                Materi</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('pertanyaan', $materi->id) }}">Pertanyaan</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('hasil', $materi->id) }}">Hasil Peserta</a>
        </nav>
    @endif

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
                                    {{ old('jenis') == 'postest' || @$materi->jenis == 'postest' ? 'selected' : '' }}>
                                    Post-test
                                </option>
                            </select>
                            @error('jenis')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="durasi_postest" class="form-label">
                                Durasi (Menit)
                            </label>
                            <small>*isi jika tipe materi adalah post-test</small>
                            <input type="number" class="form-control" id="durasi_postest" name="durasi_postest"
                                value="{{ isset($materi) ? $materi->durasi_postest : old('durasi_postest') }}">
                            @error('durasi_postest')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nilai_lulus_postest" class="form-label">
                                KKM
                            </label>
                            <small>*isi jika tipe materi post-test</small>
                            <input type="number" class="form-control" id="nilai_lulus_postest"
                                name="nilai_lulus_postest"
                                value="{{ isset($materi) ? $materi->nilai_lulus_postest : old('nilai_lulus_postest') }}">
                            @error('nilai_lulus_postest')
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

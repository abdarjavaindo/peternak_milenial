<x-layouts.dashboard>
    {{-- <h1 class="app-page-title">{{ isset($pertanyaan) ? 'Edit' : 'Tambah' }} Pertanyaan</h1> --}}

    @if (request()->segment(2) == 'pertanyaan-edit')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('pembelajaran') }}">Pembelajaran</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('bagian', $pertanyaan->materi->bagian->kursus->id) }}">Section</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('materi', $pertanyaan->materi->bagian->id) }}">
                        Materi dan Postest
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('pertanyaan', $pertanyaan->materi->id) }}">Pertanyaan</a>
                </li>
                <li class="breadcrumb-item active">Edit Pertanyaan</li>
            </ol>
        </nav>

        <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
            <a class="flex-sm-fill text-sm-center nav-link active"
                href="{{ route('pertanyaan.edit', $pertanyaan->id) }}">Edit Pertanyaan</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('jawaban', $pertanyaan->id) }}">
                Pilihan Jawaban
            </a>
        </nav>
    @endif

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($pertanyaan) ? route('pertanyaan.update', $pertanyaan->id) : route('pertanyaan.store', $materi->id) }}">
                        @csrf
                        @if (isset($pertanyaan))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="pertanyaan" class="form-label">
                                Pertanyaan
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" name="pertanyaan" id="tinymce-editor" contenteditable="true">{!! isset($pertanyaan) ? $pertanyaan->pertanyaan : old('pertanyaan') !!}</textarea>
                            @error('pertanyaan')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="" align="right">
                            <a href="{{ isset($pertanyaan) ? route('pertanyaan', $pertanyaan->materi->id) : route('pertanyaan', $materi->id) }}"
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

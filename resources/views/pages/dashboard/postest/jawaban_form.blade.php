<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($pertanyaan) ? 'Edit' : 'Tambah' }} Pertanyaan</h1>

    @if (request()->segment(2) == 'pertanyaan-edit')
        <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
            <a class="flex-sm-fill text-sm-center nav-link active"
                href="{{ route('pertanyaan.edit', $pertanyaan->id) }}">Edit</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="#">Pilihan Jawaban</a>
        </nav>
    @endif

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($jawaban) ? route('jawaban.update', $jawaban->id) : route('jawaban.store', $pertanyaan->id) }}">
                        @csrf
                        @if (isset($jawaban))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="opsi" class="form-label">
                                Jawaban
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" class="form-control" style="height: 100px;" id="opsi" name="opsi" required>{{ isset($jawaban) ? $jawaban->opsi : old('opsi') }}</textarea>
                            @error('opsi')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="is_correct" class="">
                                Ini jawaban benar?
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select type="text" class="form-select" id="is_correct" name="is_correct" required>
                                <option value="">Pilih ...</option>
                                <option value="0"
                                    {{ old('is_correct') == '0' || @$jawaban->is_correct == '0' ? 'selected' : '' }}>
                                    Salah</option>
                                <option value="1"
                                    {{ old('is_correct') == '1' || @$jawaban->is_correct == '1' ? 'selected' : '' }}>
                                    Benar</option>
                            </select>
                            @error('is_correct')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="" align="right">
                            <a href="{{ isset($jawaban) ? route('jawaban', $jawaban->pertanyaan->id) : route('jawaban', $pertanyaan->id) }}"
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

<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($adminbasic) ? 'Edit' : 'Tambah' }} User</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST" action="{{ route('user.levelstore', $user->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="level" class="form-label">
                                Level
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <select class="form-select" name="level" required>
                                <option value="">Pilih ...</option>
                                <option value="pemula" {{ @$user->level == 'pemula' ? 'selected' : '' }}>
                                    Pemula
                                </option>
                                <option value="menengah" {{ @$user->level == 'menengah' ? 'selected' : '' }}>
                                    Menengah
                                </option>
                                <option value="ahli" {{ @$user->level == 'ahli' ? 'selected' : '' }}>
                                    Ahli
                                </option>
                            </select>
                        </div>

                        <div class="" align="right">
                            <a href="{{ route('user') }}" class="btn btn-light text-black">Kembali</a>
                            <button type="submit" class="btn text-white"
                                style="background-color: #165d7d">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.dashboard>

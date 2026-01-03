<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($hewan) ? 'Edit' : 'Tambah' }} Hewan</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($hewan) ? route('hewan.update', $hewan->id) : route('hewan.store') }}"
                        enctype="multipart/form-data">

                        @csrf
                        @if (isset($hewan))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="nama_hewan" class="form-label">
                                Nama Hewan
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control bg-light border-black" id="nama_hewan"
                                name="nama_hewan" value="{{ isset($hewan) ? $hewan->nama_hewan : old('nama_hewan') }}"
                                required>
                            @error('nama_hewan')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="" align="right">
                            <a href="{{ route('hewan') }}" class="btn btn-light text-black">Kembali</a>
                            <button type="submit" class="btn text-white"
                                style="background-color: #165d7d">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.dashboard>

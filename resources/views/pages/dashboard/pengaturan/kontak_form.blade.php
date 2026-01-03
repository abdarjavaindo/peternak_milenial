<x-layouts.dashboard>
    <h1 class="app-page-title">Edit Kontak dan Social Media</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ route('pengaturan.kontak_update', $pengaturan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">
                                Nomor Telpon
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="number" class="form-control" id="no_telp" name="no_telp"
                                value="{{ isset($pengaturan) ? $pengaturan->no_telp : old('no_telp') }}" required>
                            @error('no_telp')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ isset($pengaturan) ? $pengaturan->email : old('email') }}" required>
                            @error('email')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hari_oprasional" class="form-label">
                                Hari Operasional
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="hari_oprasional" name="hari_oprasional"
                                value="{{ isset($pengaturan) ? $pengaturan->hari_oprasional : old('hari_oprasional') }}"
                                required>
                            @error('hari_oprasional')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jam_oprasional" class="form-label">
                                Jam Operasional
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="jam_oprasional" name="jam_oprasional"
                                value="{{ isset($pengaturan) ? $pengaturan->jam_oprasional : old('jam_oprasional') }}"
                                required>
                            @error('jam_oprasional')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">
                                Lokasi
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" class="form-control" style="height: 100px;" id="lokasi" name="lokasi" required>{{ isset($pengaturan) ? $pengaturan->lokasi : old('lokasi') }}</textarea>
                            @error('lokasi')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="link_maps" class="form-label">
                                Link Maps
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="link_maps" name="link_maps"
                                value="{{ isset($pengaturan) ? $pengaturan->link_maps : old('link_maps') }}" required>
                            @error('link_maps')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="iframe_maps" class="form-label">
                                Iframe Maps
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" class="form-control" style="height: 200px;" id="iframe_maps" name="iframe_maps" required>{!! isset($pengaturan) ? $pengaturan->iframe_maps : old('iframe_maps') !!}</textarea>
                            @error('iframe_maps')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="konten" class="form-label">
                                Materi Konten
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <textarea type="text" name="konten" id="tinymce-editor" contenteditable="true">{!! isset($materi) ? $materi->konten : old('konten') !!}</textarea>
                            @error('konten')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="fb" class="form-label">
                                Link Facebook
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="fb" name="fb"
                                value="{{ isset($pengaturan) ? $pengaturan->fb : old('fb') }}" required>
                            @error('fb')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="twitter" class="form-label">
                                Link X (twitter)
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="twitter" name="twitter"
                                value="{{ isset($pengaturan) ? $pengaturan->twitter : old('twitter') }}" required>
                            @error('twitter')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="youtube" class="form-label">
                                Link Youtube
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="youtube" name="youtube"
                                value="{{ isset($pengaturan) ? $pengaturan->youtube : old('youtube') }}" required>
                            @error('youtube')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ig" class="form-label">
                                Link Instagram
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="ig" name="ig"
                                value="{{ isset($pengaturan) ? $pengaturan->ig : old('ig') }}" required>
                            @error('ig')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tiktok" class="form-label">
                                Link Tiktok
                                <span class="text-danger"><i>(required)</i></span>
                            </label>
                            <input type="text" class="form-control" id="tiktok" name="tiktok"
                                value="{{ isset($pengaturan) ? $pengaturan->tiktok : old('tiktok') }}" required>
                            @error('tiktok')
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
{{-- <x-tinymce-editor></x-tinymce-editor> --}}

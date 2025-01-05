<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($vendor) ? 'Edit' : 'Tambah' }} Vendor</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($vendor) ? route('vendor.update', $vendor->id) : route('vendor.store') }}">
                        @csrf
                        @if (isset($vendor))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="email" class="form-label">Email
                                <span class="{{ isset($vendor) ? 'text-warning' : 'text-danger' }}">
                                    <i>{{ isset($vendor) ? '(read only)' : '(required)' }}</i>
                                </span>
                            </label>
                            <input type="email"
                                class="form-control {{ isset($vendor) ? 'bg-light border-black' : '' }}" id="email"
                                name="email" value="{{ isset($vendor) ? $vendor->email : old('email') }}"
                                {{ isset($vendor) ? 'readonly' : 'required' }}>
                            @error('email')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_vendor" class="form-label">Nama Vendor <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="nama_vendor" name="nama_vendor"
                                value="{{ isset($vendor) ? $vendor->nama_vendor : old('nama_vendor') }}" required>
                            @error('nama_vendor')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_direktur" class="form-label">Nama Direktur <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="nama_direktur" name="nama_direktur"
                                value="{{ isset($vendor) ? $vendor->nama_direktur : old('nama_direktur') }}" required>
                            @error('nama_direktur')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="npwp" class="form-label">NPWP <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="npwp" name="npwp"
                                value="{{ isset($vendor) ? $vendor->npwp : old('npwp') }}" required>
                            @error('npwp')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_rek_bank" class="form-label">No Rekening Bank <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="no_rek_bank" name="no_rek_bank"
                                value="{{ isset($vendor) ? $vendor->no_rek_bank : old('no_rek_bank') }}" required>
                            @error('no_rek_bank')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bank" class="form-label">Nama Bank <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="bank" name="bank"
                                value="{{ isset($vendor) ? $vendor->bank : old('bank') }}" required>
                            @error('bank')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pemilik_no_rek" class="form-label">Pemilik Nomor Rekening <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="pemilik_no_rek" name="pemilik_no_rek"
                                value="{{ isset($vendor) ? $vendor->pemilik_no_rek : old('pemilik_no_rek') }}"
                                required>
                            @error('pemilik_no_rek')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telp (WA)<span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="number" class="form-control" id="no_telp" name="no_telp"
                                value="{{ isset($vendor) ? $vendor->no_telp : old('no_telp') }}" required>
                            @error('no_telp')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat<span
                                    class="text-danger"><i>(required)</i></span></label>
                            <textarea type="text" class="form-control" id="alamat" name="alamat" required>{{ isset($vendor) ? $vendor->alamat : old('alamat') }}</textarea>
                            @error('alamat')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="" align="right">
                            <a href="{{ route('vendor') }}" class="btn btn-light text-black">Kembali</a>
                            <button type="submit" class="btn text-white"
                                style="background-color: #165d7d">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.dashboard>

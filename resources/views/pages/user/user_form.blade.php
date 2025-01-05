<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($adminbasic) ? 'Edit' : 'Tambah' }} User</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($adminbasic) ? route('user.update', $adminbasic->id) : route('user.store') }}">
                        @csrf
                        @if (isset($adminbasic))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="email" class="form-label">Email
                                <span class="{{ isset($adminbasic) ? 'text-warning' : 'text-danger' }}">
                                    <i>{{ isset($adminbasic) ? '(read only)' : '(required)' }}</i>
                                </span>
                            </label>
                            <input type="email"
                                class="form-control {{ isset($adminbasic) ? 'bg-light border-black' : '' }}"
                                id="email" name="email"
                                value="{{ isset($adminbasic) ? $adminbasic->email : old('email') }}"
                                {{ isset($adminbasic) ? 'readonly' : 'required' }}>
                            @error('email')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ isset($adminbasic) ? $adminbasic->name : old('name') }}" required>
                            @error('name')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span
                                    class="text-danger"><i>{{ isset($adminbasic) ? '' : '(required)' }}</i></span></label>
                            <input type="password" class="form-control" id="password" name="password"
                                {{ isset($adminbasic) ? '' : 'required' }}>
                            @error('password')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Konfirmasi Password <span
                                    class="text-danger"><i>{{ isset($adminbasic) ? '' : '(required)' }}</i></span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="form-control" {{ isset($adminbasic) ? '' : 'required' }}>
                            @error('password_confirmation')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
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

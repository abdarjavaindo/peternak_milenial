<x-layouts.home>
    <section class="section mt-60">
        <div class="container">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Profile Information</h3>
                    <div class="section-intro">Update your account's profile information and email address.</div>
                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success" role="alert">
                            Profil berhasil di update
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="app-card-body">
                            <form class="settings-form" method="post" action="{{ route('userprofile.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama <span
                                            class="text-danger"><i>(required)</i></span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                    @error('name')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger"><i>(required)</i></span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" required autocomplete="username">
                                    @error('email')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="no_telp" class="form-label">No Telp (WA) <span
                                            class="text-danger"><i>(required)</i></span></label><br>
                                    <small><i>*Pakai 62 awalan nomor telpon, jangan gunakan angka 0</i></small>
                                    <input type="number" class="form-control" id="no_telp" name="no_telp"
                                        value="{{ old('no_telp', $user->no_telp) }}" required autocomplete="no_telp">
                                    @error('no_telp')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="" align="right">
                                    <button type="submit" class="btn btn-success text-white">Save
                                        Changes</button>
                                </div>
                            </form>
                        </div>
                        <!--//app-card-body-->

                    </div>
                    <!--//app-card-->
                </div>
            </div>
            <!--//row-->

            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Update Password</h3>
                    <div class="section-intro">Ensure your account is using a long, random password to stay secure.
                    </div>
                    @if (session('status') === 'password-updated')
                        <div class="alert alert-success" role="alert">
                            Password berhasil di update
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="app-card-body">
                            <form class="settings-form" method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="update_password_current_password" class="form-label">Password Saat
                                        Ini</label>
                                    <input type="password" class="form-control" id="update_password_current_password"
                                        name="current_password" autocomplete="current-password">
                                    @if ($errors->updatePassword->get('current_password'))
                                        <span class="text-danger"
                                            style="color:red">{{ $errors->updatePassword->get('current_password')[0] }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="update_password_password" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" id="update_password_password"
                                        name="password" autocomplete="new-password">
                                    @if ($errors->updatePassword->get('password'))
                                        <span class="text-danger"
                                            style="color:red">{{ $errors->updatePassword->get('password')[0] }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="update_password_password_confirmation" class="form-label">Konfirmasi
                                        Password</label>
                                    <input type="password" class="form-control"
                                        id="update_password_password_confirmation" name="password_confirmation"
                                        autocomplete="current-password">
                                    @if ($errors->updatePassword->get('password_confirmation'))
                                        <span class="text-danger"
                                            style="color:red">{{ $errors->updatePassword->get('password_confirmation')[0] }}</span>
                                    @endif
                                </div>

                                <div class="" align="right">
                                    <button type="submit" class="btn btn-success text-white">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--//app-card-body-->

                    </div>
                    <!--//app-card-->
                </div>
            </div>
            <!--//row-->
        </div>
    </section>
</x-layouts.home>

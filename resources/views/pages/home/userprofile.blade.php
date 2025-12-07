<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
<x-layouts.home>
    <section class="section mt-60">
        <div class="container">

            <div class="row mb-4">
                <div class="col-lg-12">
                    <ul class="nav nav-pills nav-justified flex-column flex-sm-row rounded">
                        <li class="nav-item">
                            <a class="nav-link rounded border border-1 border-dark {{ request()->segment(1) == 'userprofile' ? 'active' : 'bg-white' }}"
                                href="{{ route('userprofile.edit') }}">
                                <div class="text-center py-2">
                                    <h6 class="mb-0">Profil Peternak</h6>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link rounded border border-1 border-dark {{ request()->segment(1) == 'daftar-ternak' ? 'active' : 'bg-white' }}"
                                href="{{ route('ternak') }}">
                                <div class="text-center py-2">
                                    <h6 class="mb-0">Ternak yang Dimiliki</h6>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

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
                                    <label for="level" class="form-label">
                                        Level
                                        <span class="text-warning"><i>(read only)</i></span>
                                    </label>
                                    <input type="text" class="form-control bg-light border-dark"
                                        value="{{ old('name', $user->level) }}" readonly>
                                </div>

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

                                <div class="mb-3">
                                    <label class="sr-only" for="nik">NIK</label>
                                    <input id="nik" name="nik" type="number" class="form-control"
                                        placeholder="NIK" required="required" value="{{ $user->nik }}">
                                    @error('nik')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control"
                                        placeholder="Tanggal Lahir" required="required" value="{{ $user->tgl_lahir }}">
                                    @error('tgl_lahir')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <select class="form-select" id="kabupaten" name="kabupaten" required>
                                        @foreach ($kabupaten as $kab)
                                            <option value="{{ $kab->nama }}"
                                                {{ $user->kabupatan == $kab->nama ? 'selected' : '' }}>
                                                {{ $kab->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kabupaten')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="form-select" id="kecamatan" name="kecamatan" required>
                                        @foreach ($kecamatan as $kec)
                                            <option value="{{ $kec->nama }}"
                                                {{ $user->kecamatan == $kec->nama ? 'selected' : '' }}>
                                                {{ $kec->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kecamatan')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="desa">Kelurahan/Desa</label>
                                    <select class="form-select" id="desa" name="desa" required>
                                        <option value="">Pilih Desa ...</option>
                                        @foreach ($desa as $des)
                                            <option value="{{ $des->nama }}"
                                                {{ $user->desa == $des->nama ? 'selected' : '' }}>
                                                {{ $des->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('desa')
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

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#kabupaten').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
    $('#kecamatan').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
    $('#desa').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
</script>

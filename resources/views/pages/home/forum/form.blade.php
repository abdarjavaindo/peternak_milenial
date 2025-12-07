<x-layouts.home>
    <section class="section mt-60">
        <div class="container">
            <x-flash-message></x-flash-message>
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <form method="post" action="{{ route('forum.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card shadow-sm bg-light rounded mb-3">
                            <div class="card-body">

                                <h3 class="text-center">Buat Thread</h3>

                                <div class="mb-3">
                                    <label for="judul" class="form-label">
                                        Judul
                                        <span class="text-danger"><i>(required)</i></span>
                                    </label>
                                    <input type="text" id="judul" name="judul"
                                        class="form-control border border-dark" value="{{ old('judul') }}" required>
                                    @error('judul')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">
                                        Konten
                                    </label>
                                    <textarea type="text" name="konten" id="tinymce-editor" contenteditable="true"
                                        class="form-control border border-dark">{!! old('konten') !!}</textarea>
                                    @error('konten')
                                        <span class="text-danger" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="" align="left">
                                    <a href="{{ route('forum') }}" class="btn btn-secondary text-white">kembali</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="" align="right">
                                    <button type="submit" name="action" value="bayar" id="submit_btn"
                                        class="btn text-white" style="background-color: #165d7d">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>
<x-tinymce-editor></x-tinymce-editor>

<x-layouts.home>
    <style>
        .nav-pills .nav-link.active {
            color: #05559e !important;
        }
    </style>
    <section class="section mt-60 pb-0">
        <div class="container">
            <x-flash-message></x-flash-message>
            <br>
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="tiny-single-item">
                        @foreach ($produk->gambar as $item)
                            <div class="tiny-slide">
                                <a href="{{ asset('storage/produk/' . $item->nama_file) }}">
                                    <img src="{{ asset('storage/produk/' . $item->nama_file) }}"
                                        class="img-fluid rounded-5" alt="" style="width: 100%; height: 500px;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-7 mt-sm-0 pt-2 pt-sm-0">
                    <div class="section-title ms-md-4">
                        <h4 class="title">
                            {{ $produk->nama_produk }}
                        </h4>
                        <h5 class="text-muted">
                            {{ 'Rp ' . number_format($produk->harga, 0, ',', '.') . " Per $produk->satuan" }} (Stok
                            {{ $produk->stok }})
                        </h5>

                        <h5 class="mt-4">Overview :</h5>
                        <p class="text-muted">{{ $produk->deskripsi_singkat }}</p>

                        @if (!auth()->check() || $produk->user_id != auth()->user()->id)
                        @else
                            <div class="mt-4 pt-2">
                                <a href="{{ route('tokoku.edit', $produk->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="{{ route('tokoku.destroy', $produk->id) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah anda yakin akan ingin menghapus data ini')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                    Hapus
                                </a>
                            </div>
                        @endif

                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <div class="card public-profile border-0 rounded shadow" style="z-index: 1;">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-lg-2 col-md-3 text-md-start text-center">
                                                @if ($produk->user->gambar)
                                                    <img src="{{ asset('storage/' . $produk->user->gambar) }}"
                                                        class="img-fluid avatar avatar-md-sm rounded-circle shadow"
                                                        alt="{{ \Illuminate\Support\Str::title($produk->user->name) }}">
                                                @else
                                                    <img src="{{ asset('assets') }}/mobirise/images/user.png"
                                                        class="img-fluid avatar avatar-md-sm rounded-circle shadow"
                                                        alt="{{ \Illuminate\Support\Str::title($produk->user->name) }}">
                                                @endif
                                            </div>

                                            <div class="col-lg-10 col-md-9">
                                                <div class="row align-items-end">
                                                    <div class="col-md-6 text-md-start text-center mt-4 mt-sm-0">
                                                        <h5 class="mb-0">
                                                            {{ \Illuminate\Support\Str::title($produk->user->name) }}
                                                        </h5>
                                                        <small class="text-muted h6 me-2">
                                                            Peternak {{ ucfirst($produk->user->level) }}
                                                        </small>
                                                    </div>
                                                    <div class="col-md-6 text-md-end text-center d-sm-flex">
                                                        <a href="https://wa.me/{{ $produk->user->no_telp }}"
                                                            class="btn btn-sm btn-primary mt-2">Kontak WA</a>
                                                        <a href="{{ route('shop.user', $produk->user->slug) }}"
                                                            class="btn btn-sm btn-outline-primary mt-2 ms-2">Kunjungi
                                                            Etalase</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!--end container-->

        <div class="container mt-100 mt-60 mb-4">
            <div class="row">
                <div class="card shop-list border-0 position-relative">
                    <div class="card-body content p-2">
                        <div class="col-12">
                            <ul class="nav nav-pills shadow flex-column flex-sm-row d-md-inline-flex mb-0 p-1 rounded position-relative overflow-hidden"
                                id="pills-tab" role="tablist">
                                <li class="nav-item m-1">
                                    <a class="nav-link py-2 px-5 {{ $v == 'deskripsi' || $v == '' ? 'active' : '' }} rounded"
                                        id="description-data"
                                        href="{{ route('shop.detail', ['slug' => $slug, 'v' => 'deskripsi']) }}">
                                        <div class="text-center">
                                            <h6 class="mb-0">Deskripsi</h6>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item m-1">
                                    <a class="nav-link py-2 px-5 {{ $v == 'komentar' ? 'active' : '' }} rounded"
                                        id="review-comments"
                                        href="{{ route('shop.detail', ['slug' => $slug, 'v' => 'komentar']) }}">
                                        <div class="text-center">
                                            <h6 class="mb-0">Komentar</h6>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content mt-5" id="pills-tabContent">
                                <div class="card border-0 tab-pane fade {{ $v == 'deskripsi' || $v == '' ? 'show active' : '' }}"
                                    id="description" role="tabpanel" aria-labelledby="description-data">
                                    <p class="text-muted mb-0">{!! $produk->deskripsi !!}</p>
                                </div>

                                <div class="card border-0 tab-pane fade {{ $v == 'komentar' ? 'show active' : '' }}"
                                    id="review" role="tabpanel" aria-labelledby="review-comments">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            @if (isset($produk->komentar) && $produk->komentar->count() > 0)
                                                @foreach ($produk->komentar as $item)
                                                    <ul class="media-list list-unstyled mb-0">
                                                        <li>
                                                            <div class="d-flex justify-content-between">
                                                                <div class="d-flex align-items-center">
                                                                    @if ($item->user->gambar)
                                                                        <a class="pe-3"
                                                                            href="{{ route('shop.user', $item->user->slug) }}">
                                                                            <img src="{{ asset('storage/' . $item->user->gambar) }}"
                                                                                class="img-fluid avatar avatar-md-sm rounded-circle shadow"
                                                                                alt="img">
                                                                        </a>
                                                                    @else
                                                                        <a class="pe-3"
                                                                            href="{{ route('shop.user', $item->user->slug) }}">
                                                                            <img src="{{ asset('assets') }}/mobirise/images/user.png"
                                                                                class="img-fluid avatar avatar-md-sm rounded-circle shadow"
                                                                                alt="img">
                                                                        </a>
                                                                    @endif
                                                                    <div class="flex-1 commentor-detail">
                                                                        <h6 class="mb-0">
                                                                            <a href="{{ route('shop.user', $item->user->slug) }}"
                                                                                class="text-dark media-heading">
                                                                                {{ $item->user->name }}
                                                                            </a>
                                                                        </h6>
                                                                        <small class="text-muted">
                                                                            {{ $item->created_at }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                                @if (auth()->user())
                                                                    @if ($item->user_id == auth()->user()->id)
                                                                        <a href="{{ route('shop.komentar.destroy', $item->id) }}"
                                                                            class="btn btn-sm btn-danger ms-3"
                                                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini')">
                                                                            Hapus
                                                                        </a>
                                                                    @elseif(auth()->user()->hasRole('admin'))
                                                                        <a href="{{ route('shop.komentar.destroy', $item->id) }}"
                                                                            class="btn btn-sm btn-danger ms-3"
                                                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini')">
                                                                            Hapus
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            </div>

                                                            <div class="mt-3">
                                                                <p class="text-muted fst-italic p-3 bg-light rounded">
                                                                    {{ $item->komentar }}
                                                                </p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            @else
                                                <div class="alert alert-secondary text-center" role="alert">
                                                    Belum ada komentar
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-6 mt-4 mt-lg-0 pt-2 pt-lg-0">
                                            @if (auth()->user())
                                                @if ($jumlahternak < 1)
                                                    <div class="alert alert-warning" role="alert">
                                                        Anda harus melengkapi daftar ternak yang anda miliki terlebih
                                                        dahulu sebelum menulis
                                                        komentar <a href="{{ route('ternak') }}"
                                                            class="text-dark"><u>(Menuju Daftar
                                                                Ternak)</u></a>
                                                    </div>
                                                @else
                                                    <div
                                                        class="card border-0 sidebar sticky-bar rounded shadow bg-light p-2">
                                                        <form class="ms-lg-4" method="POST"
                                                            action="{{ route('shop.komentar.store', $produk->id) }}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h5>Tambahkan Komentar</h5>
                                                                </div>
                                                                <div class="col-md-12 mt-3">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">
                                                                            Komentar:
                                                                            <span
                                                                                class="text-danger"><i>(required)</i></span>
                                                                        </label>
                                                                        <div class="form-icon position-relative">
                                                                            <i data-feather="message-circle"
                                                                                class="fea icon-sm icons"></i>
                                                                            <textarea id="komentar" placeholder="Komentar Anda" rows="5" name="komentar" class="form-control ps-5"
                                                                                required=""></textarea>
                                                                            @error('komentar')
                                                                                <span class="text-danger"
                                                                                    style="color:red">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">
                                                                            Nama:
                                                                            <span
                                                                                class="text-warning"><i>(readonly)</i></span>
                                                                        </label>
                                                                        <div class="form-icon position-relative">
                                                                            <i data-feather="user"
                                                                                class="fea icon-sm icons"></i>
                                                                            <input id="name" name="name"
                                                                                type="text"
                                                                                class="form-control ps-5" readonly
                                                                                value="{{ auth()->user()->name }}">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="send d-grid">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-layouts.home>

<x-layouts.home>
    <!-- Start Products -->
    <section class="section mt-60">
        <div class="container">
            <x-flash-message></x-flash-message>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="card border-0 sidebar sticky-bar" style="background: #edefea;">
                        <div class="card-body p-0">
                            @if (auth()->user())
                                <h1 class="txtheader text-dark">
                                    {{ Str::upper(auth()->user()->name) }}
                                </h1>
                                @if ($slug_user == auth()->user()->slug)
                                    <div class="widget">
                                        <div class="d-grid gap-2">
                                            <a class="btn btn-outline-dark" href="{{ route('tokoku.create') }}">
                                                + Tambah Produk
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <!-- Categories -->
                            <div class="widget pt-2">
                                <h5 class="widget-title">Komoditas</h5>
                                <ul class="list-unstyled mt-4 mb-0 blog-categories">
                                    @foreach ($kategori_produk as $item)
                                        <li>
                                            <div class="card shop-list border-0 position-relative">
                                                <div class="card-body content p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-12 col-lg-2 text-center mb-2 mb-lg-0">
                                                            @if ($item->ikon_komuditas)
                                                                <img src="{{ asset('storage/' . $item->ikon_komuditas) }}"
                                                                    height="30px" alt="{{ $item->nama_kategori }}">
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-ban"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                                                                </svg>
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-lg-10 text-center text-lg-start">
                                                            <a href="{{ route('shop.user', $slug_user) }}?slug={{ $item->slug_kategori }}"
                                                                class="{{ isset($current_kategori) && $current_kategori->id == $item->id ? 'text-primary fw-bold' : '' }}">
                                                                {{ $item->nama_kategori }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li>
                                        <div class="card shop-list border-0 position-relative">
                                            <div class="card-body content p-2">
                                                <a href="{{ route('shop.user', $slug_user) }}" class="text-danger">
                                                    <i>Hapus filter</i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-8 col-12 pt-2 mt-sm-0 pt-sm-0">
                    <!-- SEARCH -->
                    <div class="widget">
                        <form role="search" method="get">
                            <div class="input-group mb-3 border rounded">
                                <input type="text" id="s" name="s" class="form-control border-0"
                                    placeholder="Cari ..." value="{{ request('s') }}">
                                <button type="submit" class="input-group-text bg-white border-0 bg-success"
                                    id="searchsubmit">
                                    <i class="uil uil-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- SEARCH -->

                    <div class="row">
                        @foreach ($produks as $item)
                            <div class="col-lg-4 col-md-6 col-6 pt-2">
                                <div class="card shop-list border-0 position-relative">
                                    <ul class="label list-unstyled mb-0">
                                        <li>
                                            <span class="badge badge-link rounded-pill bg-success">
                                                {{ $item->nama_kategori }}
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="shop-image position-relative overflow-hidden rounded shadow">
                                        <a href="{{ route('shop.detail', ['slug' => $item->slug]) }}">
                                            <img src="{{ asset('storage/produk/' . $item->thumbnail) }}"
                                                class="img-fluid" alt="" style="width: 100%; height: 300px;">
                                        </a>
                                    </div>
                                    <div class="card-body content pt-4 p-2">
                                        <a href="{{ route('shop.detail', ['slug' => $item->slug]) }}"
                                            class="text-dark product-name h6">
                                            <b>
                                                {{ $item->nama_produk }}
                                            </b>
                                        </a>
                                        <div class="d-flex justify-content-between mt-1">
                                            <h6 class="text-dark small fst-italic mb-0 mt-1">
                                                {{ 'Rp ' . number_format($item->harga, 0, ',', '.') . " Per $item->satuan" }}
                                            </h6>
                                        </div>
                                        @if (auth()->check())
                                            @if ($item->aktif)
                                                <small class="fw-light text-success mt-1 mb-0">Published</small>
                                            @else
                                                <small class="fw-light text-danger mt-1 mb-0">Suspend</small>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- PAGINATION START -->
                        <div class="col-12 mt-4 pt-2">
                            {{ $produks->onEachSide(1)->links('components.custom-pagination') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>

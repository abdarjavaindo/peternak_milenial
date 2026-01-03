<x-layouts.home>
    <style>
        .category-arrow {
            transition: transform 0.3s ease;
        }

        .category-arrow.rotate {
            transform: rotate(180deg);
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
    <!-- Start Products -->
    <section class="section mt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="card border-0 sidebar sticky-bar" style="background: #edefea;">
                        <div class="card-body p-0">
                            @if (auth()->user())
                                <div class="widget">
                                    <div class="d-grid gap-2">
                                        <a class="btn btn-dark"
                                            href="{{ route('shop.user', auth()->user()->slug) }}">Lihat Etalaseku</a>
                                    </div>
                                </div>
                            @endif

                            <!-- Categories -->
                            <div class="widget pt-2">
                                <h5 class="widget-title d-flex justify-content-between align-items-center cursor-pointer"
                                    onclick="toggleKategori(this)">
                                    Komuditas
                                    <i
                                        class="uil uil-angle-down category-arrow {{ isset($current_kategori) ? 'rotate' : '' }}"></i>
                                </h5>
                                <ul
                                    class="list-unstyled mt-4 mb-0 blog-categories {{ isset($current_kategori) ? '' : 'd-none' }}">
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
                                                            <a href="{{ route('shop') }}?slug={{ $item->slug_kategori }}"
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
                                                <a href="{{ route('shop') }}" class="text-danger">
                                                    <i>Hapus filter</i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Categories -->
                        </div>
                    </div>
                </div><!--end col-->

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
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-7">
                            {{-- <div class="section-title">
                                <h5 class="mb-0">Showing 1–15 of 47 results</h5>
                            </div> --}}
                        </div>

                        <div class="col-lg-4 col-md-5 mt-sm-0 pt-2 pt-sm-0">
                            <div class="d-flex justify-content-md-between align-items-center">
                                <div class="form custom-form">
                                    <div class="mb-0">
                                        <select class="form-select form-control" id="Sortbylist-job">
                                            <option value="">Uratkan berdasarkan ...</option>
                                            <option value="terbaru"
                                                {{ request('sort') == 'terbaru' ? 'selected' : '' }}>
                                                Terbaru
                                            </option>
                                            {{-- <option>Sort by popularity</option> --}}
                                            {{-- <option>Sort by rating</option> --}}
                                            <option value="harga_desc"
                                                {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>
                                                Harga Tertinggi ke Rendah
                                            </option>
                                            <option value="harga_asc"
                                                {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>
                                                Harga Terendah ke Tinggi
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="mx-2">
                                    <a href="shop-grids.html" class="h5 text-muted"><i class="uil uil-apps"></i></a>
                                </div> --}}
                                {{-- <div>
                                    <a href="shop-lists.html" class="h5 text-muted"><i class="uil uil-list-ul"></i></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($produks as $item)
                            <div class="col-lg-3 col-md-3 col-6 pt-2">
                                <div class="card shop-list border-0 position-relative">
                                    <div class="shop-image position-relative overflow-hidden rounded shadow">
                                        <a href="{{ route('shop.detail', ['slug' => $item->slug]) }}">
                                            <img src="{{ asset('storage/produk/' . $item->thumbnail) }}"
                                                class="img-fluid" alt="" style="width: 100%; height: 200px;">
                                        </a>
                                    </div>
                                    <div class="card-body content pt-4 p-2">
                                        <a href="{{ route('shop.detail', ['slug' => $item->slug]) }}"
                                            class="text-dark product-name h6">
                                            <b>
                                                {{ \Illuminate\Support\Str::limit($item->nama_produk, 22, '…') }}
                                            </b>
                                        </a>
                                        <div class="d-flex justify-content-between mt-1">
                                            <h6 class="text-dark small fst-italic mb-0 mt-1">
                                                {{ 'Rp ' . number_format($item->harga, 0, ',', '.') . " Per $item->satuan" }}
                                            </h6>
                                        </div>
                                        <small class="fw-light mt-1 mb-0">Dijual oleh: {{ $item->name }}</small>
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
<script>
    document.getElementById('Sortbylist-job').addEventListener('change', function() {
        let value = this.value;
        // Ambil parameter lain (slug, search) supaya tidak hilang
        let params = new URLSearchParams(window.location.search);
        if (value) {
            params.set('sort', value);
        } else {
            params.delete('sort');
        }
        window.location.search = params.toString();
    });
</script>
<script>
    function toggleKategori(el) {
        const list = el.nextElementSibling;
        const arrow = el.querySelector('.category-arrow');

        list.classList.toggle('d-none');
        arrow.classList.toggle('rotate');
    }
</script>

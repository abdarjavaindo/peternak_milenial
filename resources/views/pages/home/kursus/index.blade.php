<x-layouts.home>
    <section class="section">
        <div class="container mt-60">
            <!-- SEARCH -->
            {{-- <div class="widget mt-4">
                <form role="search" method="get">
                    <div class="input-group mb-3 border rounded">
                        <input type="text" id="s" name="s" class="form-control border-0"
                            placeholder="Cari ..." value="{{ request('s') }}">
                        <button type="submit" class="input-group-text bg-white border-0 bg-success" id="searchsubmit">
                            <i class="uil uil-search"></i>
                        </button>
                    </div>
                </form>
            </div> --}}
            <!-- SEARCH -->

            {{-- <div class="row align-items-center">
                <div class="col-lg-8 col-md-7">
                </div>

                <div class="col-lg-4 col-md-5 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="d-flex justify-content-md-between align-items-center">
                        <div class="form custom-form m-1">
                            <div class="mb-0">
                                <select class="form-select form-control" id="Sortbylist-job">
                                    <option value="">Pilih Level ...</option>
                                    <option value="pemula" {{ request('sort') == 'pemula' ? 'selected' : '' }}>
                                        Pemula
                                    </option>
                                    <option value="menengah" {{ request('sort') == 'menengah' ? 'selected' : '' }}>
                                        Menengah
                                    </option>
                                    <option value="ahli" {{ request('sort') == 'ahli' ? 'selected' : '' }}>
                                        Ahli
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form custom-form m-1">
                            <div class="mb-0">
                                <select class="form-select form-control" id="Sortbylist-job">
                                    <option value="">Pilih Kategori ...</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->slug }}"
                                            {{ request('sort') == 'terbaru' ? 'selected' : '' }}>
                                            {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                @foreach ($pelatihan as $fas)
                    <div class="col-lg-4 col-md-6 col-12 p-1">
                        <a href="{{ route('pelatihan.detail', $fas->slug) }}">
                            <div class="card shop-list border-0 shadow position-relative overflow-hidden">

                                {{-- COVER GAMBAR --}}
                                <div class="shop-image position-relative overflow-hidden shadow" style="height:200px;">

                                    {{-- GAMBAR UTAMA --}}
                                    <img src="{{ asset('storage/' . $fas->gambar) }}" class="img-fluid w-100 h-100"
                                        style="object-fit:cover;" alt="cover">

                                    {{-- GAMBAR OVERLAY LULUS --}}
                                    @if (auth()->check() && optional($fas->user_status)->status === 'selesai')
                                        <img src="{{ asset('assets') }}/mobirise/images/lulus.png"
                                            class="position-absolute"
                                            style="
                                top: 10px;
                                right: 10px;
                                width: 80px;
                                opacity: 1;
                             "
                                            alt="Lulus">
                                    @endif
                                </div>

                                <div class="card-body content p-4">
                                    <a href="{{ route('pelatihan.detail', $fas->slug) }}"
                                        class="text-dark product-name h6">
                                        {{ $fas->judul }}
                                    </a><br>

                                    {{-- LEVEL --}}
                                    @php
                                        $color =
                                            [
                                                'pemula' => 'text-success',
                                                'menengah' => 'text-warning',
                                            ][$fas->level] ?? 'text-danger';
                                    @endphp
                                    <small class="text-muted d-block">
                                        <i class="{{ $color }}">{{ ucfirst($fas->level) }}</i>
                                    </small>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</x-layouts.home>

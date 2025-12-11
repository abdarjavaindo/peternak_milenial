<x-layouts.dashboard>
    <h1 class="app-page-title">Selamat Datang</h1>

    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Semua User</h4>
                    <h6 class="mt-4">{{ $semua_user }} Orang</h6>
                </div>
                <a class="app-card-link-mask" href="{{ route('user') }}"></a>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Peternak Pemula</h4>
                    <h6 class="mt-4">{{ $pemula }} Orang</h6>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Peternak Mengengah</h4>
                    <h6 class="mt-4">{{ $menengah }} Orang</h6>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Peternak Ahli</h4>
                    <h6 class="mt-4">{{ $ahli }} Orang</h6>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Jumlah Produk</h4>
                    <h6 class="mt-4">{{ $produk }} Produk</h6>
                </div>
                <a class="app-card-link-mask" href="{{ route('produk') }}"></a>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Jumlah Materi</h4>
                    <h6 class="mt-4">{{ $kursus }} Materi</h6>
                </div>
                <a class="app-card-link-mask" href="{{ route('pembelajaran') }}"></a>
            </div>
        </div>

    </div>
</x-layouts.dashboard>

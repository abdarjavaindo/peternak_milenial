<x-layouts.home>
    <section class="section mt-60">

        <div class="container-fluid">
            <div id="grid" class="row mt-4">
                @if ($galeri->isEmpty())
                    <div class="container">
                        <div class="alert alert-danger" role="alert">
                            <i>
                                Tidak ada data
                            </i>
                        </div>
                    </div>
                @else
                    @foreach ($galeri as $item)
                        <div class="col-lg-3 col-md-6 col-12 spacing picture-item d-flex">
                            <div
                                class="card border-0 work-container work-primary work-grid position-relative overflow-hidden rounded h-100 d-flex flex-column">
                                <div class="card-body p-0 d-flex flex-column">
                                    <a href="{{ asset('storage/' . $item->gambar) }}" class="lightbox d-inline-block"
                                        title="{{ $item->judul }}">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid w-100"
                                            style="object-fit: cover; aspect-ratio: 4 / 3;">
                                    </a>

                                    <div class="content p-3 mt-auto">
                                        <h5 class="mb-0">
                                            <span class="text-dark title">
                                                {{ $item->judul }}
                                            </span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
</x-layouts.home>

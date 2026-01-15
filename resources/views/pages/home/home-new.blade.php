<x-layouts.home>
    <section class="home-slider position-relative">
        <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active" data-bs-interval="3000">
                    <div class="bg-home d-flex align-items-center"
                        style="background-image:url('{{ asset('storage/' . $set_slider) }}')">
                        <div class="bg-overlay" style="background-color: rgba(0, 0, 0, 0.4);"></div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <div class="title-heading text-white mt-4">
                                        <h1 class="display-4 text-white fw-bold mb-3">
                                            {{ $set_judul }}
                                        </h1>
                                        <p class="para-desc text-white-50 mx-auto">
                                            {{ $set_slogan }}
                                        </p>
                                        <div class="mt-4">
                                            <a href="{{ route('login') }}" class="btn btn-primary mt-2">
                                                Ayo Rek ... Gabung!
                                            </a>
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

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="features-absolute">
                        <div class="row">
                            <div class="col-md-4">
                                <div
                                    class="card border-0 text-center features feature-primary feature-clean course-feature p-4 overflow-hidden shadow">
                                    <div class="icons text-center mx-auto">
                                        <i class="uil uil-user-check d-block rounded h3 mb-0"></i>
                                    </div>
                                    <div class="card-body p-0 mt-4">
                                        <a href="javascript:void(0)" class="title h5 text-dark">
                                            {{ number_format($set_inaugurasi, 0, ',', '.') }}
                                        </a>
                                        <p class="text-muted mt-2">
                                            Inaugurasi Peternak
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0">
                                <div
                                    class="card border-0 text-center features feature-primary feature-clean course-feature p-4 overflow-hidden shadow">
                                    <div class="icons text-center mx-auto">
                                        <i class="uil uil-users-alt d-block rounded h3 mb-0"></i>
                                    </div>
                                    <div class="card-body p-0 mt-4">
                                        <a href="javascript:void(0)" class="title h5 text-dark">
                                            {{ number_format($set_aktif, 0, ',', '.') }}
                                        </a>
                                        <p class="text-muted mt-2">
                                            Peternak Aktif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mt-4 pt-2 mt-sm-0 pt-sm-0">
                                <div
                                    class="card border-0 text-center features feature-primary feature-clean course-feature p-4 overflow-hidden shadow">
                                    <div class="icons text-center mx-auto">
                                        <i class="uil uil-chart-line d-block rounded h3 mb-0"></i>
                                    </div>
                                    <div class="card-body p-0 mt-4">
                                        <a href="javascript:void(0)" class="title h5 text-dark">
                                            {{ $set_komuditas }}
                                        </a>
                                        <p class="text-muted mt-2">
                                            Komuditas Peternak
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section mt-0 pt-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <div class="section-title pb-2">
                                <h4 class="title mb-4">{{ $fitur }} Fitur Utama <span
                                        class="text-primary">{{ $set_judul }}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">

                        @if ($data_fitur->isEmpty())
                            <div class="alert alert-danger" role="alert">
                                <i>
                                    Tidak ada data
                                </i>
                            </div>
                        @else
                            @foreach ($data_fitur as $item)
                                <div class="accordion-item rounded shadow my-2">
                                    <h2 class="accordion-header" id="heading{{ $item->id }}">
                                        <button class="accordion-button border-0 bg-light" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}"
                                            aria-expanded="true" aria-controls="collapse{{ $item->id }}">
                                            {{ $item->judul }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $item->id }}"
                                        class="accordion-collapse border-0 collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $item->id }}"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body text-muted">
                                            {{ $item->deskripsi }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

                <div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <img src="{{ asset('storage/' . $set_img_fitur) }}" class="img-fluid" alt=""
                        style="max-width: 100%; height: auto; object-fit: contain;">
                </div>
            </div>
        </div>
    </section>

    <section class="section mt-0 pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title pb-2">
                        <h4 class="title">Testimoni Peternak</h4>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row justify-content-center">
                <div class="col-lg-12 mt-4">
                    @if ($data_testimoni->isEmpty())
                        <div class="alert alert-danger" role="alert">
                            <i>
                                Tidak ada data
                            </i>
                        </div>
                    @else
                        <div class="tiny-three-item">

                            @foreach ($data_testimoni as $item)
                                <div class="tiny-slide">
                                    <div class="d-flex client-testi m-2">
                                        @if ($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                                class="avatar avatar-small client-image rounded shadow">
                                        @else
                                            <img src="{{ asset('assets') }}/mobirise/images/user.png"
                                                class="avatar avatar-small client-image rounded shadow">
                                        @endif
                                        <div
                                            class="card content p-3 shadow rounded position-relative h-100 d-flex flex-column">
                                            <h6 class="text-primary">
                                                - {{ $item->nama }}
                                                <small class="text-muted">{{ $item->jabatan }}</small>
                                            </h6>

                                            <p class="text-muted mt-2 mt-auto">
                                                <span class="short-text">
                                                    "{{ \Illuminate\Support\Str::limit($item->testimoni, 40) }}"
                                                </span>

                                                <span class="full-text d-none">
                                                    "{{ $item->testimoni }}"
                                                </span>

                                                @if (strlen($item->testimoni) > 40)
                                                    <a href="javascript:void(0)" data-expanded="false"
                                                        onclick="toggleTestimoni(this)">
                                                        Selengkapnya
                                                    </a>
                                                @endif
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="section m-0 p-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h4 class="title">Peta Komuditas di Jawa Timur</h4>
                        <small class="text-muted">Klik wilayah untuk melihat detail</small>
                    </div>
                </div>
            </div>
            <div class="m-0">
                <x-peta-new class="m-0"></x-peta-new>
            </div>
        </div>
    </section>
</x-layouts.home>

<script>
    function toggleTestimoni(el) {
        const parent = el.closest('p');
        const shortText = parent.querySelector('.short-text');
        const fullText = parent.querySelector('.full-text');
        const expanded = el.dataset.expanded === 'true';
        shortText.classList.toggle('d-none', !expanded);
        fullText.classList.toggle('d-none', expanded);
        el.textContent = expanded ? 'Selengkapnya' : 'Lebih sedikit';
        el.dataset.expanded = (!expanded).toString();
    }
</script>

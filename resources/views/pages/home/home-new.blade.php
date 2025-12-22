<x-layouts.home>
    <section class="home-slider position-relative">
        <div id="carouselExampleInterval" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active" data-bs-interval="3000">
                    <div class="bg-home d-flex align-items-center"
                        style="background-image:url('{{ asset('assets') }}/landrick/images/course/bg06.jpg')">
                        <div class="bg-overlay" style="background-color: rgba(0, 0, 0, 0.4);"></div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <div class="title-heading text-white mt-4">
                                        <h1 class="display-4 text-white fw-bold mb-3">
                                            Peternak Milenial & Gen Z
                                        </h1>
                                        <p class="para-desc text-white-50 mx-auto">
                                            Sinergi Membangun Negeri, "Nawabaktisatya", "Jer basuki mawa beya"
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
                                            13.000
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
                                            10.377
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
                                            8
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
                                <h4 class="title mb-4">3 Fitur Utama <span class="text-primary">Peternak Milenial</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item rounded shadow">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button border-0 bg-light" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Marketplace
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse border-0 collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body text-muted">
                                    Tempat jual beli kebutuhan peternak terpercaya
                                    Mudah, aman, dan terjangkau untuk semua peternak
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item rounded shadow mt-2">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button border-0 bg-light collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Pelatihan
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse border-0 collapse"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body text-muted">
                                    Tingkatkan skill beternak bersama ahli berpengalaman
                                    Belajar praktis, modern, dan sesuai kebutuhan peternak
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item rounded shadow mt-2">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button border-0 bg-light collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Forum Peternak
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse border-0 collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body text-muted">
                                    Ruang diskusi, berbagi pengalaman sesama peternak
                                    Solusi masalah ternak dari peternak untuk peternak
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <img src="{{ asset('assets') }}/landrick/images/illustrator/fitur-2.png" class="img-fluid"
                        alt="" style="max-width: 100%; height: auto; object-fit: contain;">
                </div>
            </div>
        </div>
    </section>

    <section class="section mt-0 pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title pb-2">
                        <h4 class="title">Tertimoni Peternak</h4>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row justify-content-center">
                <div class="col-lg-12 mt-4">
                    <div class="tiny-three-item">
                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/mobirise/images/user.png"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <p class="text-muted mt-2">" It seems that only fragments of the original text
                                        remain
                                        in the Lorem Ipsum texts used today. "</p>
                                    <h6 class="text-primary">- Thomas Doll <small class="text-muted">C.E.O</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/mobirise/images/user.png"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <p class="text-muted mt-2">" One disadvantage of Lorum Ipsum is that in Latin
                                        certain
                                        letters appear more frequently than others. "</p>
                                    <h6 class="text-primary">- Barbara McIntosh <small class="text-muted">M.D</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/mobirise/images/user.png"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <p class="text-muted mt-2">" The most well-known dummy text is the 'Lorem Ipsum',
                                        which
                                        is said to have originated in the 16th century. "</p>
                                    <h6 class="text-primary">- Carl Oliver <small class="text-muted">P.A</small></h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/mobirise/images/user.png"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <p class="text-muted mt-2">" According to most sources, Lorum Ipsum can be traced
                                        back
                                        to a text composed by Cicero. "</p>
                                    <h6 class="text-primary">- Christa Smith <small class="text-muted">Manager</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src="assets/mobirise/images/user.png"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <p class="text-muted mt-2">" There is now an abundance of readable dummy texts.
                                        These
                                        are usually used when a text is required. "</p>
                                    <h6 class="text-primary">- Dean Tolle <small class="text-muted">Developer</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-2">
                                <img src=assets/mobirise/images/user.png"
                                    class="avatar avatar-small client-image rounded shadow" alt="">
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <p class="text-muted mt-2">" Thus, Lorem Ipsum has only limited suitability as a
                                        visual
                                        filler for German texts. "</p>
                                    <h6 class="text-primary">- Jill Webb <small class="text-muted">Designer</small>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    </div>
                </div>
            </div>
            <div class="m-0">
                <x-peta-new class="m-0"></x-peta-new>
            </div>
        </div>
    </section>
</x-layouts.home>

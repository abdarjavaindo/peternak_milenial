<x-layouts.home>
    <!-- Start Contact -->
    <section class="section pb-0 bg-white">
        <div class="container mt-5">
            <div class="row mt-5 justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="pages-heading">
                        <h4 class="title mb-5">Hubungi Kami</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card border-0 text-center features feature-primary p-4 feature-clean">
                        <div class="icons text-center mx-auto">
                            <i class="uil uil-phone d-block rounded h3 mb-0"></i>
                        </div>
                        <div class="content mt-4">
                            <h5 class="fw-bold">Kontak</h5>
                            <a href="tel:{{ @$set_no_telp }}" class="read-more">{{ $set_no_telp }}</a><br>
                            <a href="mailto:{{ @$set_email }}" class="read-more">{{ $set_email }}</a>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="card border-0 text-center features feature-primary p-4 feature-clean">
                        <div class="icons text-center mx-auto">
                            <i class="uil uil-clock d-block rounded h3 mb-0"></i>
                        </div>
                        <div class="content mt-4">
                            <h5 class="fw-bold">Operasional</h5>
                            <a href="#" class="read-more">{{ $set_hari_oprasional }}</a><br>
                            <a href="#" class="read-more">{{ $set_jam_oprasional }}</a>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="card border-0 text-center features feature-primary p-4 feature-clean">
                        <div class="icons text-center mx-auto">
                            <i class="uil uil-map-marker d-block rounded h3 mb-0"></i>
                        </div>
                        <div class="content mt-4">
                            <h5 class="fw-bold">Lokasi</h5>
                            <a href="{{ @$set_link_maps }}" target="_blank" class="">
                                {{ $set_lokasi }}
                            </a>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <div class="container-fluid mt-100 mt-60">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="card map border-0">
                        <div class="card-body p-0">
                            {!! $set_iframe_maps !!}
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- End contact -->
</x-layouts.home>

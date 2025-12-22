<x-layouts.home>
    <!-- Start Contact -->
    <section class="section pb-0 bg-white">
        <div class="container mt-5">
            <div class="row mt-5 justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="pages-heading">
                        <h4 class="title mb-5">Contact Us</h4>
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
                            <h5 class="fw-bold">Nomor Telpon / WA</h5>
                            <a href="https://wa.me/{{ @$settings['wa'] }}" class="read-more">{{ '(031) 8292545' }}</a>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="card border-0 text-center features feature-primary p-4 feature-clean">
                        <div class="icons text-center mx-auto">
                            <i class="uil uil-envelope d-block rounded h3 mb-0"></i>
                        </div>
                        <div class="content mt-4">
                            <h5 class="fw-bold">Email</h5>
                            <a href="mailto:{{ @$settings['email'] }}"
                                class="read-more">{{ 'disnak@jatimprov.go.id' }}</a>
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
                            <a href="{{ @$settings['maps'] }}" target="_blank" class="">Jl. Ahmad Yani No.202,
                                Surabaya, Jawa Timur 60235</a>
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
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1867983740462!2d112.7297632!3d-7.3329070000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb63a8b86057%3A0x393ac895d4783754!2sDinas%20Peternakan%20Provinsi%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1766029240208!5m2!1sid!2sid"
                                style="border:0" allowfullscreen></iframe>
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

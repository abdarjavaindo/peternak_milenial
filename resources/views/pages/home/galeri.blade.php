<x-layouts.home>
    <section class="section">
        {{-- <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 filters-group-wrap">
                    <div class="filters-group">
                        <ul class="container-filter list-inline mb-0 filter-options text-center">
                            <li class="list-inline-item categories-name border text-dark rounded active" data-group="all">
                                All</li>
                            <li class="list-inline-item categories-name border text-dark rounded" data-group="branding">
                                Branding</li>
                            <li class="list-inline-item categories-name border text-dark rounded"
                                data-group="designing">Designing</li>
                            <li class="list-inline-item categories-name border text-dark rounded"
                                data-group="photography">Photography</li>
                            <li class="list-inline-item categories-name border text-dark rounded"
                                data-group="development">Development</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container-fluid">
            <div id="grid" class="row mt-4">
                <div class="col-lg-3 col-md-6 col-12 spacing picture-item" data-groups='["branding"]'>
                    <div
                        class="card border-0 work-container work-primary work-grid position-relative d-block overflow-hidden rounded">
                        <div class="card-body p-0">
                            <a href="{{ asset('assets') }}/landrick/images/work/20.jpg" class="lightbox d-inline-block"
                                title="">
                                <img src="{{ asset('assets') }}/landrick/images/work/20.jpg" class="img-fluid"
                                    alt="work-image">
                            </a>
                            <div class="content p-3">
                                <h5 class="mb-0"><a href="portfolio-detail-one.html" class="text-dark title">Iphone
                                        mockup</a></h5>
                                <h6 class="text-muted tag mb-0">Branding</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 spacing picture-item" data-groups='["designing"]'>
                    <div
                        class="card border-0 work-container work-primary work-grid position-relative d-block overflow-hidden rounded">
                        <div class="card-body p-0">
                            <a href="{{ asset('assets') }}/landrick/images/work/13.jpg" class="lightbox d-inline-block"
                                title="">
                                <img src="{{ asset('assets') }}/landrick/images/work/13.jpg" class="img-fluid"
                                    alt="work-image">
                            </a>
                            <div class="content p-3">
                                <h5 class="mb-0"><a href="portfolio-detail-one.html" class="text-dark title">Mockup
                                        Collection</a></h5>
                                <h6 class="text-muted tag mb-0">Mockup</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 spacing picture-item" data-groups='["photography"]'>
                    <div
                        class="card border-0 work-container work-primary work-grid position-relative d-block overflow-hidden rounded">
                        <div class="card-body p-0">
                            <a href="{{ asset('assets') }}/landrick/images/work/14.jpg" class="lightbox d-inline-block"
                                title="">
                                <img src="{{ asset('assets') }}/landrick/images/work/14.jpg" class="img-fluid"
                                    alt="work-image">
                            </a>
                            <div class="content p-3">
                                <h5 class="mb-0"><a href="portfolio-detail-one.html" class="text-dark title">Abstract
                                        images</a></h5>
                                <h6 class="text-muted tag mb-0">Abstract</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 spacing picture-item" data-groups='["development"]'>
                    <div
                        class="card border-0 work-container work-primary work-grid position-relative d-block overflow-hidden rounded">
                        <div class="card-body p-0">
                            <a href="{{ asset('assets') }}/landrick/images/work/15.jpg" class="lightbox d-inline-block"
                                title="">
                                <img src="{{ asset('assets') }}/landrick/images/work/15.jpg" class="img-fluid"
                                    alt="work-image">
                            </a>
                            <div class="content p-3">
                                <h5 class="mb-0"><a href="portfolio-detail-one.html" class="text-dark title">Yellow bg
                                        with Books</a></h5>
                                <h6 class="text-muted tag mb-0">Books</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 spacing picture-item" data-groups='["branding"]'>
                    <div
                        class="card border-0 work-container work-primary work-grid position-relative d-block overflow-hidden rounded">
                        <div class="card-body p-0">
                            <a href="{{ asset('assets') }}/landrick/images/work/16.jpg" class="lightbox d-inline-block"
                                title="">
                                <img src="{{ asset('assets') }}/landrick/images/work/16.jpg" class="img-fluid"
                                    alt="work-image">
                            </a>
                            <div class="content p-3">
                                <h5 class="mb-0"><a href="portfolio-detail-one.html" class="text-dark title">Company
                                        V-card</a></h5>
                                <h6 class="text-muted tag mb-0">V-card</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 spacing picture-item" data-groups='["branding"]'>
                    <div
                        class="card border-0 work-container work-primary work-grid position-relative d-block overflow-hidden rounded">
                        <div class="card-body p-0">
                            <a href="{{ asset('assets') }}/landrick/images/work/17.jpg" class="lightbox d-inline-block"
                                title="">
                                <img src="{{ asset('assets') }}/landrick/images/work/17.jpg" class="img-fluid"
                                    alt="work-image">
                            </a>
                            <div class="content p-3">
                                <h5 class="mb-0"><a href="portfolio-detail-one.html" class="text-dark title">Mockup
                                        box with paints</a></h5>
                                <h6 class="text-muted tag mb-0">Photography</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 spacing picture-item" data-groups='["designing"]'>
                    <div
                        class="card border-0 work-container work-primary work-grid position-relative d-block overflow-hidden rounded">
                        <div class="card-body p-0">
                            <a href="{{ asset('assets') }}/landrick/images/work/18.jpg" class="lightbox d-inline-block"
                                title="">
                                <img src="{{ asset('assets') }}/landrick/images/work/18.jpg" class="img-fluid"
                                    alt="work-image">
                            </a>
                            <div class="content p-3">
                                <h5 class="mb-0"><a href="portfolio-detail-one.html" class="text-dark title">Coffee
                                        cup</a></h5>
                                <h6 class="text-muted tag mb-0">Cups</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 spacing picture-item" data-groups='["development"]'>
                    <div
                        class="card border-0 work-container work-primary work-grid position-relative d-block overflow-hidden rounded">
                        <div class="card-body p-0">
                            <a href="{{ asset('assets') }}/landrick/images/work/19.jpg"
                                class="lightbox d-inline-block" title="">
                                <img src="{{ asset('assets') }}/landrick/images/work/19.jpg" class="img-fluid"
                                    alt="work-image">
                            </a>
                            <div class="content p-3">
                                <h5 class="mb-0"><a href="portfolio-detail-one.html" class="text-dark title">Pen
                                        and article</a></h5>
                                <h6 class="text-muted tag mb-0">Article</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>

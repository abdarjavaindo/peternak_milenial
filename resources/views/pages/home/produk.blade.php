<x-layouts.home>
    <!-- Start Products -->
    <section class="section mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="card border-0 sidebar sticky-bar" style="background: #edefea;">
                        <div class="card-body p-0">
                            <div class="widget">
                                <div class="d-grid gap-2">
                                    <a class="btn btn-dark" href="#">Jual Produk</a>
                                </div>
                            </div>

                            <!-- SEARCH -->
                            <div class="widget mt-4">
                                <form role="search" method="get">
                                    <div class="input-group mb-3 border rounded">
                                        <input type="text" id="s" name="s"
                                            class="form-control border-0" placeholder="Search Keywords...">
                                        <button type="submit" class="input-group-text bg-white border-0 bg-success"
                                            id="searchsubmit"><i class="uil uil-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <!-- SEARCH -->

                            <!-- Categories -->
                            <div class="widget mt-4 pt-2">
                                <h5 class="widget-title">Categories</h5>
                                <ul class="list-unstyled mt-4 mb-0 blog-categories">
                                    <li><a href="jvascript:void(0)">Men</a></li>
                                    <li><a href="jvascript:void(0)">Women</a></li>
                                    <li><a href="jvascript:void(0)">Electronics</a></li>
                                    <li><a href="jvascript:void(0)">Jewellery</a></li>
                                    <li><a href="jvascript:void(0)">Shoes</a></li>
                                    <li><a href="jvascript:void(0)">Kid’s Wear</a></li>
                                    <li><a href="jvascript:void(0)">Sports</a></li>
                                    <li><a href="jvascript:void(0)">Toys</a></li>
                                    <li><a href="jvascript:void(0)">Gift Corners</a></li>
                                </ul>
                            </div>
                            <!-- Categories -->
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-lg-9 col-md-8 col-12 mt-5 pt-2 mt-sm-0 pt-sm-0">
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-7">
                            <div class="section-title">
                                <h5 class="mb-0">Showing 1–15 of 47 results</h5>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-5 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <div class="d-flex justify-content-md-between align-items-center">
                                <div class="form custom-form">
                                    <div class="mb-0">
                                        <select class="form-select form-control" aria-label="Default select example"
                                            id="Sortbylist-job">
                                            <option selected>Sort by latest</option>
                                            <option>Sort by popularity</option>
                                            <option>Sort by rating</option>
                                            <option>Sort by price: low to high</option>
                                            <option>Sort by price: high to low</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="mx-2">
                                    <a href="shop-grids.html" class="h5 text-muted"><i class="uil uil-apps"></i></a>
                                </div>

                                <div>
                                    <a href="shop-lists.html" class="h5 text-muted"><i class="uil uil-list-ul"></i></a>
                                </div> --}}
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <ul class="label list-unstyled mb-0">
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-success">Featured</a></li>
                                </ul>
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s1.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-1.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Branded
                                        T-Shirt</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$16.00</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s2.jpg"
                                            class="img-fluid" alt=""></a>
                                    <div class="overlay-work">
                                        <div class="py-2 bg-soft-dark rounded-bottom out-stock">
                                            <h6 class="mb-0 text-center">Out of stock</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Shopping
                                        Bag</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$21.00</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s3.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-3.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Elegent
                                        Watch</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$5.00 <span
                                                class="text-success ms-1">30% off</span> </h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s4.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-4.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Casual
                                        Shoes</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$18.00</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <ul class="label list-unstyled mb-0">
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-warning">Sale</a></li>
                                </ul>
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s5.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-5.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}"
                                        class="text-dark product-name h6">Earphones</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$3.00</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <ul class="label list-unstyled mb-0">
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-primary">New</a></li>
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-success">Featured</a></li>
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-warning">Sale</a></li>
                                </ul>
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s6.jpg"
                                            class="img-fluid" alt=""></a>
                                    <div class="overlay-work">
                                        <div class="py-2 bg-soft-dark rounded-bottom out-stock">
                                            <h6 class="mb-0 text-center">Out of stock</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Elegent
                                        Mug</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$4.50</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s7.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-7.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Sony
                                        Headphones</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$9.99 <span
                                                class="text-success ms-2">20% off</span> </h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <ul class="label list-unstyled mb-0">
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-primary">New</a></li>
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-success">Featured</a></li>
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-warning">Sale</a></li>
                                </ul>
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s8.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-8.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Wooden
                                        Stools</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$22.00</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <ul class="label list-unstyled mb-0">
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-success">Featured</a></li>
                                </ul>
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s9.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-9.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Coffee Cup
                                        /
                                        Mug</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$16.00</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <ul class="label list-unstyled mb-0">
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-primary">New</a></li>
                                </ul>
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s10.jpg"
                                            class="img-fluid" alt=""></a>
                                    <div class="overlay-work">
                                        <div class="py-2 bg-soft-dark rounded-bottom out-stock">
                                            <h6 class="mb-0 text-center">Out of stock</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}"
                                        class="text-dark product-name h6">Sunglasses</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$21.00</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <ul class="label list-unstyled mb-0">
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-success">Featured</a></li>
                                </ul>
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s11.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-11.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Loafer
                                        Shoes</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$5.00 <span
                                                class="text-success ms-1">30% off</span> </h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <ul class="label list-unstyled mb-0">
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-primary">New</a></li>
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-success">Featured</a></li>
                                    <li><a href="javascript:void(0)"
                                            class="badge badge-link rounded-pill bg-warning">Sale</a></li>
                                </ul>
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s12.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-12.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}"
                                        class="text-dark product-name h6">T-Shirts</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$18.00</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s13.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-13.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Wooden
                                        Chair</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$16.00</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s14.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-14.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}" class="text-dark product-name h6">Women
                                        Block
                                        Heels</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$21.00</h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="card shop-list border-0 position-relative">
                                <div class="shop-image position-relative overflow-hidden rounded shadow">
                                    <a href="{{ route('shop.detail') }}"><img
                                            src="{{ asset('assets') }}/landrick/images/shop/product/s15.jpg"
                                            class="img-fluid" alt=""></a>
                                    <a href="{{ route('shop.detail') }}" class="overlay-work">
                                        <img src="{{ asset('assets') }}/landrick/images/shop/product/s-15.jpg"
                                            class="img-fluid" alt="">
                                    </a>
                                    <ul class="list-unstyled shop-icons">
                                        <li><a href="javascript:void(0)"
                                                class="btn btn-icon btn-pills btn-soft-danger"><i data-feather="heart"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#productview"
                                                class="btn btn-icon btn-pills btn-soft-primary"><i data-feather="eye"
                                                    class="icons"></i></a></li>
                                        <li class="mt-2"><a href="shop-cart.html"
                                                class="btn btn-icon btn-pills btn-soft-warning"><i
                                                    data-feather="shopping-cart" class="icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body content pt-4 p-2">
                                    <a href="{{ route('shop.detail') }}"
                                        class="text-dark product-name h6">T-Shirts</a>
                                    <div class="d-flex justify-content-between mt-1">
                                        <h6 class="text-dark small fst-italic mb-0 mt-1">$5.00 <span
                                                class="text-success ms-1">30% off</span> </h6>
                                        <ul class="list-unstyled text-warning mb-0">
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <!-- PAGINATION START -->
                        <div class="col-12 mt-4 pt-2">
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0)"
                                        aria-label="Previous"><i class="mdi mdi-arrow-left"></i> Prev</a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)"
                                        aria-label="Next">Next <i class="mdi mdi-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>

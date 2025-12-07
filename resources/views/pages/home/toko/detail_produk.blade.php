<x-layouts.home>
    <section class="section pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="tiny-single-item">
                        @foreach ($produk->gambar as $item)
                            <div class="tiny-slide">
                                <a href="{{ asset('storage/produk/' . $item->nama_file) }}">
                                    <img src="{{ asset('storage/produk/' . $item->nama_file) }}" class="img-fluid rounded"
                                        alt="" style="width: 100%; height: 500px;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-7 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="section-title ms-md-4">
                        <h4 class="title">
                            {{ $produk->nama_produk }}
                        </h4>
                        <h5 class="text-muted">
                            {{ 'Rp ' . number_format($produk->harga, 0, ',', '.') . " Per $produk->satuan" }} (Stok
                            {{ $produk->stok }})
                        </h5>
                        <p class="fw-light mt-1 mb-0">
                            <i>
                                Dijual oleh: <a
                                    href="{{ route('shop.user', $produk->user->slug) }}">{{ $produk->user->name }}</a>
                            </i>
                        </p>
                        {{-- <ul class="list-unstyled text-warning h5 mb-0">
                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                        </ul> --}}

                        <h5 class="mt-4 py-2">Overview :</h5>
                        <p class="text-muted">{{ $produk->deskripsi_singkat }}</p>

                        @if (!auth()->check() || $produk->user_id != auth()->user()->id)
                            <div class="mt-4 pt-2">
                                <a href="{{ 'https://wa.me/' . @$produk->user->no_telp }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                                    </svg>
                                    Kontak WA
                                </a>
                            </div>
                        @else
                            <div class="mt-4 pt-2">
                                <a href="{{ route('tokoku.edit', $produk->id) }}" class="btn btn-warning">
                                    Edit
                                </a>
                                <a href="{{ route('tokoku.destroy', $produk->id) }}" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin akan ingin menghapus data ini')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                    Hapus
                                </a>
                            </div>
                        @endif
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->

        <div class="container mt-100 mt-60 mb-4">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills shadow flex-column flex-sm-row d-md-inline-flex mb-0 p-1 rounded position-relative overflow-hidden"
                        id="pills-tab" role="tablist">
                        <li class="nav-item m-1">
                            <a class="nav-link py-2 px-5 active rounded" id="description-data" data-bs-toggle="pill"
                                href="#description" role="tab" aria-controls="description" aria-selected="false">
                                <div class="text-center">
                                    <h6 class="mb-0">Description</h6>
                                </div>
                            </a>
                        </li>

                        {{-- <li class="nav-item m-1">
                            <a class="nav-link py-2 px-5 rounded" id="additional-info" data-bs-toggle="pill"
                                href="#additional" role="tab" aria-controls="additional" aria-selected="false">
                                <div class="text-center">
                                    <h6 class="mb-0">Additional Information</h6>
                                </div>
                            </a>
                        </li> --}}

                        <li class="nav-item m-1">
                            <a class="nav-link py-2 px-5 rounded" id="review-comments" data-bs-toggle="pill"
                                href="#review" role="tab" aria-controls="review" aria-selected="false">
                                <div class="text-center">
                                    <h6 class="mb-0">Review</h6>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-5" id="pills-tabContent">
                        <div class="card border-0 tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-data" style="background: #edefea;">
                            <p class="text-muted mb-0">{!! $produk->deskripsi !!}</p>
                        </div>

                        <div class="card border-0 tab-pane fade" id="additional" role="tabpanel"
                            aria-labelledby="additional-info">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="width: 100px;">Color</td>
                                        <td class="text-muted">Red, White, Black, Orange</td>
                                    </tr>

                                    <tr>
                                        <td>Material</td>
                                        <td class="text-muted">Cotton</td>
                                    </tr>

                                    <tr>
                                        <td>Size</td>
                                        <td class="text-muted">S, M, L, XL, XXL</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card border-0 tab-pane fade" id="review" role="tabpanel"
                            aria-labelledby="review-comments">
                            <div class="row" style="background: #edefea;">
                                <div class="col-lg-6">
                                    <ul class="media-list list-unstyled mb-0">
                                        <li>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <a class="pe-3" href="#">
                                                        <img src="{{ asset('assets') }}/mobirise/images/user.png"
                                                            class="img-fluid avatar avatar-md-sm rounded-circle shadow"
                                                            alt="img">
                                                    </a>
                                                    <div class="flex-1 commentor-detail">
                                                        <h6 class="mb-0"><a href="javascript:void(0)"
                                                                class="text-dark media-heading">User 1</a>
                                                        </h6>
                                                        <small class="text-muted">15 Agustus 2026 13:25</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <p class="text-muted fst-italic p-3 bg-light rounded">" Awesome product
                                                    "</p>
                                            </div>
                                        </li>

                                        <li class="mt-4">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <a class="pe-3" href="#">
                                                        <img src="{{ asset('assets') }}/mobirise/images/user.png"
                                                            class="img-fluid avatar avatar-md-sm rounded-circle shadow"
                                                            alt="img">
                                                    </a>
                                                    <div class="flex-1 commentor-detail">
                                                        <h6 class="mb-0"><a href="javascript:void(0)"
                                                                class="media-heading text-dark">User 2</a></h6>
                                                        <small class="text-muted">15 Agustus 2026 17:25</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <p class="text-muted fst-italic p-3 bg-light rounded mb-0">" Good "</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-lg-6 mt-4 mt-lg-0 pt-2 pt-lg-0">
                                    <form class="ms-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5>Add your review:</h5>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Your Review:</label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="message-circle"
                                                            class="fea icon-sm icons"></i>
                                                        <textarea id="message" placeholder="Your Comment" rows="5" name="message" class="form-control ps-5"
                                                            required=""></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Name <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="user" class="fea icon-sm icons"></i>
                                                        <input id="name" name="name" type="text"
                                                            placeholder="Name" class="form-control ps-5"
                                                            required="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Your Email <span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-icon position-relative">
                                                        <i data-feather="mail" class="fea icon-sm icons"></i>
                                                        <input id="email" type="email" placeholder="Email"
                                                            name="email" class="form-control ps-5" required="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="send d-grid">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>

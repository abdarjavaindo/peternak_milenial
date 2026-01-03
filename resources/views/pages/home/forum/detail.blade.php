<x-layouts.home>
    <section class="section mt-60 pb-0">
        <div class="container">
            <x-flash-message></x-flash-message>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-sm bg-light rounded mb-3">
                        <div class="card-body">

                            <ul class="media-list list-unstyled mb-0">
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
                                                        class="media-heading text-dark">{{ $forum->user->name }}</a>
                                                </h6>
                                                <small class="text-muted">{{ $forum->created_at }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <h4 class="title">
                                {{ $forum->judul }}
                            </h4>

                            {!! $forum->konten !!}

                        </div>
                    </div>
                    @if (auth()->user())
                        @if ($forum->user_id == auth()->user()->id)
                            <a href="{{ route('forum.destroy', $forum->id) }}" class="btn btn-sm btn-danger ms-3"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini')">
                                Hapus Thread
                            </a>
                        @elseif(auth()->user()->hasRole('admin'))
                            <a href="{{ route('forum.destroy', $forum->id) }}" class="btn btn-sm btn-danger ms-3"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini')">
                                Hapus Thread
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Start Forums -->
    <div class="container mb-4 mt-4">
        <h4 class="title">
            Komentar
        </h4>
        <div class="row">
            <div class="col-lg-6">
                <div class="card border-0">
                    <div class="row" style="background: #edefea;">
                        <ul class="media-list list-unstyled mb-0">
                            @if (isset($forum->komentar) && $forum->komentar->count() > 0)
                                @foreach ($forum->komentar as $item)
                                    <li>
                                        <div class="d-flex justify-content-between align-items-start">

                                            <!-- Kiri -->
                                            <div class="d-flex align-items-center">
                                                @if ($item->user->gambar)
                                                    <a class="pe-3"
                                                        href="{{ route('shop.user', $item->user->slug) }}">
                                                        <img src="{{ asset('storage/' . $item->user->gambar) }}"
                                                            class="img-fluid avatar avatar-md-sm rounded-circle shadow"
                                                            alt="img">
                                                    </a>
                                                @else
                                                    <a class="pe-3"
                                                        href="{{ route('shop.user', $item->user->slug) }}">
                                                        <img src="{{ asset('assets') }}/mobirise/images/user.png"
                                                            class="img-fluid avatar avatar-md-sm rounded-circle shadow"
                                                            alt="img">
                                                    </a>
                                                @endif
                                                <div class="flex-1 commentor-detail">
                                                    <h6 class="mb-0">
                                                        <a href="{{ route('shop.user', $item->user->slug) }}"
                                                            class="text-dark media-heading">
                                                            {{ $item->user->name }}
                                                        </a>
                                                    </h6>
                                                    <small class="text-muted">{{ $item->created_at }}</small>
                                                </div>
                                            </div>

                                            @if (auth()->user())
                                                @if ($item->user_id == auth()->user()->id)
                                                    <a href="{{ route('komentar.destroy', $item->id) }}"
                                                        class="btn btn-sm btn-danger ms-3"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini')">
                                                        Hapus
                                                    </a>
                                                @elseif(auth()->user()->hasRole('admin'))
                                                    <a href="{{ route('komentar.destroy', $item->id) }}"
                                                        class="btn btn-sm btn-danger ms-3"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini')">
                                                        Hapus
                                                    </a>
                                                @endif
                                            @endif
                                        </div>

                                        <div class="mt-3">
                                            <p class="text-muted fst-italic p-3 bg-light rounded">
                                                {{ $item->komentar }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <div class="alert alert-secondary text-center" role="alert">
                                    Belum ada komentar
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-4 mt-lg-0 pt-2 pt-lg-0">
                @if (auth()->user())
                    @if ($jumlahternak < 1)
                        <div class="alert alert-warning" role="alert">
                            Anda harus melengkapi daftar ternak yang anda miliki terlebih dahulu sebelum menulis
                            komentar <a href="{{ route('ternak') }}" class="text-dark"><u>(Menuju Daftar
                                    Ternak)</u></a>
                        </div>
                    @else
                        <div class="card border-0 sidebar sticky-bar rounded shadow bg-light p-2">
                            <form class="ms-lg-4" method="POST" action="{{ route('komentar.store', $forum->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Tambahkan Komentar</h5>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Komentar:
                                                <span class="text-danger"><i>(required)</i></span>
                                            </label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="message-circle" class="fea icon-sm icons"></i>
                                                <textarea id="komentar" placeholder="Komentar Anda" rows="5" name="komentar" class="form-control ps-5"
                                                    required=""></textarea>
                                                @error('komentar')
                                                    <span class="text-danger" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Nama:
                                                <span class="text-warning"><i>(readonly)</i></span>
                                            </label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="user" class="fea icon-sm icons"></i>
                                                <input id="name" name="name" type="text"
                                                    class="form-control ps-5" readonly
                                                    value="{{ auth()->user()->name }}">
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
                    @endif

                @endif
            </div>
        </div>
    </div>
</x-layouts.home>

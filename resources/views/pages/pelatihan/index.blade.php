<x-layouts.home>
    <section class="section">
        @if ($pelatihan->count() > 0)
            <div class="container mt-60">
                <div class="row">
                    @foreach ($pelatihan as $fas)
                        <div class="col-lg-4 col-md-6 col-12">
                            <a href="#">
                                <div class="card shop-list border-0 shadow position-relative overflow-hidden">
                                    <div class="shop-image position-relative overflow-hidden shadow">
                                        <img src="{{ $fas->thumbnail }}" class="img-fluid" alt=""
                                            style="width: 100%; height: 200px;">
                                    </div>
                                    <div class="card-body content p-4">
                                        <a href="#" class="text-dark product-name h6">
                                            {{ $fas->title }}
                                        </a><br>
                                        <small class="text-muted">
                                            @if ($fas->level == 'pemula')
                                                <i class="text-success">{{ $fas->level }}</i>
                                            @elseif ($fas->level == 'menengah')
                                                <i class="text-warning">{{ $fas->level }}</i>
                                            @else
                                                <i class="text-danger">{{ $fas->level }}</i>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="container">
                <div class="col-12 mt-4 pt-2">
                    <div class="alert alert-secondary text-center" role="alert">
                        Belum ada fasilitas yang tersedia untuk disewakan
                    </div>
                </div>
            </div>
        @endif
    </section>
</x-layouts.home>

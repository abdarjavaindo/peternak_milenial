<x-layouts.home>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <x-flash-message></x-flash-message>
                    <br>
                    <div class="text-center subcribe-form mb-2">
                        <form method="GET" style="max-width:800px;">
                            <input type="text" id="s" name="s" value="{{ request('s') }}"
                                class="rounded-pill shadow" placeholder="Cari...">

                            <button type="submit" class="btn btn-pills btn-primary">Cari</button>
                        </form>
                        @if (auth()->user())
                            <a href="{{ route('forum.create') }}" class="btn btn-primary mt-2">Tambah Thread</a>
                        @endif
                    </div>

                    <div class="table-responsive bg-white shadow rounded mt-4">
                        <table class="table mb-0 table-center">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-bottom p-3" style="min-width: 300px;"></th>
                                    <th scope="col" class="border-bottom p-3 text-center" style="max-width: 150px;">
                                        Dibuat oleh
                                    </th>
                                    <th scope="col" class="border-bottom p-3 text-end" style="width: 100px;">
                                        Komentar
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($forums as $forum)
                                    <tr>
                                        <td class="p-3">
                                            <div class="d-flex">
                                                <i class="uil uil-comment text-muted h5"></i>
                                                <div class="flex-1 content ms-3">
                                                    <a href="{{ route('forum.detail', $forum->slug) }}"
                                                        class="forum-title text-primary fw-bold">{{ $forum->judul }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center small p-3 h6">{{ $forum->user->name }}</td>
                                        <td class="text-center small p-3 text-end">{{ $forum->komentar->count() }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- PAGINATION START -->
                    <div class="col-12 mt-4 pt-2">
                        {{ $forums->onEachSide(1)->links('components.custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>

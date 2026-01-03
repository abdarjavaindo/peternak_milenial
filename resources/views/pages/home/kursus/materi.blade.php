<x-layouts.home>
    <!-- Start -->
    <section class="section mt-60">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <div class="d-flex justify-content-between mb-1">
                        <div>
                            @if (isset($materiSebelumnya))
                                <a href="{{ route('pelatihan.materi', $materiSebelumnya->id) }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5" />
                                    </svg>
                                    Prev
                                </a>
                            @endif
                            <a href="{{ route('pelatihan.detail', $kursus_materi->bagian->kursus->slug) }}"
                                class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                    <path
                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                                </svg>
                                Home
                            </a>
                        </div>

                        @if (isset($materiSelanjutnya))
                            <a id="btnNext1" href="{{ route('pelatihan.next', $materiSelanjutnya->id) }}"
                                class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-skip-forward-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M15.5 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V8.753l-6.267 3.636c-.54.313-1.233-.066-1.233-.697v-2.94L1.733 12.39C1.193 12.703.5 12.324.5 11.693V4.308c0-.63.693-1.01 1.233-.696L8 7.248v-2.94c0-.63.692-1.01 1.233-.696L15 7.248V4a.5.5 0 0 1 .5-.5" />
                                </svg>
                                Next
                            </a>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-lg-3 mt-4 mt-lg-0 pt-2 pt-lg-0">
                            <div class="card border-0 sidebar sticky-bar rounded shadow bg-light p-2">
                                <div class="row">
                                    @foreach ($pelatihan->bagian->sortBy('urutan') as $bagi)
                                        <div class="col-md-12 mt-4 pt-2">
                                            <h5 class="mb-0">{{ $bagi->judul }}</h5>
                                            <div class="table-responsive bg-white shadow rounded mt-4">
                                                <table class="table mb-0 table-center">
                                                    <tbody>
                                                        @foreach ($bagi->materi as $mat)
                                                            <tr>
                                                                <th class="p-3">
                                                                    <div class="align-items-center">
                                                                        <i class="uil uil-notes h6"></i>
                                                                        <p class="mb-0 d-inline fw-normal h6 ms-1">
                                                                            <a href="{{ route('pelatihan.materi', $mat->id) }}"
                                                                                class="text-muted">
                                                                                {{ $mat->judul }}
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                </th>
                                                                <td class="p-3 text-end">
                                                                    @php
                                                                        $progress = $materi_progress[$mat->id] ?? null;
                                                                    @endphp
                                                                    @if ($progress)
                                                                        @if ($progress->status == 'progres')
                                                                            <span class="badge bg-soft-warning">
                                                                                Lanjutkan
                                                                            </span>
                                                                        @elseif ($progress->status == 'selesai')
                                                                            <span class="badge bg-soft-primary">
                                                                                Selesai
                                                                            </span>
                                                                        @endif
                                                                    @else
                                                                        <i class="uil uil-lock"></i>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 mt-4 mt-lg-0 pt-2 pt-lg-0">
                            <div class="card rounded shadow p-4 border-0">
                                <h4 class="title mb-4">{{ $kursus_materi->judul }}</h4>
                                {!! $kursus_materi->konten !!}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-1">
                        <div>
                            @if (isset($materiSebelumnya))
                                <a href="{{ route('pelatihan.materi', $materiSebelumnya->id) }}"
                                    class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-skip-backward-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 3.5A.5.5 0 0 0 0 4v8a.5.5 0 0 0 1 0V8.753l6.267 3.636c.54.313 1.233-.066 1.233-.697v-2.94l6.267 3.636c.54.314 1.233-.065 1.233-.696V4.308c0-.63-.693-1.01-1.233-.696L8.5 7.248v-2.94c0-.63-.692-1.01-1.233-.696L1 7.248V4a.5.5 0 0 0-.5-.5" />
                                    </svg>
                                    Prev
                                </a>
                            @endif
                        </div>

                        @if (isset($materiSelanjutnya))
                            <a id="btnNext2" href="{{ route('pelatihan.next', $materiSelanjutnya->id) }}"
                                class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-skip-forward-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M15.5 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V8.753l-6.267 3.636c-.54.313-1.233-.066-1.233-.697v-2.94L1.733 12.39C1.193 12.703.5 12.324.5 11.693V4.308c0-.63.693-1.01 1.233-.696L8 7.248v-2.94c0-.63.692-1.01 1.233-.696L15 7.248V4a.5.5 0 0 1 .5-.5" />
                                </svg>
                                Next
                            </a>
                        @else
                            <form
                                action="{{ route('pelatihan.selesai', ['slug' => $kursus_materi->bagian->kursus->slug, 'kursus_materi' => $kursus_materi->id]) }}"
                                method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    Selesai
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.home>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // daftar ID tombol
        const buttons = [
            document.getElementById('btnNext1'),
            document.getElementById('btnNext2')
        ];

        let countdown = 30; // 5 menit = 300 detik

        // Fungsi disable semua tombol
        function disableButtons() {
            buttons.forEach(btn => {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-secondary');
                btn.style.pointerEvents = 'none'; // tidak bisa diklik
            });
        }

        // Fungsi enable kembali
        function enableButtons() {
            buttons.forEach(btn => {
                btn.classList.remove('btn-secondary');
                btn.classList.add('btn-primary');
                btn.style.pointerEvents = 'auto';
                btn.textContent = "Next";
            });
        }

        // Jalankan countdown
        function startCountdown() {
            disableButtons();

            const interval = setInterval(() => {
                countdown--;

                // update teks tiap detik
                buttons.forEach(btn => btn.textContent = "Tunggu " + countdown + " detik");

                if (countdown <= 0) {
                    clearInterval(interval);
                    enableButtons();
                }
            }, 1000);
        }

        // Mulai hitungan
        startCountdown();
    });
</script>

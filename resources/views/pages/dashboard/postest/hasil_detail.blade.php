<x-layouts.dashboard>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pembelajaran') }}">Pembelajaran</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bagian', $materi->bagian->kursus->id) }}">Section</a></li>
            <li class="breadcrumb-item"><a href="{{ route('materi', $materi->bagian->id) }}">Materi</a></li>
            <li class="breadcrumb-item"><a href="{{ route('hasil', $materi->id) }}">Hasil Postest</a></li>
            <li class="breadcrumb-item active">Detail Jawaban</li>
        </ol>
    </nav>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- Header Info -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Detail Hasil Postest</h5>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td width="120">Nama</td>
                                    <td>: <strong>{{ $attempt->user->name ?? '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: {{ $attempt->user->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Materi</td>
                                    <td>: {{ $materi->judul }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td width="120">Nilai</td>
                                    <td>: <strong
                                            class="{{ $attempt->status === 'lulus' ? 'text-success' : 'text-danger' }}">{{ $attempt->nilai }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:
                                        @if($attempt->status === 'lulus')
                                            <span class="badge bg-success">Lulus</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Lulus</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td>: {{ $attempt->mulai_pada?->format('d M Y H:i') }} -
                                        {{ $attempt->selesai_pada?->format('H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>

                    <!-- Jawaban Detail -->
                    <h6 class="mb-3">Rincian Jawaban</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban User</th>
                                    <th class="text-center" width="10%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attempt->jawabans as $index => $jawaban)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{!! Str::limit(strip_tags($jawaban->pertanyaan->pertanyaan ?? '-'), 100) !!}
                                        </td>
                                        <td>{{ $jawaban->jawaban->opsi ?? '-' }}</td>
                                        <td class="text-center">
                                            @if($jawaban->is_correct == '1')
                                                <span class="badge bg-success">Benar</span>
                                            @else
                                                <span class="badge bg-danger">Salah</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Tidak ada jawaban</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('hasil', $materi->id) }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.dashboard>
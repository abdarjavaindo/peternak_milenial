<x-layouts.home>
    <!-- Postest Section -->
    <section class="section mt-60">
        <div class="container">
            <div class="row">
                <!-- Header with Timer -->
                <div class="col-12 mb-4">
                    <div class="card rounded shadow border-0 text-white" style="background: linear-gradient(135deg, #2196F3, #1976D2);">
                        <div class="card-body d-flex justify-content-between align-items-center py-3">
                            <h4 class="mb-0 text-white">SOAL UJIAN</h4>
                            <div id="timer" class="h5 mb-0">
                                <i class="uil uil-clock me-2"></i>
                                <span id="timer-display">--:--:--</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question Area -->
                <div class="col-lg-8 col-md-7">
                    <div class="card rounded shadow border-0">
                        <div class="card-body p-4">
                            <!-- Question Number -->
                            <div class="mb-3">
                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    SOAL NO <span class="fw-bold">{{ $nomor }}</span>
                                </span>
                            </div>

                            <!-- Question Text -->
                            <div class="mb-4">
                                <p class="text-dark" style="font-size: 1.1rem; line-height: 1.8;">
                                    {!! $currentQuestion->pertanyaan !!}
                                </p>
                            </div>

                            <!-- Answer Options -->
                            <div class="options-container">
                                @foreach($shuffledOptions as $index => $option)
                                    <div class="form-check mb-3 p-3 rounded border option-item {{ $currentAnswer && $currentAnswer->jawaban_id == $option->id ? 'border-primary bg-soft-primary' : '' }}"
                                         data-option-id="{{ $option->id }}"
                                         onclick="selectOption({{ $currentQuestion->id }}, {{ $option->id }}, this)"
                                         style="cursor: pointer;">
                                        <input class="form-check-input" type="radio"
                                               name="jawaban_{{ $currentQuestion->id }}"
                                               id="option_{{ $option->id }}"
                                               value="{{ $option->id }}"
                                               {{ $currentAnswer && $currentAnswer->jawaban_id == $option->id ? 'checked' : '' }}>
                                        <label class="form-check-label w-100" for="option_{{ $option->id }}" style="cursor: pointer;">
                                            {{ $option->opsi }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                @if($nomor > 1)
                                    <a href="{{ route('postest.soal', [$attempt, $nomor - 1]) }}" class="btn btn-outline-primary">
                                        <i class="uil uil-arrow-left me-1"></i> Sebelumnya
                                    </a>
                                @else
                                    <div></div>
                                @endif

                                @if($nomor < $totalSoal)
                                    <a href="{{ route('postest.soal', [$attempt, $nomor + 1]) }}" class="btn btn-primary">
                                        Selanjutnya <i class="uil uil-arrow-right ms-1"></i>
                                    </a>
                                @else
                                    <button type="button" class="btn btn-success" onclick="confirmSubmit()">
                                        <i class="uil uil-check me-1"></i> Selesai & Kumpulkan
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Panel -->
                <div class="col-lg-4 col-md-5 mt-4 mt-md-0">
                    <div class="card rounded shadow border-0 sticky-bar">
                        <div class="card-body">
                            <h5 class="mb-3">Navigasi Soal</h5>

                            <div class="d-flex flex-wrap gap-2">
                                @foreach($questions as $index => $q)
                                    @php
                                        $qNumber = $index + 1;
                                        $isAnswered = in_array($q->id, $answeredIds);
                                        $isCurrent = ($qNumber == $nomor);
                                    @endphp
                                    <a href="{{ route('postest.soal', [$attempt, $qNumber]) }}"
                                       class="btn btn-sm {{ $isCurrent ? 'btn-primary' : ($isAnswered ? 'btn-success' : 'btn-outline-secondary') }}"
                                       style="width: 45px; height: 40px; display: flex; align-items: center; justify-content: center;"
                                       id="nav-{{ $q->id }}"
                                       @if($isAnswered) data-answered="true" @endif>
                                        {{ str_pad($qNumber, 2, '0', STR_PAD_LEFT) }}
                                    </a>
                                @endforeach
                            </div>

                            <!-- Legend -->
                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="btn btn-sm btn-success me-2" style="width: 20px; height: 20px; padding: 0;"></span>
                                    <small class="text-success">Telah dijawab</small>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="btn btn-sm btn-outline-secondary me-2" style="width: 20px; height: 20px; padding: 0;"></span>
                                    <small class="text-muted">Belum Dijawab</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="btn btn-sm btn-primary me-2" style="width: 20px; height: 20px; padding: 0;"></span>
                                    <small class="text-primary">Soal Aktif</small>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-4 pt-3 border-top">
                                <p class="text-muted small mb-2">
                                    Dijawab: <strong id="answered-count">{{ count($answeredIds) }}</strong> / {{ $totalSoal }}
                                </p>
                                <button type="button" class="btn btn-success w-100" onclick="confirmSubmit()">
                                    <i class="uil uil-check-circle me-1"></i> Kumpulkan Jawaban
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hidden Submit Form -->
    <form id="submit-form" action="{{ route('postest.submit', $attempt) }}" method="POST" style="display: none;">
        @csrf
    </form>

    <style>
        .option-item {
            transition: all 0.2s ease;
        }
        .option-item:hover {
            border-color: var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), 0.05);
        }
        .option-item.selected {
            border-color: var(--bs-primary) !important;
            background-color: rgba(var(--bs-primary-rgb), 0.1);
        }
        .sticky-bar {
            position: sticky;
            top: 100px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Timer functionality
        let remainingSeconds = {{ $remainingSeconds }};

        function updateTimer() {
            if (remainingSeconds <= 0) {
                document.getElementById('timer-display').textContent = '00:00:00';
                // Auto submit
                document.getElementById('submit-form').submit();
                return;
            }

            const hours = Math.floor(remainingSeconds / 3600);
            const minutes = Math.floor((remainingSeconds % 3600) / 60);
            const seconds = remainingSeconds % 60;

            const display = `${hours} Jam ${String(minutes).padStart(2, '0')} Menit ${String(seconds).padStart(2, '0')} Detik`;
            document.getElementById('timer-display').textContent = display;

            remainingSeconds--;
        }

        // Update timer every second
        updateTimer();
        setInterval(updateTimer, 1000);

        // Select option and save via AJAX
        function selectOption(pertanyaanId, jawabanId, element) {
            // Update UI
            document.querySelectorAll('.option-item').forEach(item => {
                item.classList.remove('border-primary', 'bg-soft-primary', 'selected');
            });
            element.classList.add('border-primary', 'bg-soft-primary', 'selected');

            // Check the radio
            element.querySelector('input[type="radio"]').checked = true;

            // Save via AJAX
            fetch('{{ route('postest.simpan', $attempt) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    pertanyaan_id: pertanyaanId,
                    jawaban_id: jawabanId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update navigation button - mark as answered
                    const navBtn = document.getElementById('nav-' + pertanyaanId);
                    if (navBtn) {
                        // Mark as answered via data attribute (for counting)
                        navBtn.setAttribute('data-answered', 'true');
                        
                        // If it's NOT the current question, also update the visual style
                        if (!navBtn.classList.contains('btn-primary')) {
                            navBtn.classList.remove('btn-outline-secondary');
                            navBtn.classList.add('btn-success');
                        }
                    }

                    // Update count
                    updateAnsweredCount();
                }
            })
            .catch(error => {
                console.error('Error saving answer:', error);
            });
        }

        function updateAnsweredCount() {
            // Count by data attribute instead of just CSS class
            const answered = document.querySelectorAll('[id^="nav-"][data-answered="true"]').length;
            document.getElementById('answered-count').textContent = answered;
        }


        function confirmSubmit() {
            // Use data-answered attribute for accurate counting
            const answered = document.querySelectorAll('[id^="nav-"][data-answered="true"]').length;
            const total = {{ $totalSoal }};

            let htmlMessage = `<p>Anda akan mengumpulkan jawaban.</p>
                <p><strong>Dijawab:</strong> ${answered} dari ${total} soal.</p>`;

            if (answered < total) {
                htmlMessage += `<p class="text-warning"><strong>⚠️ Perhatian:</strong> Masih ada ${total - answered} soal yang belum dijawab!</p>`;
            }

            Swal.fire({
                title: 'Kumpulkan Jawaban?',
                html: htmlMessage,
                icon: answered < total ? 'warning' : 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Kumpulkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('submit-form').submit();
                }
            });
        }
    </script>
</x-layouts.home>

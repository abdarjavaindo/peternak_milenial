<x-layouts.dashboard>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pembelajaran') }}">Pembelajaran</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bagian', $materi->bagian->kursus->id) }}">Section</a></li>
            <li class="breadcrumb-item"><a href="{{ route('materi', $materi->bagian->id) }}">Materi dan Postest</a></li>
            <li class="breadcrumb-item active">Hasil Postest</li>
        </ol>
    </nav>

    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
        <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('materi.edit', $materi->id) }}">
            Edit Materi
        </a>
        <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('pertanyaan', $materi->id) }}">
            Pertanyaan
        </a>
        <a class="flex-sm-fill text-sm-center nav-link active" href="{{ route('hasil', $materi->id) }}">
            Hasil Peserta
        </a>
    </nav>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-description">
                        <h5 class="mb-0">Hasil Postest: {{ $materi->judul }}</h5>
                        <p class="text-muted">
                            KKM: {{ $materi->nilai_lulus_postest ?? 70 }} |
                            Durasi: {{ $materi->durasi_postest ?? '-' }} menit
                        </p>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="_table" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center">Nama User</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center" width="10%">Nilai</th>
                                    <th class="text-center" width="12%">Status</th>
                                    <th class="text-center" width="10%">Waktu</th>
                                    <th class="text-center" width="15%">Tanggal Ujian</th>
                                    <th class="text-center" width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.dashboard>
<link href="{{ asset('assets') }}/customs/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="{{ asset('assets') }}/customs/js/jquery-3.5.1.js"></script>
<script src="{{ asset('assets') }}/customs/js/jquery.validate.js"></script>
<script src="{{ asset('assets') }}/customs/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/customs/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    var table = $('#_table').DataTable({
        responsive: false,
        serverSide: true,
        processing: true,
        stateSave: true,
        ajax: {
            url: "{{ route('hasil.loaddata', $materi->id) }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [{
            data: 'DT_RowIndex'
        },
        {
            data: 'nama_user'
        },
        {
            data: 'email'
        },
        {
            data: 'nilai_format',
            className: 'text-center'
        },
        {
            data: 'status_format',
            className: 'text-center',
            orderable: false
        },
        {
            data: 'waktu',
            className: 'text-center'
        },
        {
            data: 'tgl_ujian',
            className: 'text-center'
        },
        {
            data: 'aksi',
            className: 'text-center',
            orderable: false,
            searchable: false
        }
        ],
        language: {
            emptyTable: 'Belum ada peserta yang mengerjakan postest ini',
            zeroRecords: 'Data Tidak Ditemukan'
        },
        columnDefs: [{
            "targets": [0],
            "className": "text-center",
        }],
    });

    $(document).on('click', '.delete-button', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: 'Hapus Hasil Postest?',
            html: '<p>Apakah Anda yakin ingin menghapus hasil postest ini?</p>' +
                '<p class="text-warning"><strong>ℹ️ Info:</strong> User akan dapat mengulang postest.</p>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
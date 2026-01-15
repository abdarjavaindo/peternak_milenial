<x-layouts.dashboard>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pembelajaran') }}">Pelatihan</a></li>
            <li class="breadcrumb-item active">Peserta</li>
        </ol>
    </nav>

    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
        @if ($kursus->kategori_kursus_id == 1)
            <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('bagian', $kursus->id) }}">Section</a>
        @endif
        <a class="flex-sm-fill text-sm-center nav-link active" href="{{ route('peserta', $kursus->id) }}">Peserta</a>
    </nav>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="_table" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="12%">Nama</th>
                                    <th class="text-center" width="13%">Status</th>
                                    <th class="text-center" width="13%">Deadline</th>
                                    <th class="text-center" width="20%">Rincian</th>
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
            url: "{{ route('peserta.loaddata', $kursus->id) }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'nama'
            },
            {
                data: 'status_now'
            },
            {
                data: 'harus_selesai_tgl'
            },
            {
                data: 'aksi',
                className: 'text-center',
                orderable: false,
                searchable: false
            }
        ],
        language: {
            emptyTable: 'Data Kosong',
            zeroRecords: 'Data Tidak Ditemukan'
        },
        columnDefs: [{
            "targets": [0, 4],
            "className": "text-center",
        }],
    });

    $(document).on('click', '.delete-button', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: 'Hapus Kepesertaan?',
            html: '<p>Apakah Anda yakin ingin menghapus kepesertaan user ini?</p>' +
                '<p class="text-danger"><strong>⚠️ Perhatian:</strong> Data progress, postest, dan jawaban user juga akan dihapus.</p>',
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

    $(document).on('click', '.lulus-button', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        Swal.fire({
            title: 'Nyatakan Lulus?',
            html: '<p>Apakah anda yakin ingin meluluskan peserta ini?</p>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });

    $(document).on('click', '.batal-lulus-button', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        Swal.fire({
            title: 'Batalkan kelulusan?',
            html: '<p>Apakah anda yakin ingin membatalkan kelulusan peserta ini?</p>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });

    $(document).on('click', '.do-button', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        Swal.fire({
            title: 'Nyatakan keluar?',
            html: '<p>Apakah anda yakin ingin mengeluarkan peserta ini?</p>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });

    $(document).on('click', '.batal-do-button', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        Swal.fire({
            title: 'Batal Mengeluarkan Peserta?',
            html: '<p>Apakah anda yakin ingin batalkan mengeluarkan paserta?</p>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>

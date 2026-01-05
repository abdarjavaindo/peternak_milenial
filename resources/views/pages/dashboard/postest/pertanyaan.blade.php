<x-layouts.dashboard>
    {{-- <h1 class="app-page-title">Pertanyaan</h1> --}}

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pembelajaran') }}">Pembelajaran</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bagian', $materi->bagian->kursus->id) }}">Section</a></li>
            <li class="breadcrumb-item"><a href="{{ route('materi', $materi->bagian->id) }}">Materi dan Postest</a></li>
            <li class="breadcrumb-item active">Pertanyaan</li>
        </ol>
    </nav>

    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
        <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('materi.edit', $materi->id) }}">
            Edit Materi
        </a>
        <a class="flex-sm-fill text-sm-center nav-link active" href="{{ route('pertanyaan', $materi->id) }}">
            Pertanyaan
        </a>
        <a class="flex-sm-fill text-sm-center nav-link" href="#">
            Peserta
        </a>
    </nav>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-description" align="right">
                        <a href="{{ route('pertanyaan.create', $materi->id) }}" class="btn text-white"
                            style="background-color: #165d7d"><i class="fa fa-plus"></i>
                            Tambah Pertanyaan
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="_table" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="75%">Pertanyaan</th>
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

<script type="text/javascript">
    var table = $('#_table').DataTable({
        responsive: false,
        serverSide: true,
        processing: true,
        stateSave: true,
        ajax: {
            url: "{{ route('pertanyaan_loaddata', $materi->id) }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'pertanyaan'
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
            "targets": [0, 2],
            "className": "text-center",
        }],
    });

    $(document).on('click', '.delete-button', function() {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $(this).closest('form').submit(); // Submit form penghapusan
        }
    });
</script>

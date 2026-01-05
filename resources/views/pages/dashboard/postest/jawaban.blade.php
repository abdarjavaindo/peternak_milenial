<x-layouts.dashboard>
    {{-- <h1 class="app-page-title">Pertanyaan</h1> --}}

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('pembelajaran') }}">Pembelajaran</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('bagian', $pertanyaan->materi->bagian->kursus->id) }}">Section</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('materi', $pertanyaan->materi->bagian->id) }}">
                    Materi dan Postest
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('pertanyaan', $pertanyaan->materi->id) }}">Pertanyaan</a>
            </li>
            <li class="breadcrumb-item active">Jawaban</li>
        </ol>
    </nav>

    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
        <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('pertanyaan.edit', $pertanyaan->id) }}">Edit
            Pertanyaan</a>
        <a class="flex-sm-fill text-sm-center nav-link active" href="{{ route('jawaban', $pertanyaan->id) }}">
            Pilihan Jawaban
        </a>
    </nav>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-description" align="right">
                        <a href="{{ route('jawaban.create', $pertanyaan->id) }}" class="btn text-white"
                            style="background-color: #165d7d"><i class="fa fa-plus"></i>
                            Tambah Pilihan Jawaban
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="_table" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="50%">Jawaban</th>
                                    <th class="text-center" width="25%">Benar?</th>
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
            url: "{{ route('jawaban_loaddata', $pertanyaan->id) }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'opsi'
            },
            {
                data: 'benarkah'
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
            "targets": [0, 3],
            "className": "text-center",
        }],
    });

    $(document).on('click', '.delete-button', function() {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $(this).closest('form').submit(); // Submit form penghapusan
        }
    });
</script>

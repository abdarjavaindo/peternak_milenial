<x-layouts.dashboard>
    <h1 class="app-page-title">Komoditas yang Dijual</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-description" align="right">
                        <a href="{{ route('kategori-produk.create') }}" class="btn text-white"
                            style="background-color: #222222">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="_table" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="12%">Hewan</th>
                                    <th class="text-center" width="12%">Komoditas</th>
                                    <th class="text-center" width="13%">Slug</th>
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
            url: "{{ route('kategori-produk.loaddata') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'hewan'
            },
            {
                data: 'nama_kategori'
            },
            {
                data: 'slug_kategori'
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
            title: 'Hapus Komoditas?',
            text: 'Apakah Anda yakin ingin menghapus komoditas ini?',
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

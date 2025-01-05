<x-layouts.dashboard>
    <h1 class="app-page-title">Pengadaan</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->hasRole('user'))
                        <div class="card-description" align="right">
                            <a href="{{ route('pengadaan.create') }}" class="btn text-white"
                                style="background-color: #165d7d"><i class="fa fa-plus"></i>
                                Tambah Pengadaan
                            </a>
                        </div>
                        <hr>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="_table" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="12%">User</th>
                                    <th class="text-center" width="12%">Nama Vendor</th>
                                    <th class="text-center" width="13%">Tanggal</th>
                                    <th class="text-center" width="13%">Nominal</th>
                                    <th class="text-center" width="13%">Nomor Rekening</th>
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
            url: "{{ url('pengadaan/loaddata') }}",
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
                data: 'nama_vendor'
            },
            {
                data: 'tanggal'
            },
            {
                data: 'nominal'
            },
            {
                data: 'no_rek_belanja'
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
</script>

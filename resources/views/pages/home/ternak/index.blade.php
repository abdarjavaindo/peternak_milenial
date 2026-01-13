<x-layouts.home>
    <section class="section mt-60">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <ul class="nav nav-pills nav-justified flex-column flex-sm-row rounded">
                        <li class="nav-item">
                            <a class="nav-link rounded border border-1 border-dark {{ request()->segment(1) == 'userprofile' ? 'bg-dark' : 'bg-white' }}"
                                href="{{ route('userprofile.edit') }}">
                                <div class="text-center py-2">
                                    <h6 class="mb-0 {{ request()->segment(1) == 'userprofile' ? 'text-white' : '' }}">
                                        Profil Peternak</h6>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link rounded border border-1 border-dark {{ request()->segment(1) == 'daftar-ternak' ? 'bg-dark' : 'bg-white' }}"
                                href="{{ route('ternak') }}">
                                <div class="text-center py-2">
                                    <h6 class="mb-0 {{ request()->segment(1) == 'daftar-ternak' ? 'text-white' : '' }}">
                                        Ternak yang Dimiliki</h6>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            @if ($ternak->count() < 1)
                <div class="alert alert-warning" role="alert">
                    Anda harus mendaftarkan ternak yang anda miliki sebelum menjual produk, mendaftar pelatihan dan
                    aktif
                    dalam forum peternak
                </div>
            @endif

            <x-flash-message></x-flash-message>
            <div class="card">
                <div class="card-body">
                    <div class="card-description" align="left">

                    </div>
                    <div class="card-description">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Daftar Ternak yang Dimiliki</h4>
                            </div>
                            <div class="col-lg-6" align="right">
                                <a href="{{ route('ternak.create') }}" class="btn text-white"
                                    style="background-color: #165d7d">
                                    Tambah Ternak
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="_table" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center">Hewan</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Jumlah Per Ekor</th>
                                    <th class="text-center" width="30%">Aksi</th>
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
</x-layouts.home>

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
            url: "{{ route('ternak.loaddata') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [{
            data: 'DT_RowIndex'
        },
        {
            data: 'nama_ternak'
        },
        {
            data: 'kategori'
        },
        {
            data: 'jumlah'
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

    $(document).on('click', '.delete-button', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: 'Hapus Ternak?',
            text: 'Apakah Anda yakin ingin menghapus data ternak ini?',
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
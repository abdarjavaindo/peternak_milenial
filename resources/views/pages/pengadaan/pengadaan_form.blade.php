<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
<x-layouts.dashboard>
    <h1 class="app-page-title">{{ isset($pengadaan) ? 'Edit' : 'Tambah' }} Vendor</h1>

    <section class="section">
        <x-flash-message></x-flash-message>
        <div class="col-12 col-md-10">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form" method="POST"
                        action="{{ isset($pengadaan) ? route('pengadaan.update', $pengadaan->id) : route('pengadaan.store') }}">
                        @csrf
                        @if (isset($pengadaan))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="vendor_id" class="form-label">Nama Vendor <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <select class="form-select" id="basic-usage" name="vendor_id">
                                <option>Pilih ..</option>
                                @foreach ($data_vendor as $v)
                                    <option value="{{ $v->id }}">{{ $v->nama_vendor }}</option>
                                @endforeach
                            </select>
                            @error('vendor_id')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ isset($pengadaan) ? $pengadaan->tanggal : old('tanggal') }}" required>
                            @error('tanggal')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="nominal" name="nominal"
                                value="{{ isset($pengadaan) ? $pengadaan->nominal : old('nominal') }}" required>
                            @error('nominal')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_rek_belanja" class="form-label">No Rekening Bank <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="no_rek_belanja" name="no_rek_belanja"
                                value="{{ isset($pengadaan) ? $pengadaan->no_rek_belanja : old('no_rek_belanja') }}"
                                required>
                            @error('no_rek_belanja')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bank" class="form-label">Nama Bank <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="bank" name="bank"
                                value="{{ isset($pengadaan) ? $pengadaan->bank : old('bank') }}" required>
                            @error('bank')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pemilik_no_rek" class="form-label">Pemilik Nomor Rekening <span
                                    class="text-danger"><i>(required)</i></span></label>
                            <input type="text" class="form-control" id="pemilik_no_rek" name="pemilik_no_rek"
                                value="{{ isset($pengadaan) ? $pengadaan->pemilik_no_rek : old('pemilik_no_rek') }}"
                                required>
                            @error('pemilik_no_rek')
                                <span class="text-danger" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="uraian" class="form-label">Uraian</label>
                            <textarea id="tinymce-editor" name="uraian">{!! isset($pengadaan) ? $pengadaan->uraian : old('uraian') !!}</textarea>
                        </div>

                        <div class="" align="right">
                            <a href="{{ route('vendor') }}" class="btn btn-light text-black">Kembali</a>
                            <button type="submit" class="btn text-white"
                                style="background-color: #165d7d">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.dashboard>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets') }}/tinymce/tinymce.min.js"></script>
<script>
    $('#basic-usage').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
</script>
<script>
    tinymce.init({
        selector: "#tinymce-editor",
        plugins: "media code table link",
        toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code table",
        menubar: false,
        statusbar: false,
        urlconverter_callback: 'myCustomURLConverter',
        content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
        height: 400,
        valid_children: '+body[style]', // Izinkan atribut tertentu
        setup: function(editor) {
            editor.on('init', function() {
                console.log('TinyMCE Initialized');
            });
            editor.on('Error', function(e) {
                console.error('TinyMCE Error:', e);
            });
        }
    });
</script>

<script>
    var harga_per_jam = document.getElementById("nominal");
    harga_per_jam.addEventListener("keyup", function(e) {
        harga_per_jam.value = formatRupiah(this.value, "");
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? rupiah : "";
    }
</script>

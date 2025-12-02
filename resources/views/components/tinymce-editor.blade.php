<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets') }}/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: "#tinymce-editor",
        plugins: "media code table link",
        toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code table link image_upload",
        menubar: false,
        statusbar: false,
        urlconverter_callback: 'myCustomURLConverter',
        height: 400,

        image_advtab: true,
        image_dimensions: false,
        object_resizing: false,

        content_style: `
            .mce-content-body { font-size: 15px; font-family: Arial, sans-serif; }
            img { max-width: 120px; height: auto; }
        `, // Gabungkan dua style

        // Konfigurasi Upload Gambar
        images_upload_url: "{{ route('upload.image') }}",
        images_upload_handler: function(blobInfo, success, failure) {
            let formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            fetch("{{ route('upload.image') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(result => {
                    if (result.location) {
                        success(result.location); // URL gambar berhasil dikembalikan dari Laravel
                    } else {
                        failure('Gagal mengunggah gambar');
                    }
                })
                .catch(() => {
                    failure('Terjadi kesalahan saat mengunggah gambar');
                });
        },

        setup: function(ed) {

            ed.on('BeforeSetContent', function(e) {
                e.content = e.content.replace(/<img /g,
                    '<img style="max-width:120px; height:auto;" ');
            });

            ed.on('PostProcess', function(e) {
                if (e.set) {
                    e.content = e.content.replace(/<img /g,
                        '<img style="max-width:120px; height:auto;" ');
                }
            });

            var fileInput = $(
                '<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">'
            );
            $(ed.getElement()).parent().append(fileInput);

            fileInput.on("change", function() {
                var file = this.files[0];
                var formData = new FormData();
                formData.append("file", file);
                formData.append("_token", "{{ csrf_token() }}"); // Tambahkan CSRF Token

                $.ajax({
                    url: "{{ route('upload.image') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.location) {
                            ed.insertContent('<img src="' + response.location + '"/>');
                        }
                    },
                    error: function() {
                        alert("Gagal mengunggah gambar.");
                    }
                });
            });

            ed.addButton('image_upload', {
                tooltip: 'Upload Image',
                text: 'Klik 2x',
                icon: 'image',
                onclick: function() {
                    fileInput.trigger('click');
                }
            });
        }
    });


    function myCustomURLConverter(url, node, on_save, name) {
        // Do some custom URL conversion
        if (name == "src") {
            url = url
        }
        // Return new URL
        return url;
    }
</script>

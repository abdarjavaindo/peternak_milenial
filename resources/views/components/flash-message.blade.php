@if (session('sukses'))
<div class="alert alert-success fade show" role="alert">
    <strong>{{ session('sukses') }}</strong>
</div>
@elseif(session('gagal'))
<div class="alert alert-danger fade show" role="alert">
    <strong>{{ session('gagal') }}</strong>
</div>
@endif

<div>
    @if (session('success'))
        <div id="bootstrap-alert" class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @elseif (session('warning'))
        <div id="bootstrap-warning-alert" class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @elseif (session('danger'))
        <div id="bootstrap-danger-alert" class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif
</div>

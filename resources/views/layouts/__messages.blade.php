<div class="row">
    <div class="col-lg-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-all me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-block-helper me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        @if (session('success_demande'))
            <div class="col-lg-12">
                <div class="card bg-success text-white-50">
                    <div class="card-body">
                        <h5 class="mb-4 text-white"><i class="mdi mdi-check-all me-3"></i> Succès</h5>
                        <p class="card-text">{{ session('success_demande') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

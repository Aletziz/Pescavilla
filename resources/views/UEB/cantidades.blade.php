<div id="contenedor">
    <main class="container-fluid min-vh-100 pb-2">
        <header class="row mb-3 p-3 bg-white border-bottom position-sticky top-0" style="z-index: 1020;">
            <div class="col d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-4">
                    <a href="{{ route('UEB.index') }}" id="link-back-ueb" class="header-link-light">
                        UEB
                    </a>
                    <a href="{{ route('UEB.cantidades') }}" id="link-ueb-cantidades" class="header-link-light active">
                        Cantidades
                    </a>
                </div>
                <div class="search-box">
                    <input type="text" id="search-ueb" class="form-control form-control-sm" placeholder="Buscar UEBs..." style="min-width: 250px;">
                </div>
            </div>
        </header>
        <div class="row mb-2 d-flex align-items-start">
            <div class="col-12">
                <div class="card shadow card-scroll">
                    <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Cantidades de embalses por UEB</h5>
                    </div>
                    <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                            <th>#</th>
                            <th>Nombre UEB</th>
                            <th>Cantidad Embalses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($uebs as $ueb)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ueb->nombre }}</td>
                                <td>{{ $ueb->embalses->count() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No hay datos disponibles</td>
                            </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
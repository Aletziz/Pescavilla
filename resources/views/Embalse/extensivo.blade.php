<div id="contenedor">
    <main class="container-fluid min-vh-100 pb-2">
        <header class="row mb-3 p-3 bg-white border-bottom position-sticky top-0" style="z-index: 1020;">
            <div class="col d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-4">
                    <a href="{{ route('Embalse.index') }}" id="link-embalse-home" class="header-link-light">
                        Embalses
                    </a>
                    <div class="dropdown">
                        <button class="header-dropdown-btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cultivo
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="margin-left: 4px;">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                            </svg>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active" href="{{ route('Embalse.extensivo') }}">Extensivo</a></li>
                            <li><a class="dropdown-item" href="{{ route('Embalse.intensivo') }}">Intensivo</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="header-dropdown-btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tipo
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="margin-left: 4px;">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                            </svg>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('Embalse.presa') }}">Presa</a></li>
                            <li><a class="dropdown-item" href="{{ route('Embalse.micropresa') }}">Micropresa</a></li>
                        </ul>
                    </div>
                </div>
                <div class="search-box">
                    <input type="text" id="search-embalse" class="form-control form-control-sm" placeholder="Buscar embalses..." style="min-width: 250px;">
                </div>
            </div>
        </header>
        <div class="row mb-2 d-flex align-items-center">
            <div class="col">
                <div class="card shadow card-scroll">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Embalses con Cultivo Extensivo</h5>
                        <nav class="nav d-flex justify-content-end gap-2">
                            <div class="dropdown">
                                <button class="nav-link action-chip-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-sort-down me-1"></i>
                                    <span>Ordenar</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                                    <li><h6 class="dropdown-header">Ordenar por:</h6></li>
                                    <li><a class="dropdown-item sort-option" href="#" data-column="nombre" data-type="text">Nombre</a></li>
                                    <li><a class="dropdown-item sort-option" href="#" data-column="ueb" data-type="text">UEB</a></li>
                                    <li><a class="dropdown-item sort-option" href="#" data-column="area" data-type="number">Área (m²)</a></li>
                                    <li><a class="dropdown-item sort-option" href="#" data-column="municipio" data-type="text">Municipio</a></li>
                                    <li><a class="dropdown-item sort-option" href="#" data-column="profundidad" data-type="number">Profundidad (m)</a></li>
                                    <li><a class="dropdown-item sort-option" href="#" data-column="volumen" data-type="number">Volumen (m³)</a></li>
                                    <li><a class="dropdown-item sort-option" href="#" data-column="tipo_embalse" data-type="text">Tipo Embalse</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-0 sortable-table table-sm" data-table="embalse" style="font-size: 0.875rem;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 40px;">#</th>
                                        <th data-column="nombre" style="min-width: 150px;">Nombre</th>
                                        <th data-column="ueb" style="min-width: 120px;">UEB</th>
                                        <th data-column="area" data-type="number" style="width: 110px;">Área (m²)</th>
                                        <th data-column="municipio" style="min-width: 100px;">Municipio</th>
                                        <th data-column="profundidad" data-type="number" style="width: 110px;">Profundidad (m)</th>
                                        <th data-column="volumen" data-type="number" style="width: 120px;">Volumen (m³)</th>
                                        <th data-column="tipo_embalse" style="width: 100px;">Tipo Embalse</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($embalses as $embalse)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $embalse->nombre }}</td>
                                        <td>{{ $embalse->ueb->nombre ?? 'N/A' }}</td>
                                        <td>{{ $embalse->area ? number_format($embalse->area, 2) : 'N/A' }}</td>
                                        <td>{{ $embalse->municipio ?? 'N/A' }}</td>
                                        <td>{{ $embalse->profundidad_media ? number_format($embalse->profundidad_media, 2) : 'N/A' }}</td>
                                        <td>{{ $embalse->volumen ? number_format($embalse->volumen, 2) : 'N/A' }}</td>
                                        <td>
                                            @if($embalse->tipo_embalse)
                                                <span class="badge bg-primary">
                                                    {{ ucfirst($embalse->tipo_embalse) }}
                                                </span>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No hay embalses con cultivo extensivo</td>
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

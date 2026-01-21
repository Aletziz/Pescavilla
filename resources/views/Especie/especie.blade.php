<div id="contenedor">
    <main class="container-fluid min-vh-100 pb-2">
        <header class="row mb-3 p-3 bg-white border-bottom position-sticky top-0" style="z-index: 1020;">
            <div class="col d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-4">
                    <a href="{{ route('Especie.index') }}" id="link-especie-home" class="header-link-light active">
                        Especies
                    </a>
                </div>
                <div class="search-box">
                    <input type="text" id="search-especie" class="form-control form-control-sm" placeholder="Buscar especies..." style="min-width: 250px;">
                </div>
            </div>
        </header>
        <div class="row mb-2 d-flex align-items-center">
            <div class="col">
                <div class="card shadow card-scroll">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Listado de especies</h5>
                        <nav class="nav d-flex justify-content-end gap-2">
                            <div class="dropdown">
                                <button class="nav-link action-chip-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-sort-down me-1"></i>
                                    <span>Ordenar</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                                    <li><h6 class="dropdown-header">Ordenar por:</h6></li>
                                    <li><a class="dropdown-item sort-option" href="#" data-column="nombre" data-type="text">Nombre</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('Especie.create') }}" class="nav-link action-chip-primary">
                                <span>Agregar</span>
                            </a>
                        </nav>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered mb-0 sortable-table" data-table="especie" style="font-size: 0.875rem;">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th data-column="nombre">Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($especies as $especie)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $especie->nombre }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('Especie.edit', $especie->id) }}" class="btn btn-sm btn-warning p-1" title="Editar" style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('Especie.destroy', $especie->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar esta especie?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger p-1" title="Eliminar" style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No hay especies registradas</td>
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
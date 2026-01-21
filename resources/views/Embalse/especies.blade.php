@extends('layouts.app')

@section('title', 'Gestionar Especies')

@section('content')
<div id="contenedor">
    <main class="container-fluid min-vh-100 pb-2">
        <header class="row mb-3 p-3 bg-dark position-sticky top-0 shadow z-3">
            <div class="col-6 d-flex justify-content-start align-items-start fs-3">
                <a href="{{ route('Embalse.index') }}" class="nav-link">←</a>
            </div>
            <div class="col d-flex justify-content-center align-items-center fs-3">
                <span>Gestionar Especies</span>
            </div>
        </header>
        
        <div class="row mb-2">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-dark">
                        <h5 class="mb-0">Especies del Embalse: {{ $embalse->nombre }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulario para agregar especie -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Agregar Nueva Especie</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('Embalse.attachEspecie', $embalse->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-10 mb-3">
                                            <label for="especie_id" class="form-label">Especie</label>
                                            <select class="form-select @error('especie_id') is-invalid @enderror" 
                                                    id="especie_id" name="especie_id" required>
                                                <option value="">Seleccione una especie</option>
                                                @foreach($todasEspecies as $especie)
                                                    <option value="{{ $especie->id }}" {{ old('especie_id') == $especie->id ? 'selected' : '' }}>
                                                        {{ $especie->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('especie_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-2 mb-3 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary w-100">Agregar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Tabla de especies asignadas -->
                        <h6 class="mt-4 mb-3">Especies Asignadas</h6>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Fecha Inicio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($embalse->especies as $especie)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $especie->nombre }}</td>
                                        <td>{{ $especie->pivot->fecha_inicio ?? 'N/A' }}</td>
                                        <td>
                                            <form action="{{ route('Embalse.detachEspecie', [$embalse->id, $especie->id]) }}" 
                                                  method="POST" 
                                                  style="display: inline;" 
                                                  onsubmit="return confirm('¿Estás seguro de remover esta especie?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Remover">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No hay especies asignadas a este embalse</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('Embalse.index') }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

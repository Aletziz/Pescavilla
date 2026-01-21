@extends('layouts.app')

@section('title', 'Editar Especie')

@section('content')
<div id="contenedor">
    <main class="container-fluid min-vh-100 pb-2">
        <header class="row mb-3 p-3 bg-dark position-sticky top-0 shadow z-3">
            <div class="col-6 d-flex justify-content-start align-items-start fs-3">
                <a href="{{ route('Especie.index') }}" class="nav-link">←</a>
            </div>
            <div class="col d-flex justify-content-end align-items-center fs-3">
                <span>Editar Especie</span>
            </div>
        </header>
        
        <div class="row mb-2">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-dark">
                        <h5 class="mb-0">Editar Especie: {{ $especie->nombre }}</h5>
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

                        <form action="{{ route('Especie.update', $especie->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre', $especie->nombre) }}" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="{{ route('Especie.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

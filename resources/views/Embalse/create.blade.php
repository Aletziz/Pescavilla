@extends('layouts.app')

@section('title', 'Nuevo Embalse')

@section('content')
<div id="contenedor">
    <main class="container-fluid min-vh-100 pb-2">
        <header class="row mb-3 p-3 bg-dark position-sticky top-0 shadow z-3">
            <div class="col-6 d-flex justify-content-start align-items-start fs-3">
                <a href="{{ route('Embalse.index') }}" class="nav-link">←</a>
            </div>
            <div class="col d-flex justify-content-center align-items-center fs-3">
                <span>Nuevo Embalse</span>
            </div>
        </header>
        
        <div class="row mb-2">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-dark">
                        <h5 class="mb-0">Crear Nuevo Embalse</h5>
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

                        <form action="{{ route('Embalse.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ueb_id" class="form-label">UEB</label>
                                <select class="form-select @error('ueb_id') is-invalid @enderror" 
                                        id="ueb_id" name="ueb_id" required>
                                    <option value="">Seleccione una UEB</option>
                                    @foreach($uebs as $ueb)
                                        <option value="{{ $ueb->id }}" {{ old('ueb_id') == $ueb->id ? 'selected' : '' }}>
                                            {{ $ueb->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ueb_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="area" class="form-label">Área (m²)</label>
                                <input type="number" step="0.01" class="form-control @error('area') is-invalid @enderror" 
                                       id="area" name="area" value="{{ old('area') }}">
                                @error('area')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="volumen" class="form-label">Volumen (m³)</label>
                                <input type="number" step="0.01" class="form-control @error('volumen') is-invalid @enderror" 
                                       id="volumen" name="volumen" value="{{ old('volumen') }}">
                                @error('volumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cantidad_arroyo" class="form-label">Cantidad de Arroyos</label>
                                <input type="number" class="form-control @error('cantidad_arroyo') is-invalid @enderror" 
                                       id="cantidad_arroyo" name="cantidad_arroyo" value="{{ old('cantidad_arroyo') }}">
                                @error('cantidad_arroyo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="municipio" class="form-label">Municipio</label>
                                <select class="form-select @error('municipio') is-invalid @enderror" 
                                        id="municipio" name="municipio" required>
                                    <option value="" {{ old('municipio') == '' ? 'selected' : '' }}>Seleccione un municipio</option>
                                    <option value="Camajuaní" {{ old('municipio') == 'Camajuaní' ? 'selected' : '' }}>Camajuaní</option>
                                    <option value="Caibarién" {{ old('municipio') == 'Caibarién' ? 'selected' : '' }}>Caibarién</option>
                                    <option value="Cifuentes" {{ old('municipio') == 'Cifuentes' ? 'selected' : '' }}>Cifuentes</option>
                                    <option value="Corralillo" {{ old('municipio') == 'Corralillo' ? 'selected' : '' }}>Corralillo</option>
                                    <option value="Encrucijada" {{ old('municipio') == 'Encrucijada' ? 'selected' : '' }}>Encrucijada</option>
                                    <option value="Manicaragua" {{ old('municipio') == 'Manicaragua' ? 'selected' : '' }}>Manicaragua</option>
                                    <option value="Placetas" {{ old('municipio') == 'Placetas' ? 'selected' : '' }}>Placetas</option>
                                    <option value="Quemado de Güines" {{ old('municipio') == 'Quemado de Güines' ? 'selected' : '' }}>Quemado de Güines</option>
                                    <option value="Ranchuelo" {{ old('municipio') == 'Ranchuelo' ? 'selected' : '' }}>Ranchuelo</option>
                                    <option value="Remedios" {{ old('municipio') == 'Remedios' ? 'selected' : '' }}>Remedios</option>
                                    <option value="Sagua la Grande" {{ old('municipio') == 'Sagua la Grande' ? 'selected' : '' }}>Sagua la Grande</option>
                                    <option value="Santa Clara" {{ old('municipio') == 'Santa Clara' ? 'selected' : '' }}>Santa Clara</option>
                                    <option value="Santo Domingo" {{ old('municipio') == 'Santo Domingo' ? 'selected' : '' }}>Santo Domingo</option>
                                </select>
                                @error('municipio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tipo_embalse" class="form-label">Tipo de Embalse</label>
                                <select class="form-select @error('tipo_embalse') is-invalid @enderror" 
                                        id="tipo_embalse" name="tipo_embalse">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="presa" {{ old('tipo_embalse') == 'presa' ? 'selected' : '' }}>Presa</option>
                                    <option value="micropresa" {{ old('tipo_embalse') == 'micropresa' ? 'selected' : '' }}>Micropresa</option>
                                </select>
                                @error('tipo_embalse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tipo_cultivo" class="form-label">Tipo de Cultivo</label>
                                <select class="form-select @error('tipo_cultivo') is-invalid @enderror" 
                                        id="tipo_cultivo" name="tipo_cultivo">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="intensivo" {{ old('tipo_cultivo') == 'intensivo' ? 'selected' : '' }}>Intensivo</option>
                                    <option value="extensivo" {{ old('tipo_cultivo') == 'extensivo' ? 'selected' : '' }}>Extensivo</option>
                                </select>
                                @error('tipo_cultivo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{ route('Embalse.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

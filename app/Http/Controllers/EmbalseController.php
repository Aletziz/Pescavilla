<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Embalse;
use App\Models\UEB;
use App\Models\Especie;
use Illuminate\Http\Request;

class EmbalseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $embalses = Embalse::with('ueb')->get();
        
        if (request()->ajax() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('Embalse.embalse', compact('embalses'));
        }
        
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uebs = UEB::all();
        return view('Embalse.create', compact('uebs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ueb_id' => 'required|exists:u_e_b_s,id',
            'area' => 'nullable|numeric|min:0',
            'municipio' => 'nullable|string|max:255',
            'cantidad_arroyo' => 'nullable|integer|min:0',
            'volumen' => 'nullable|numeric|min:0',
            'tipo_cultivo' => 'nullable|in:intensivo,extensivo,semiintensivo',
            'tipo_embalse' => 'nullable|in:presa,micropresa'
        ]);

        // Calcular profundidad_media: volumen (m³) / area (m²)
        if (isset($validated['volumen']) && isset($validated['area']) && $validated['area'] > 0) {
            $validated['profundidad_media'] = $validated['volumen'] / ($validated['area'] * 100);
        }

        $embalse = Embalse::create($validated);

        return redirect()->route('Embalse.index')
            ->with('success', 'Embalse creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $embalse = Embalse::with('ueb')->findOrFail($id);
        
        return view('Embalse.show', compact('embalse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $embalse = Embalse::findOrFail($id);
        $uebs = UEB::all();
        
        return view('Embalse.edit', compact('embalse', 'uebs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $embalse = Embalse::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ueb_id' => 'required|exists:u_e_b_s,id',
            'area' => 'nullable|numeric|min:0',
            'municipio' => 'nullable|string|max:255',
            'cantidad_arroyo' => 'nullable|integer|min:0',
            'volumen' => 'nullable|numeric|min:0',
            'tipo_cultivo' => 'nullable|in:intensivo,extensivo,semiintensivo',
            'tipo_embalse' => 'nullable|in:presa,micropresa'
        ]);

        // Calcular profundidad_media: volumen (m³) / area (m²)
        if (isset($validated['volumen']) && isset($validated['area']) && $validated['area'] > 0) {
            $validated['profundidad_media'] = $validated['volumen'] / $validated['area'];
        }

        $embalse->update($validated);

        return redirect()->route('Embalse.index')
            ->with('success', 'Embalse actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $embalse = Embalse::findOrFail($id);
        $embalse->delete();

        return redirect()->route('Embalse.index')
            ->with('success', 'Embalse eliminado exitosamente.');
    }

    /**
     * Show the form for managing especies for the embalse.
     */
    public function especies(string $id)
    {
        $embalse = Embalse::with(['especies' => function($query) {
            $query->withPivot('fecha_inicio');
        }])->findOrFail($id);
        
        $todasEspecies = Especie::all();
        
        return view('Embalse.especies', compact('embalse', 'todasEspecies'));
    }

    /**
     * Attach a especie to the embalse.
     */
    public function attachEspecie(Request $request, string $id)
    {
        $embalse = Embalse::findOrFail($id);
        
        $validated = $request->validate([
            'especie_id' => 'required|exists:especies,id'
        ]);

        // Verificar si la especie ya está asignada
        if ($embalse->especies()->where('especie_id', $validated['especie_id'])->exists()) {
            return redirect()->back()
                ->with('error', 'Esta especie ya está asignada a este embalse.');
        }

        // Asignar automáticamente la fecha de inicio como la fecha actual
        $embalse->especies()->attach($validated['especie_id'], [
            'fecha_inicio' => now()->toDateString()
        ]);

        return redirect()->back()
            ->with('success', 'Especie asignada exitosamente.');
    }

    /**
     * Detach a especie from the embalse.
     */
    public function detachEspecie(string $embalseId, string $especieId)
    {
        $embalse = Embalse::findOrFail($embalseId);
        $embalse->especies()->detach($especieId);

        return redirect()->back()
            ->with('success', 'Especie removida exitosamente.');
    }

    /**
     * Display table for extensivo embalses.
     */
    public function extensivo()
    {
        $embalses = Embalse::with('ueb')
            ->where('tipo_cultivo', 'extensivo')
            ->get();
        
        if (request()->ajax() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('Embalse.extensivo', compact('embalses'));
        }
        
        return view('index');
    }

    /**
     * Display table for intensivo embalses.
     */
    public function intensivo()
    {
        $embalses = Embalse::with('ueb')
            ->where('tipo_cultivo', 'intensivo')
            ->get();
        
        if (request()->ajax() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('Embalse.intensivo', compact('embalses'));
        }
        
        return view('index');
    }

    /**
     * Display table for presa type embalses.
     */
    public function presa()
    {
        $embalses = Embalse::with('ueb')
            ->where('tipo_embalse', 'presa')
            ->get();
        
        if (request()->ajax() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('Embalse.presa', compact('embalses'));
        }
        
        return view('index');
    }

    /**
     * Display table for micropresa type embalses.
     */
    public function micropresa()
    {
        $embalses = Embalse::with('ueb')
            ->where('tipo_embalse', 'micropresa')
            ->get();
        
        if (request()->ajax() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('Embalse.micropresa', compact('embalses'));
        }
        
        return view('index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Especie;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especies = Especie::all();
        
        if (request()->ajax() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('Especie.especie', compact('especies'));
        }
        
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Especie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $especie = Especie::create($validated);

        return redirect()->route('Especie.index')
            ->with('success', 'Especie creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $especie = Especie::findOrFail($id);
        
        return view('Especie.show', compact('especie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $especie = Especie::findOrFail($id);
        
        return view('Especie.edit', compact('especie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $especie = Especie::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $especie->update($validated);

        return redirect()->route('Especie.index')
            ->with('success', 'Especie actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $especie = Especie::findOrFail($id);
        $especie->delete();

        return redirect()->route('Especie.index')
            ->with('success', 'Especie eliminada exitosamente.');
    }
}

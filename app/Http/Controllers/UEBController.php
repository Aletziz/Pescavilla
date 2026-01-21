<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UEB;
use Illuminate\Http\Request;

class UEBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uebs = UEB::with('embalses')->get();
        
        if (request()->ajax() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('UEB.ueb', compact('uebs'));
        }
        
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('UEB.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $ueb = UEB::create($validated);

        return redirect()->route('UEB.index')
            ->with('success', 'UEB creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ueb = UEB::with('embalses')->findOrFail($id);
        
        return view('UEB.show', compact('ueb'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ueb = UEB::findOrFail($id);
        
        return view('UEB.edit', compact('ueb'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ueb = UEB::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $ueb->update($validated);

        return redirect()->route('UEB.index')
            ->with('success', 'UEB actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ueb = UEB::findOrFail($id);
        $ueb->delete();

        return redirect()->route('UEB.index')
            ->with('success', 'UEB eliminada exitosamente.');
    }

    /**
     * Display the cantidades table.
     */
    public function cantidades()
    {
        $uebs = UEB::with('embalses')->get();
        
        if (request()->ajax() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('UEB.cantidades', compact('uebs'));
        }
        
        return view('index');
    }
}

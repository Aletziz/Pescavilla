<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UEBController;
use App\Http\Controllers\EmbalseController;
use App\Http\Controllers\EspecieController;

Route::get('/', function () {
    return view('index');
});

// Rutas de recursos para UEB
Route::get('ueb/cantidades/tabla', [UEBController::class, 'cantidades'])->name('UEB.cantidades');
Route::resource('ueb', UEBController::class)->names('UEB');

// Rutas personalizadas de Embalse (DEBEN ir ANTES del resource)
Route::get('embalse-extensivo', [EmbalseController::class, 'extensivo'])->name('Embalse.extensivo');
Route::get('embalse-intensivo', [EmbalseController::class, 'intensivo'])->name('Embalse.intensivo');
Route::get('embalse-presa', [EmbalseController::class, 'presa'])->name('Embalse.presa');
Route::get('embalse-micropresa', [EmbalseController::class, 'micropresa'])->name('Embalse.micropresa');

// Rutas para gestionar especies de un embalse
Route::get('embalse/{id}/especies', [EmbalseController::class, 'especies'])->name('Embalse.especies');
Route::post('embalse/{id}/especies', [EmbalseController::class, 'attachEspecie'])->name('Embalse.attachEspecie');
Route::delete('embalse/{embalse}/especies/{especie}', [EmbalseController::class, 'detachEspecie'])->name('Embalse.detachEspecie');

// Rutas de recursos para Embalse
Route::resource('embalse', EmbalseController::class)->names('Embalse');

// Rutas de recursos para Especie
Route::resource('especie', EspecieController::class)->names('Especie');

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    /**
     * Relación: Una Especie se cultiva en muchos Embalses (many-to-many)
     */
    public function embalses()
    {
        return $this->belongsToMany(Embalse::class, 'cultivan', 'especie_id', 'embalse_id')
            ->withPivot('fecha_inicio')
            ->withTimestamps();
    }
}

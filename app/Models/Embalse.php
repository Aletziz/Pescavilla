<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embalse extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'ueb_id',
        'area',
        'municipio',
        'profundidad_media',
        'cantidad_arroyo',
        'volumen',
        'tipo_cultivo',
        'tipo_embalse'
    ];

    protected $casts = [
        'area' => 'decimal:2',
        'profundidad_media' => 'decimal:2',
        'volumen' => 'decimal:2'
    ];

    /**
     * Relación: Un Embalse pertenece a una UEB
     */
    public function ueb()
    {
        return $this->belongsTo(UEB::class, 'ueb_id');
    }

    /**
     * Relación: Un Embalse cultiva muchas Especies (many-to-many)
     */
    public function especies()
    {
        return $this->belongsToMany(Especie::class, 'cultivan', 'embalse_id', 'especie_id')
            ->withPivot('fecha_inicio')
            ->withTimestamps();
    }
}

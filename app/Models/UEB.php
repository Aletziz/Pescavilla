<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UEB extends Model
{
    use HasFactory;

    protected $table = 'u_e_b_s';

    protected $fillable = [
        'nombre'
    ];

    /**
     * Relación: Una UEB tiene muchos Embalses
     */
    public function embalses()
    {
        return $this->hasMany(Embalse::class, 'ueb_id');
    }
}

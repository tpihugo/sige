<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modulos extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'icono', 'color','nombre_permiso','orden'];

    public function enlaces(): HasMany
    {
        return $this->hasMany(EnlaceModulos::class, 'modulo_id', 'id')->where('activo',1);
    }
}

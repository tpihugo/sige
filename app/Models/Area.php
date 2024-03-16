<?php

namespace App\Models;

use App\Models\VsEquipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';

    public function inventario()
    {
        return $this->hasMany(InventarioDetalle::class, 'id_area', 'id')->select('id', 'id_equipo', 'id_area', 'inventario', 'estatus')->whereRelation(
            'equipo',
            'tipo_sici',
            '=',
            'equipoCTA'
        )->where('inventario', '=', '2024A');
    }

    public function getTotalEquipoAttribute()
    {
        $equipos = VsEquipo::where('activo', 1)->where('id_area', $this->id)->count();
        return $equipos;
    }
    public function getEquiposAttribute()
    {
        $equipos = VsEquipo::where('activo', 1)->where('id_area', $this->id)->get();
        return $equipos;
    }
}

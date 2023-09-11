<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioDetalle extends Model
{
    use HasFactory;
    protected $table = 'inventario_detalles';



    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo', 'id');
    }


    public function area_equipo()
    {
        return $this->belongsTo(Area::class, 'id_area', 'id');
    }

    public function getTipoAttribute($equipo)
    {

        return $equipo->tipo_sici;
    }
}

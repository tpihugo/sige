<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $table = 'equipos';
    

    public function inventario()
    {
        return $this->belongsTo(InventarioDetalle::class, 'id', 'id_equipo');
    }

    public function getUltimoInventarioAttribute()
    {
        if(isset($this->inventario)){
            return $this->inventario->inventario;
        }
        return null;
    }

    public function getAreaAttribute()
    {
        if(isset($this->inventario)){
            return  $this->inventario->id_area;
        }
        return null;
    }
    
}

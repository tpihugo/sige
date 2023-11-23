<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficios extends Model
{
    use HasFactory;

    public function getHorasAttribute()
    {
        $total = 0;
        if (strcmp('Practicas Profecionales', $this->tipo_prestacion) == 0) {
            return 280;
        }else if(strcmp('Servicio Social', $this->tipo_prestacion) == 0){
            return 480;
        }
        return $total;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Personal extends Model
{
    use HasFactory, HasRoles;
    protected $table = 'nuevo_personal';

    public function getHorarioAttribute($value)
    {
        $horario = [$this->lunes, $this->martes, $this->miercoles, $this->jueves, $this->viernes, $this->sabado];
        return implode(",", $horario);
    }
}

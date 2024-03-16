<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class EnlaceModulos extends Model
{
    use HasFactory;
    protected $fillable = ['enlace', 'modulo_id', 'titulo', 'estilos', 'parametro'];
}

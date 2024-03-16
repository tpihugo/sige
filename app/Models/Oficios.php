<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficios extends Model
{
    use HasFactory;
    protected $appends = ['anio'];

    protected $fillable = [
        'num_oficio',
        'asunto',
        'dirigido',
        'asunto',
        'atencion',
        'centro_universitario',
        'cuerpo'
    ];
    public function getAnioAttribute()
    {
        return $this->created_at->format('Y');
    }
    protected $casts = [
        'created_at' => 'datetime:Y',
    ];
}

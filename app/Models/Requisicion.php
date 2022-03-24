<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'requisiciones';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    use HasFactory;

    // Define los campos que son asignables
    protected $table = 'tipo_actividad';
    protected $fillable = ['nombre', 'precio', 'tipo'];
}

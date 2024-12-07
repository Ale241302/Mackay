<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    // Define los campos que son asignables
    protected $table = 'tipo_documento';
    protected $fillable = ['nombre'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MontoHora extends Model
{
    use HasFactory;

    // Define los campos que son asignables
    protected $table = 'monto_hora';
    protected $fillable = ['monto'];
}

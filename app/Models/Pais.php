<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    // Define los campos que son asignables
    protected $table = 'pais';
    protected $fillable = ['nombre'];
}

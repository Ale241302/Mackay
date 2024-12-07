<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tribunal extends Model
{
    use HasFactory;

    // Define los campos que son asignables
    protected $table = 'tribunales';
    protected $fillable = ['nombre', 'ciudad'];
    public function Ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad');
    }
}

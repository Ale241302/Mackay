<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'clientes';
    protected $fillable = [
        'empresa',
        'rut',
        'domicilio',
        'pais',
        'direccion',
        'ciudad',
        'representante',
        'email',
        'estado',
        'telefono',
        'ejecutivo',
        'email2',
        'telefono2',
        'sitio',
        'asegurador',
        'daño',
        'cobrofijo',
        'cobrohora',
        'cobroporciento',
        'casos',
        'finanzas',
        'postal',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento');
    }
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais');
    }
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad');
    }

    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class, 'tipo_usuario');
    }
    public function casos()
    {
        return $this->hasMany(Caso::class, 'empresa', 'id'); // Ajusta 'caso' y 'id' si los nombres de las columnas son diferentes
    }
}

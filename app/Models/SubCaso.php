<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCaso extends Model
{
    use HasFactory;

    // Define los campos que son asignables
    protected $table = 'subcasos';
    protected $fillable = [
        'caso',
        'empresa',
        'empresa_demandante',
        'rut_demandante',
        'email_demandante',
        'telefono_demandante',
        'representante_demandante',
        'domicilio_demandante',
        'referencia_caso',
        'descripcion_caso',
        'asunto_caso',
        'fechai',
        'abogados',
        'tipo_caso',
        'cobrofijo',
        'cobrohora',
        'cobroporciento',
        'rol_caso',
        'nombre_juicio',
        'tribunal',
        'fechait',
        'juez_civil',
        'juez_arbitro',
        'rol_arbitral',
        'tipo_moneda',
        'monto_demanda',
        'monto_hora',
        'actividadesData',
        'documentosData',
        'estado_caso',
        'estado_casoi',
        'bill',
        'demandante',
        'referencia_demandante',
        'etapa_procesal',
        'fecha_fin',
        'usuario',
        'refsub'
    ];
    public function empresa()
    {
        return $this->belongsTo(User::class, 'empresa');
    }
    public function caso()
    {
        return $this->belongsTo(Caso::class, 'caso');
    }
    public function tribunal()
    {
        return $this->belongsTo(Tribunal::class, 'tribunal');
    }
    // En el modelo Caso
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario'); // 'usuario' es el nombre del campo en la tabla 'casos' que almacena el ID del usuario
    }
}

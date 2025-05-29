<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    use HasFactory;

    protected $table = 'documentacion'; // Asegúrate de que esto sea correcto
    protected $fillable = [
        'vehiculo_id',
        'tipo_documento_id',
        
        'entidad_emisora',
    ];
protected $casts = [
    'fecha_expedicion' => 'datetime',
    'fecha_vencimiento' => 'datetime',
];

    public function tipoDocumento()
    {
    return $this->belongsTo(TipoDocumento::class);
    }
}

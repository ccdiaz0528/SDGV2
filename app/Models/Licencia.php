<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_licencia',    // Campo para el número de licencia
          // Campo para la fecha de vencimiento
        'estado',             // Campo para el estado (vigente o no)
    ];

    protected $casts = [
    'fecha_expedicion' => 'datetime',
    'fecha_vencimiento' => 'datetime',
];

    public function categorias()
    {
        return $this->belongsToMany(CategoriaLicencia::class, 'licencia_categoria', 'licencia_id', 'categoria_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

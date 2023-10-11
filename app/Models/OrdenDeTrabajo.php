<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDeTrabajo extends Model
{
    use HasFactory;

    protected $table = 'orden_trabajo';
    protected $fillable = [
        'numero_oc',
        'numero_orden_compra',
        'cliente_id',
        'fecha',
        'id_nombre_producto',
        'cantidad',
        'id_foto',
        'fecha_comprometida',
        'status_oc',
        'porcentaje_progreso',
        'observaciones'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    // Si necesitas especificar la tabla (opcional en este caso):
    // protected $table = 'productos';
    
    protected $fillable = [
        'nombre',
        'material_base',
        'pintura',
        'medida',
        'ancho',
        'observaciones',
        'foto',
    ];
}

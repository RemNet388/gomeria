<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
    'nombre',
    'marca',
    'medida',
    'cantidad',
    'precio_venta',
    'foto',
    'categoria',
    'precio_compra',
        // Agregá más campos si tu tabla tiene otros
    ];
}
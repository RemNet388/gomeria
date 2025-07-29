<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'total', 'tipo'];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}


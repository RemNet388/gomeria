<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReparacionItem extends Model
{
    use HasFactory;
    protected $table = 'reparacion_items';

    protected $fillable = [
        'reparacion_id',
        'tipo',
        'producto_id',
        'servicio_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

 public function reparacion()
{
    return $this->belongsTo(Reparacion::class, 'reparacion_id', 'id');
}


    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}

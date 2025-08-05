<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    protected $fillable = [
        'cliente_id', 'vehiculo_id', 'fecha_ingreso',
        'estado', 'descripcion', 'observaciones', 'total'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
    public function items()
{
    return $this->hasMany(OrdenTrabajoItem::class);
}

}

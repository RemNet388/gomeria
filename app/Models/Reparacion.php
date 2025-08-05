<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    // 🚨 Esta línea es obligatoria
    protected $table = 'reparaciones';

    protected $fillable = [
        'cliente_id',
        'vehiculo_id',
        'estado',
        'fecha_ingreso',
        'descripcion',
        'observaciones',
        'total'
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
        return $this->hasMany(ReparacionItem::class, 'reparacion_id');
    }
}

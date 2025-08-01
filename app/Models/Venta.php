<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['cliente_id', 'forma_pago_id', 'total', 'fecha'];
    
    protected $casts = [
    'fecha' => 'datetime',
];


    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}

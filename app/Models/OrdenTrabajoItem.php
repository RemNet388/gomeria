<?php

// app/Models/OrdenTrabajoItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenTrabajoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_trabajo_id',
        'tipo',
        'producto_id',
        'servicio_id',
        'cantidad',
        'precio',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function orden()
    {
        return $this->belongsTo(OrdenTrabajo::class, 'orden_trabajo_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    //
public function vehiculo()
{
    return $this->belongsTo(Vehiculo::class);
}

}

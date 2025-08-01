<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormaPago;

class FormaPagoSeeder extends Seeder
{
    public function run()
    {
        $formas = ['Efectivo', 'Tarjeta', 'Transferencia'];
        foreach ($formas as $nombre) {
            FormaPago::create(['nombre' => $nombre]);
        }
    }
}


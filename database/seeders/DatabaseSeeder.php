<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
    $this->call([
        FormaPagoSeeder::class,
    ]);
User::create([
    'name' => 'Ruben',
    'email' => 'rubenmachado76@gmail.com',
    'password' => bcrypt('gooNet560'), // importante definir la contraseña
]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorsSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Prata', 'Preto', 'Branco', 'Vermelho', 'Azul'];
        foreach ($names as $name) {
            Color::updateOrCreate(['name' => $name], ['name' => $name]);
        }
    }
}

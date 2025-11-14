<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Toyota', 'Volkswagen', 'Honda', 'Ford', 'Chevrolet'];
        foreach ($names as $name) {
            Brand::updateOrCreate(['name' => $name], ['name' => $name]);
        }
    }
}

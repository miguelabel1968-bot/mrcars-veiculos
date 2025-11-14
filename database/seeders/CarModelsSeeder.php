<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarModel;
use App\Models\Brand;

class CarModelsSeeder extends Seeder
{
    public function run(): void
    {
        $pairs = [
            'Toyota' => ['Corolla', 'Yaris', 'Hilux'],
            'Volkswagen' => ['Golf', 'Polo', 'Nivus'],
            'Honda' => ['Civic', 'Fit', 'HR-V'],
            'Ford' => ['Ka', 'EcoSport', 'Ranger'],
            'Chevrolet' => ['Onix', 'Prisma', 'S10'],
        ];

        foreach ($pairs as $brandName => $models) {
            $brand = Brand::where('name', $brandName)->first();
            if (!$brand) continue;
            foreach ($models as $m) {
                CarModel::updateOrCreate(
                    ['brand_id' => $brand->id, 'name' => $m],
                    ['brand_id' => $brand->id, 'name' => $m]
                );
            }
        }
    }
}

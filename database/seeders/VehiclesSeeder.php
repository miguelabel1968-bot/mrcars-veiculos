<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Color;

class VehiclesSeeder extends Seeder
{
    public function run(): void
    {
        $brand = Brand::where('name', 'Toyota')->first();
        $model = CarModel::where('name', 'Corolla')->where('brand_id', $brand->id)->first();
        $color = Color::where('name', 'Prata')->first();

        if (!$brand || !$model || !$color) return;

        $vehicle = Vehicle::updateOrCreate(
            ['main_photo_url' => 'https://picsum.photos/seed/corolla-main/800/600'],
            [
                'brand_id' => $brand->id,
                'car_model_id' => $model->id,
                'color_id' => $color->id,
                'year' => 2018,
                'mileage' => 62000,
                'price' => 79000.00,
                'description' => 'Toyota Corolla 2018 em ótimo estado.',
                'main_photo_url' => 'https://picsum.photos/seed/corolla-main/800/600',
            ]
        );

        $photos = [
            'https://picsum.photos/seed/corolla-1/800/600',
            'https://picsum.photos/seed/corolla-2/800/600',
            'https://picsum.photos/seed/corolla-3/800/600',
        ];

        foreach ($photos as $url) {
            $vehicle->photos()->updateOrCreate(['url' => $url], ['url' => $url]);
        }
    }
}

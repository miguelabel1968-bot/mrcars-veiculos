<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'car_model_id',
        'color_id',
        'year',
        'mileage',
        'price',
        'description',
        'main_photo_url'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function photos()
    {
        return $this->hasMany(VehiclePhoto::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehiclePhoto extends Model
{
    use HasFactory;

    protected $table = 'vehicle_photos';

    protected $fillable = [
        'vehicle_id',
        'url'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}

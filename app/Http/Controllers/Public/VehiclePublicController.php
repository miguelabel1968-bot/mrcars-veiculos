<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class VehiclePublicController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with(['brand','carModel','color','photos'])
            ->orderBy('created_at','desc')
            ->paginate(12);

        return view('public.vehicles.index', compact('vehicles'));
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load('photos','brand','carModel','color');
        return view('public.vehicles.show', compact('vehicle'));
    }
}

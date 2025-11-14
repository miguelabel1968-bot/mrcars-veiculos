<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Color;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('photos', 'brand', 'carModel', 'color')->paginate(20);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $colors = Color::orderBy('name')->get();
        return view('admin.vehicles.create', compact('brands', 'colors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'brand_id' => ['required','exists:brands,id'],
            'car_model_id' => ['required', Rule::exists('car_models','id')->where(function($query) use ($request) {
                if ($request->brand_id) {
                    $query->where('brand_id', $request->brand_id);
                }
            })],
            'color_id' => ['required','exists:colors,id'],
            'year' => ['required','integer','min:1900','max:' . date('Y')],
            'mileage' => ['required','integer','min:0'],
            'price' => ['required','numeric','min:0'],
            'description' => ['nullable','string'],
            'main_photo_url' => ['required','url'],
            'photos' => ['nullable','array'],
            'photos.*' => ['nullable','url'],
        ]);

        DB::transaction(function() use ($data, $request) {
            $vehicle = Vehicle::create([
                'brand_id' => $data['brand_id'],
                'car_model_id' => $data['car_model_id'],
                'color_id' => $data['color_id'],
                'year' => $data['year'],
                'mileage' => $data['mileage'],
                'price' => $data['price'],
                'description' => $data['description'] ?? null,
                'main_photo_url' => $data['main_photo_url'],
            ]);

            if ($request->has('photos')) {
                $raw = $request->input('photos', []);
                $photos = array_values(array_filter($raw, fn($u) => is_string($u) && trim($u) !== ''));

                if (count($photos) > 0 && count($photos) < 3) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'photos' => ['Informe pelo menos 3 URLs válidas nas fotos.'],
                    ]);
                }

                if (count($photos) > 0) {
                    foreach ($photos as $url) {
                        $vehicle->photos()->create(['url' => $url]);
                    }
                } else {
                    $vehicle->photos()->create(['url' => $data['main_photo_url']]);
                }
            } else {
                $vehicle->photos()->create(['url' => $data['main_photo_url']]);
            }
        });

        return redirect()->route('admin.vehicles.index')->with('success', 'Veículo criado');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load('photos', 'brand', 'carModel', 'color');
        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        $vehicle->load('photos');
        $brands = Brand::orderBy('name')->get();
        $models = CarModel::where('brand_id', $vehicle->brand_id)->orderBy('name')->get();
        $colors = Color::orderBy('name')->get();
        return view('admin.vehicles.edit', compact('vehicle', 'brands', 'models', 'colors'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'brand_id' => ['required','exists:brands,id'],
            'car_model_id' => ['required', Rule::exists('car_models','id')->where(function($query) use ($request) {
                if ($request->brand_id) {
                    $query->where('brand_id', $request->brand_id);
                }
            })],
            'color_id' => ['required','exists:colors,id'],
            'year' => ['required','integer','min:1900','max:' . date('Y')],
            'mileage' => ['required','integer','min:0'],
            'price' => ['required','numeric','min:0'],
            'description' => ['nullable','string'],
            'main_photo_url' => ['required','url'],
            'photos' => ['nullable','array'],
            'photos.*' => ['nullable','url'],
        ]);

        DB::transaction(function() use ($data, $request, $vehicle) {
            $vehicle->update([
                'brand_id' => $data['brand_id'],
                'car_model_id' => $data['car_model_id'],
                'color_id' => $data['color_id'],
                'year' => $data['year'],
                'mileage' => $data['mileage'],
                'price' => $data['price'],
                'description' => $data['description'] ?? null,
                'main_photo_url' => $data['main_photo_url'],
            ]);

            if ($request->has('photos')) {
                $raw = $request->input('photos', []);
                $photos = array_values(array_filter($raw, fn($u) => is_string($u) && trim($u) !== ''));

                if (count($photos) > 0 && count($photos) < 3) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'photos' => ['Informe pelo menos 3 URLs válidas nas fotos.'],
                    ]);
                }

                if (count($photos) > 0) {
                    $vehicle->photos()->delete();
                    foreach ($photos as $url) {
                        $vehicle->photos()->create(['url' => $url]);
                    }
                } else {
                    $first = $vehicle->photos()->first();
                    if ($first) {
                        $first->update(['url' => $data['main_photo_url']]);
                    } else {
                        $vehicle->photos()->create(['url' => $data['main_photo_url']]);
                    }
                }
            } else {
                $first = $vehicle->photos()->first();
                if ($first) {
                    $first->update(['url' => $data['main_photo_url']]);
                } else {
                    $vehicle->photos()->create(['url' => $data['main_photo_url']]);
                }
            }
        });

        return redirect()->route('admin.vehicles.index')->with('success', 'Veículo atualizado');
    }

    public function destroy(Vehicle $vehicle)
    {
        DB::transaction(function() use ($vehicle) {
            $vehicle->photos()->delete();
            $vehicle->delete();
        });

        return redirect()->route('admin.vehicles.index')->with('success', 'Veículo removido');
    }
}

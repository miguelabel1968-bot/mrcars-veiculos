<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Models\Brand;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index()
    {
        $models = CarModel::with('brand')->orderBy('name')->paginate(20);
        return view('admin.car_models.index', compact('models'));
    }

    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        return view('admin.car_models.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255'
        ]);
        CarModel::create($data);
        return redirect()->route('admin.car-models.index')->with('success', 'Modelo criado');
    }

    public function edit(CarModel $car_model)
    {
        $brands = Brand::orderBy('name')->get();
        return view('admin.car_models.edit', ['model' => $car_model, 'brands' => $brands]);
    }

    public function update(Request $request, CarModel $car_model)
    {
        $data = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255'
        ]);
        $car_model->update($data);
        return redirect()->route('admin.car-models.index')->with('success', 'Modelo atualizado');
    }

    public function destroy(CarModel $car_model)
    {
        $car_model->delete();
        return redirect()->route('admin.car-models.index')->with('success', 'Modelo excluído');
    }

    public function byBrand(Brand $brand)
    {
        $models = $brand->carModels()->orderBy('name')->get(['id', 'name']);
        return response()->json($models);
    }
}

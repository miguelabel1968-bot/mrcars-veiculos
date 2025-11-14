@extends('layouts.app')

@section('title','Veículos - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="mb-0">Veículos</h1>
  <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">Novo veículo</a>
</div>

@forelse($vehicles as $vehicle)
  <div class="admin-vehicle-row mb-3 p-3" style="display:grid; grid-template-columns:110px 1fr 140px 220px; gap:1rem; align-items:center; background:#fff; border-radius:8px; border:1px solid rgba(0,0,0,0.04);">
    <div class="thumb">
      <img src="{{ $vehicle->main_photo_url ?? asset('images/placeholder-car.png') }}" alt="thumb" style="width:110px; height:72px; object-fit:cover; border-radius:6px;">
    </div>

    <div>
      <div class="fw-bold">{{ $vehicle->brand->name ?? '' }} {{ $vehicle->carModel->name ?? '' }}</div>
      <div class="text-muted small">{{ $vehicle->year }} • {{ number_format($vehicle->mileage ?? 0,0,',','.') }} km</div>
    </div>

    <div class="text-end">
      <div class="fw-bold">R$ {{ number_format($vehicle->price ?? 0,2,',','.') }}</div>
    </div>

    <div class="d-flex justify-content-end align-items-center gap-2">
      <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn btn-secondary btn-sm">Editar</a>
      <a href="{{ route('admin.vehicles.show', $vehicle) }}" class="btn btn-outline-dark btn-sm">Ver</a>
      <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Deseja excluir este veículo?');" style="display:inline-block">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
      </form>
    </div>
  </div>
@empty
  <div class="alert alert-info">Nenhum veículo cadastrado.</div>
@endforelse

<div class="mt-4">
  {{ $vehicles->links() }}
</div>
@endsection
